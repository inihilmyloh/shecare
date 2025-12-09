<?php
include "../config/connection.php";

try {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    $role = $_POST['role'];
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("UPDATE `users` SET `nama_user` = ?, `alamat` = ?, `no_telp` = ?, `email` = ?, `password` = ?, `role` = ? WHERE `users`.`id_user` = ?");
    $stmt->bind_param("ssssssi", $nama, $alamat, $no_telp, $email, $password, $role, $id);
    $stmt->execute();

    echo json_encode(["status" => true, "message" => "Data user berhasil diperbarui"]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
    exit();
}