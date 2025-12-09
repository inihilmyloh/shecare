<?php
include "../config/connection.php";

$nama = isset($_POST['nama_lokasi']) ? $_POST['nama_lokasi'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
$deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
$thumbnail = null;

if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['size'] > 0) {
    $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
}

try {
    if($thumbnail !== null) {
        // Some environments accept binding blobs as strings; mirror pattern used elsewhere in repo
        $stmt = $koneksi->prepare("INSERT INTO lokasi (nama_lokasi, alamat, latitude, longitude, deskripsi, thumbnail) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddss", $nama, $alamat, $latitude, $longitude, $deskripsi, $thumbnail);
    } else {
        $stmt = $koneksi->prepare("INSERT INTO lokasi (nama_lokasi, alamat, latitude, longitude, deskripsi) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdds", $nama, $alamat, $latitude, $longitude, $deskripsi);
    }
    $executed = $stmt->execute();
    if($executed) {
        echo json_encode(["status" => true]);
    } else {
        echo json_encode(["status" => false, "message" => $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}
