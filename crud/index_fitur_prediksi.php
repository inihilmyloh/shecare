<?php
/**
 * Endpoint: GET /crud/index_fitur_prediksi.php
 * Deskripsi: List fitur prediksi untuk penyakit tertentu
 * Parameter: id_penyakit (required)
 * Response: JSON array fitur-fitur
 */

require '../config/connection.php';

if (!isset($_GET['id_penyakit']) || empty($_GET['id_penyakit'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Parameter id_penyakit diperlukan'
    ]);
    exit;
}

$id_penyakit = intval($_GET['id_penyakit']);

// Ambil fitur yang aktif, diurutkan berdasarkan kolom urutan
$sql = "SELECT 
            fp.id_fitur, 
            fp.id_penyakit, 
            fp.nama_fitur, 
            fp.label_fitur, 
            fp.tipe_input, 
            fp.deskripsi, 
            fp.urutan, 
            fp.nilai_min, 
            fp.nilai_max, 
            fp.step_value, 
            fp.unit, 
            fp.pilihan_json,
            fp.is_active,
            p.nama_penyakit
        FROM fitur_prediksi fp
        INNER JOIN penyakit p ON fp.id_penyakit = p.id_penyakit
        WHERE fp.id_penyakit = ? AND fp.is_active = TRUE
        ORDER BY fp.urutan ASC";

$stmt = $koneksi->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Database error: ' . $koneksi->error
    ]);
    exit;
}

$stmt->bind_param('i', $id_penyakit);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    // Parse JSON pilihan jika ada
    if ($row['pilihan_json']) {
        $row['pilihan_json'] = json_decode($row['pilihan_json'], true);
    }
    $data[] = $row;
}

$stmt->close();

http_response_code(200);
echo json_encode([
    'status' => true,
    'data' => $data,
    'total' => count($data)
]);
?>
