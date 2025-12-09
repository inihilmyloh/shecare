<?php
include "../config/connection.php";

try {
    $nama_penyakit = $_POST['nama_penyakit'];
    $deskripsi_penyakit = $_POST['deskripsi_penyakit'];
    $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("UPDATE `penyakit` SET `nama_penyakit` = ?, `deskripsi_penyakit` = ?, `thumbnail` = ? WHERE `penyakit`.`id_penyakit` = ?");
    $stmt->bind_param("sssi", $nama_penyakit, $deskripsi_penyakit, $thumbnail, $id);
    $stmt->execute();

    echo json_encode(["status" => true, "message" => "Data penyakit berhasil diperbarui"]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
    exit();
}