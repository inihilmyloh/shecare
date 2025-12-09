<?php
include "../config/connection.php";

$id = $_GET['id'];
$sql = "SELECT * FROM penyakit p INNER JOIN users u ON p.id_user = u.id_user WHERE p.id_penyakit = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $data['thumbnail'] = base64_encode($data['thumbnail']);
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false, 'data' => []]);
}