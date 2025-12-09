<?php
/**
 * Endpoint: DELETE /crud/delete_fitur_prediksi.php
 * Deskripsi: Soft delete atau hard delete fitur prediksi
 * Parameter: id_fitur (required)
 * Response: JSON status
 */

require '../config/connection.php';
header('Content-Type: application/json');

// Allow POST with form data or JSON payload
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Method not allowed']);
    exit;
}

// Read input: prefer JSON body when Content-Type is application/json
$id_fitur = null;
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (strpos($content_type, 'application/json') !== false) {
    $body = json_decode(file_get_contents('php://input'), true);
    if (is_array($body)) {
        // accept several possible field names from frontend
        if (isset($body['id_fitur'])) $id_fitur = intval($body['id_fitur']);
        if (!$id_fitur && isset($body['id_fitur_prediksi'])) $id_fitur = intval($body['id_fitur_prediksi']);
        if (!$id_fitur && isset($body['id'])) $id_fitur = intval($body['id']);
    }
} else {
    // fallback to form POST
    if (isset($_POST['id_fitur'])) $id_fitur = intval($_POST['id_fitur']);
    if (!$id_fitur && isset($_POST['id_fitur_prediksi'])) $id_fitur = intval($_POST['id_fitur_prediksi']);
}

if (!$id_fitur) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Parameter id_fitur diperlukan']);
    exit;
}

// Soft delete: ubah is_active menjadi false
$sql = "UPDATE fitur_prediksi SET is_active = FALSE WHERE id_fitur = ?";

$stmt = $koneksi->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['status' => false, 'message' => 'Query error: ' . $koneksi->error]);
    exit;
}

$stmt->bind_param('i', $id_fitur);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        http_response_code(200);
        echo json_encode([
            'status' => true,
            'message' => 'Fitur prediksi berhasil dihapus'
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'status' => false,
            'message' => 'Fitur prediksi tidak ditemukan'
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Gagal menghapus fitur prediksi: ' . $stmt->error
    ]);
}

$stmt->close();
?>
