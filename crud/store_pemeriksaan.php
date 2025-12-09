<?php
include "../config/connection.php";

$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$umur = isset($_POST['umur']) ? intval($_POST['umur']) : 0;
$no_telp = isset($_POST['no_telp']) ? trim($_POST['no_telp']) : '';
$id_penyakit = isset($_POST['id_penyakit']) ? intval($_POST['id_penyakit']) : 0;
$jawaban_json = isset($_POST['jawaban']) ? $_POST['jawaban'] : '{}';

// Validate input
if(empty($nama) || $umur <= 0 || empty($no_telp) || $id_penyakit <= 0) {
    echo json_encode(["status" => false, "message" => "Data tidak lengkap"]);
    exit();
}

try {
    $stmt = $koneksi->prepare("INSERT INTO riwayat_pemeriksaan (nama, umur, no_telp, id_penyakit, jawaban) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisis", $nama, $umur, $no_telp, $id_penyakit, $jawaban_json);
    $stmt->execute();
    $id = $stmt->insert_id;
    echo json_encode(["status" => true, "message" => "Pemeriksaan berhasil disimpan", "id_pemeriksaan" => $id]);
} catch (Exception $e) {
    echo json_encode(["status" => false, "message" => $e->getMessage()]);
}
