<?php
header('Content-Type: application/json');
require_once '../config/connection.php';

if (!isset($_GET['id_fitur_prediksi']) || empty($_GET['id_fitur_prediksi'])) {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'id_fitur_prediksi tidak boleh kosong'
    ]);
    exit;
}

$id_fitur = intval($_GET['id_fitur_prediksi']);

// Query dengan JOIN ke tabel penyakit
$sql = "SELECT 
            fp.id_fitur,
            fp.id_penyakit,
            fp.nama_fitur,
            fp.label_fitur,
            fp.tipe_input,
            fp.deskripsi,
            fp.nilai_min,
            fp.nilai_max,
            fp.step_value,
            fp.unit,
            fp.pilihan_json,
            fp.urutan,
            fp.is_active,
            p.nama_penyakit
        FROM fitur_prediksi fp
        LEFT JOIN penyakit p ON fp.id_penyakit = p.id_penyakit
        WHERE fp.id_fitur = ?";

$stmt = $koneksi->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Database error: ' . $koneksi->error
    ]);
    exit;
}

$stmt->bind_param('i', $id_fitur);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode([
        'status' => false,
        'message' => 'Query error: ' . $stmt->error
    ]);
    exit;
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode([
        'status' => false,
        'message' => 'Fitur prediksi tidak ditemukan'
    ]);
    exit;
}

$fitur = $result->fetch_assoc();

http_response_code(200);
echo json_encode([
    'status' => true,
    'message' => 'Data fitur ditemukan',
    'data' => $fitur
]);

$stmt->close();
?>
