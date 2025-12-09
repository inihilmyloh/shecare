<?php
include "../config/connection.php";
$id = $_POST['id'];

try {
    $stmt = $koneksi->prepare("DELETE FROM pertanyaan WHERE id_pertanyaan = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}