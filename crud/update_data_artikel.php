<?php
include "../config/connection.php";

try {
    $id = $_POST['id'];
    $judul_artikel = $_POST['judul_artikel'];
    $deskripsi = $_POST['deskripsi'];
    $domain_asal = $_POST['domain_asal'];
    $url = $_POST['url'];

    if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
        $stmt = $koneksi->prepare("UPDATE artikel SET judul_artikel = ?, deskripsi = ?, domain_asal = ?, url = ?, thumbnail = ? WHERE id_artikel = ?");
        $stmt->bind_param("sssssi", $judul_artikel, $deskripsi, $domain_asal, $url, $thumbnail, $id);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("UPDATE artikel SET judul_artikel = ?, deskripsi = ?, domain_asal = ?, url = ? WHERE id_artikel = ?");
        $stmt->bind_param("ssssi", $judul_artikel, $deskripsi, $domain_asal, $url, $id);
        $stmt->execute();
    }
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}