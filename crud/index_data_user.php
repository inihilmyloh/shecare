<?php
include "../config/connection.php";

$sql = "SELECT * FROM users";
$result = $koneksi->query($sql);

$data = [];
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false]);
}