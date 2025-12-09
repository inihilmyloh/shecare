<?php
session_start();
include "../config/connection.php";
$nama_penyakit = $_POST['nama_penyakit'];
$deskripsi_penyakit = $_POST['deskripsi_penyakit'];
$thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
$id_user = $_SESSION['id_user'];

try {
    $stmt = $koneksi->prepare("INSERT INTO penyakit (nama_penyakit, deskripsi_penyakit, thumbnail, id_user) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nama_penyakit, $deskripsi_penyakit, $thumbnail, $id_user);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}