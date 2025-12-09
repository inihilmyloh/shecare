<?php
session_start();
include "../config/connection.php";
$judul_pertanyaan = $_POST['judul_pertanyaan'];
$id_penyakit = $_POST['id_penyakit'];

try {
    $stmt = $koneksi->prepare("INSERT INTO pertanyaan (judul_pertanyaan, id_penyakit) VALUES (?, ?)");
    $stmt->bind_param("si", $judul_pertanyaan, $id_penyakit);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}