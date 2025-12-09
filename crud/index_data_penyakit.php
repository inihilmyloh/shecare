<?php
include "../config/connection.php";

$limit = isset($_GET["limit"]) ? intval($_GET["limit"]) : null;
$sql = "SELECT * FROM penyakit p INNER JOIN users u ON p.id_user = u.id_user";
if ($limit !== null) {
    $sql .= " LIMIT $limit";
}
$result = $koneksi->query($sql);

$data = [];
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        $data[count($data) - 1]['thumbnail'] = base64_encode($row['thumbnail']);
    }
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false, 'data' => []]);
}