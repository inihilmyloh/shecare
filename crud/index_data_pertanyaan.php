<?php
include "../config/connection.php";

$id_penyakit = @$_GET['id_penyakit'];
$sql = "";
if($id_penyakit == '' || $id_penyakit == null || $id_penyakit == 'default') {
    echo json_encode(["data" => [], "status" => true]);
    exit;
} else {
    $sql = "SELECT * FROM pertanyaan pe INNER JOIN penyakit py ON pe.id_penyakit = py.id_penyakit WHERE pe.id_penyakit = $id_penyakit";

}
$result = $koneksi->query($sql);

$data = [];
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        $data[count($data)-1]['thumbnail'] = base64_encode($row['thumbnail']);
    }
    echo json_encode(["data" => $data, "status" => true]);
} else {
    echo json_encode(["status" => false, 'data' => []]);
}