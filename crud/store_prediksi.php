<?php
/**
 * Endpoint: POST /crud/store_prediksi.php
 * Deskripsi: Process form prediksi user + call ML model + save hasil
 * Parameters: 
 *   - id_pemeriksaan (required)
 *   - id_penyakit (required)
 *   - nilai_fitur (JSON string required) - {fitur_1: value, fitur_2: value, ...}
 * Response: JSON dengan hasil prediksi
 */

require '../config/connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Method not allowed']);
    exit;
}

// Accept JSON body or form POST
$contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (strpos($contentType, 'application/json') !== false) {
    $request = json_decode(file_get_contents('php://input'), true);
} else {
    $request = $_POST;
}

// Validasi input
if (!isset($request['id_pemeriksaan']) || !isset($request['id_penyakit']) || !isset($request['nilai_fitur'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Parameter id_pemeriksaan, id_penyakit, dan nilai_fitur diperlukan'
    ]);
    exit;
}

$id_pemeriksaan = intval($request['id_pemeriksaan']);
$id_penyakit = intval($request['id_penyakit']);
$nilai_fitur = is_string($request['nilai_fitur']) ? json_decode($request['nilai_fitur'], true) : $request['nilai_fitur'];

if (!is_array($nilai_fitur)) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'nilai_fitur harus berupa JSON'
    ]);
    exit;
}

// ============================================================
// STEP 1: Validasi nilai input sesuai constraint
// ============================================================

// Ambil definisi fitur dari database
$sql_fitur = "SELECT * FROM fitur_prediksi WHERE id_penyakit = ? AND is_active = TRUE";
$stmt = $koneksi->prepare($sql_fitur);
$stmt->bind_param('i', $id_penyakit);
$stmt->execute();
$result_fitur = $stmt->get_result();

$fitur_definitions = [];
while ($row = $result_fitur->fetch_assoc()) {
    $fitur_definitions[$row['nama_fitur']] = $row;
}

$stmt->close();

// Validasi nilai input
foreach ($nilai_fitur as $nama_fitur => $value) {
    if (!isset($fitur_definitions[$nama_fitur])) {
        http_response_code(400);
        echo json_encode([
            'status' => false,
            'message' => "Fitur '$nama_fitur' tidak valid untuk penyakit ini"
        ]);
        exit;
    }
    
    $definition = $fitur_definitions[$nama_fitur];
    
    // Validasi range untuk tipe number
    if ($definition['tipe_input'] === 'number') {
        $numeric_value = floatval($value);
        
        if ($definition['nilai_min'] !== null && $numeric_value < $definition['nilai_min']) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => "{$definition['label_fitur']} harus >= {$definition['nilai_min']}"
            ]);
            exit;
        }
        
        if ($definition['nilai_max'] !== null && $numeric_value > $definition['nilai_max']) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => "{$definition['label_fitur']} harus <= {$definition['nilai_max']}"
            ]);
            exit;
        }
    }
}

// ============================================================
// STEP 2: Call ML Model untuk prediksi
// ============================================================
// STEP 2: Validate prediction input from client (client-side ONNX)
// ============================================================
if (!isset($request['skor_prediksi']) || !is_numeric($request['skor_prediksi'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'skor_prediksi harus berupa angka desimal'
    ]);
    exit;
}

if (!isset($request['hasil_prediksi']) || empty(trim($request['hasil_prediksi']))) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'hasil_prediksi tidak boleh kosong'
    ]);
    exit;
}

$skor_prediksi = floatval($request['skor_prediksi']);
$hasil_prediksi = trim($request['hasil_prediksi']);
$deskripsi_hasil = isset($request['deskripsi_hasil']) ? trim($request['deskripsi_hasil']) : '';
$rekomendasi = isset($request['rekomendasi']) ? trim($request['rekomendasi']) : '';
$model_version = isset($request['model_version']) ? trim($request['model_version']) : 'v1.0-browser';

// ============================================================
// STEP 3: Save hasil prediksi ke database
// ============================================================

$sql_insert = "INSERT INTO hasil_prediksi 
               (id_pemeriksaan, id_penyakit, nilai_fitur, skor_prediksi, hasil_prediksi, deskripsi_hasil, rekomendasi, model_version)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $koneksi->prepare($sql_insert);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Database error: ' . $koneksi->error
    ]);
    exit;
}

$nilai_fitur_json = json_encode($nilai_fitur);

// Correct bind_param: 8 parameters
// i = id_pemeriksaan (integer)
// i = id_penyakit (integer)
// s = nilai_fitur_json (string)
// d = skor_prediksi (double)
// s = hasil_prediksi (string)
// s = deskripsi_hasil (string)
// s = rekomendasi (string)
// s = model_version (string)
$stmt->bind_param(
    'iisdssss',
    $id_pemeriksaan,
    $id_penyakit,
    $nilai_fitur_json,
    $skor_prediksi,
    $hasil_prediksi,
    $deskripsi_hasil,
    $rekomendasi,
    $model_version
);

if ($stmt->execute()) {
    $id_prediksi = $koneksi->insert_id;
    
    http_response_code(200);
    echo json_encode([
        'status' => true,
        'message' => 'Prediksi berhasil disimpan',
        'id_prediksi' => $id_prediksi,
        'hasil' => [
            'skor_prediksi' => $skor_prediksi,
            'hasil_prediksi' => $hasil_prediksi,
            'deskripsi_hasil' => $deskripsi_hasil,
            'rekomendasi' => $rekomendasi,
            'model_version' => $model_version
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Gagal menyimpan hasil prediksi: ' . $stmt->error
    ]);
}

$stmt->close();
?>
