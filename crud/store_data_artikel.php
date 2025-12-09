<?php
include "../config/connection.php";
$judul_artikel = $_POST['judul_artikel'];
$deskripsi = $_POST['deskripsi'];
$domain_asal = $_POST['domain_asal'];
$url = $_POST['url'];
$thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);

try {
    $stmt = $koneksi->prepare("INSERT INTO artikel (judul_artikel, deskripsi, domain_asal, url, thumbnail) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $judul_artikel, $deskripsi, $domain_asal, $url, $thumbnail);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}