<?php
include "../config/connection.php";

$id = $_GET['id'];
$sql = "SELECT * FROM artikel WHERE id_artikel = $id";
$result = $koneksi->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $row['thumbnail'] = base64_encode($row['thumbnail']);
    echo json_encode(["data" => $row, "status" => true]);
} else {
    echo json_encode(["status" => false]);
}