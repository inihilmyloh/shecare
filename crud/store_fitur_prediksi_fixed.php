<?php
/**
 * Endpoint: POST /crud/store_fitur_prediksi.php
 * Deskripsi: Tambah atau update fitur prediksi
 * Accepts: JSON (Content-Type: application/json) atau form-urlencoded
 * Response: JSON status
 */

require '../config/connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Method not allowed']);
    exit;
}

// Parse input dari JSON atau POST parameters
$input = [];
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';

if (strpos($content_type, 'application/json') !== false) {
    // Parse JSON
    $json_data = json_decode(file_get_contents('php://input'), true);
    $input = is_array($json_data) ? $json_data : [];
} else {
    // Parse POST parameters
    $input = $_POST;
}

// Validasi input - required fields
if (!isset($input['id_penyakit']) || empty($input['id_penyakit'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'id_penyakit diperlukan'
    ]);
    exit;
}

if (!isset($input['nama']) || empty($input['nama'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'nama diperlukan'
    ]);
    exit;
}

if (!isset($input['label']) || empty($input['label'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'label diperlukan'
    ]);
    exit;
}

if (!isset($input['tipe_input']) || empty($input['tipe_input'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'tipe_input diperlukan'
    ]);
    exit;
}

// Extract values - map dari input admin UI ke database column names
$id_fitur = isset($input['id_fitur_prediksi']) ? intval($input['id_fitur_prediksi']) : null;
$id_penyakit = intval($input['id_penyakit']);
$nama_fitur = isset($input['nama']) ? trim($input['nama']) : '';
$label_fitur = isset($input['label']) ? trim($input['label']) : '';
$tipe_input = trim($input['tipe_input']);
$deskripsi = isset($input['deskripsi']) ? trim($input['deskripsi']) : '';
$urutan = isset($input['urutan']) ? intval($input['urutan']) : 1;
$nilai_min = isset($input['min']) ? floatval($input['min']) : null;
$nilai_max = isset($input['max']) ? floatval($input['max']) : null;
$step_value = isset($input['step']) ? floatval($input['step']) : null;
$unit = isset($input['unit']) ? trim($input['unit']) : '';
$pilihan_json = isset($input['pilihan_json']) ? $input['pilihan_json'] : null;
$is_active = isset($input['is_active']) ? intval($input['is_active']) : 1;

// Parse pilihan_json jika ada (ensure it's valid JSON string)
if ($pilihan_json && is_string($pilihan_json)) {
    $pilihan_json = json_encode(json_decode($pilihan_json, true));
}

// INSERT atau UPDATE
if ($id_fitur) {
    // UPDATE - 12 parameters + id_fitur
    $sql = "UPDATE fitur_prediksi 
            SET id_penyakit = ?, 
                nama_fitur = ?, 
                label_fitur = ?, 
                tipe_input = ?, 
                deskripsi = ?, 
                urutan = ?, 
                nilai_min = ?, 
                nilai_max = ?, 
                step_value = ?, 
                unit = ?, 
                pilihan_json = ?, 
                is_active = ?
            WHERE id_fitur = ?";
    
    $stmt = $koneksi->prepare($sql);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Query error: ' . $koneksi->error]);
        exit;
    }
    
    // Type: i s s s s i d d d s s i i
    $stmt->bind_param(
        'issssissdssi',
        $id_penyakit,
        $nama_fitur,
        $label_fitur,
        $tipe_input,
        $deskripsi,
        $urutan,
        $nilai_min,
        $nilai_max,
        $step_value,
        $unit,
        $pilihan_json,
        $is_active,
        $id_fitur
    );
    
    $message = 'Fitur prediksi berhasil diperbarui';
} else {
    // INSERT - 12 parameters
    $sql = "INSERT INTO fitur_prediksi 
            (id_penyakit, nama_fitur, label_fitur, tipe_input, deskripsi, urutan, nilai_min, nilai_max, step_value, unit, pilihan_json, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $koneksi->prepare($sql);
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Query error: ' . $koneksi->error]);
        exit;
    }
    
    // Type: i s s s s i d d d s s i
    $stmt->bind_param(
        'issssissdssi',
        $id_penyakit,
        $nama_fitur,
        $label_fitur,
        $tipe_input,
        $deskripsi,
        $urutan,
        $nilai_min,
        $nilai_max,
        $step_value,
        $unit,
        $pilihan_json,
        $is_active
    );
    
    $message = 'Fitur prediksi berhasil ditambahkan';
}

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode([
        'status' => true,
        'message' => $message,
        'id_fitur' => $id_fitur ?? $koneksi->insert_id
    ]);
} else {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Gagal menyimpan fitur prediksi: ' . $stmt->error
    ]);
}

$stmt->close();
?>
