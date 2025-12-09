<?php
include "../config/connection.php";

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id_user = $id";
$result = $koneksi->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["data" => $row, "status" => true]);
} else {
    echo json_encode(["status" => false]);
}