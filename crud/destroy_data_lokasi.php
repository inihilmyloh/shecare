<?php
include "../config/connection.php";

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

try {
    $stmt = $koneksi->prepare("DELETE FROM lokasi WHERE id_lokasi = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo json_encode(["status" => true]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}
