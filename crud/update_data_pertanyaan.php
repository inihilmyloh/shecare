<?php
include "../config/connection.php";

try {
    $judul_pertanyaan = $_POST['judul_pertanyaan'];
    $id_penyakit = $_POST['id_penyakit'];
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("UPDATE `pertanyaan` SET `judul_pertanyaan` = ?, `id_penyakit` = ? WHERE `pertanyaan`.`id_pertanyaan` = ?");
    $stmt->bind_param("sii", $judul_pertanyaan, $id_penyakit, $id);
    $stmt->execute();

    echo json_encode(["status" => true, "message" => "Data user berhasil diperbarui"]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
    exit();
}