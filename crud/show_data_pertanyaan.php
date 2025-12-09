<?php
include "../config/connection.php";

$id = $_GET['id'];
$sql = "SELECT pe.*, py.nama_penyakit FROM pertanyaan pe INNER JOIN penyakit py ON pe.id_penyakit = py.id_penyakit WHERE pe.id_pertanyaan = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false, 'data' => []]);
}