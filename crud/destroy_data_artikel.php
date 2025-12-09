<?php
include "../config/connection.php";
$id = $_POST['id'];

try {
    $stmt = $koneksi->prepare("DELETE FROM artikel WHERE id_artikel = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}