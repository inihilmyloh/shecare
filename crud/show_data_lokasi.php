<?php
include "../config/connection.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id <= 0) {
    echo json_encode(["status" => false, "message" => "Invalid id"]);
    exit();
}

$stmt = $koneksi->prepare("SELECT id_lokasi, nama_lokasi, alamat, latitude, longitude, deskripsi, thumbnail, created_at, updated_at FROM lokasi WHERE id_lokasi = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $has_thumbnail = !empty($row['thumbnail']);
    // don't send raw blob in JSON; only indicate existence
    unset($row['thumbnail']);
    $row['has_thumbnail'] = $has_thumbnail;
    echo json_encode(["status" => true, "data" => $row]);
} else {
    echo json_encode(["status" => false]);
}
