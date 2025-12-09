<?php
include "../config/connection.php";

$sql = "SELECT id_lokasi, nama_lokasi, alamat, latitude, longitude, created_at, updated_at FROM lokasi";
$result = $koneksi->query($sql);

$data = [];
if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["data" => [], "status" => true]);
}
