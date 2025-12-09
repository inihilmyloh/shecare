<?php
include "../config/connection.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nama = isset($_POST['nama_lokasi']) ? $_POST['nama_lokasi'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
$deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';

try {
    if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['size'] > 0) {
        $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
        $stmt = $koneksi->prepare("UPDATE lokasi SET nama_lokasi = ?, alamat = ?, latitude = ?, longitude = ?, deskripsi = ?, thumbnail = ? WHERE id_lokasi = ?");
        $stmt->bind_param("ssddssi", $nama, $alamat, $latitude, $longitude, $deskripsi, $thumbnail, $id);
    } else {
        $stmt = $koneksi->prepare("UPDATE lokasi SET nama_lokasi = ?, alamat = ?, latitude = ?, longitude = ?, deskripsi = ? WHERE id_lokasi = ?");
        $stmt->bind_param("ssddsi", $nama, $alamat, $latitude, $longitude, $deskripsi, $id);
    }

    $executed = $stmt->execute();
    if($executed) {
        echo json_encode(["status" => true, "message" => "Data lokasi berhasil diperbarui"]);
    } else {
        echo json_encode(["status" => false, "message" => $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}
