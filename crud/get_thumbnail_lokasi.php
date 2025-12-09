<?php
include "../config/connection.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0) {
    http_response_code(400);
    exit();
}

$stmt = $koneksi->prepare("SELECT thumbnail FROM lokasi WHERE id_lokasi = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if(!empty($row['thumbnail'])) {
        $blob = $row['thumbnail'];
        // try to detect mime type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->buffer($blob);
        if(!$mime) $mime = 'application/octet-stream';
        header('Content-Type: ' . $mime);
        echo $blob;
        exit();
    }
}

http_response_code(404);
exit();
