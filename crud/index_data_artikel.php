<?php
include "../config/connection.php";

$sql = "SELECT * FROM artikel";
$result = $koneksi->query($sql);

$data = [];
if($result->num_rows > 0) {
    // How to convert BLOB to base64 in PHP -> okay thanks
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        $data[count($data)-1]['thumbnail'] = base64_encode($row['thumbnail']);
    }
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false, "message" => "No articles found", "data" => []]);
}