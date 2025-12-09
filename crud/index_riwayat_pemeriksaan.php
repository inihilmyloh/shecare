<?php
include "../config/connection.php";

try {
    $query = "
        SELECT 
            rp.id_pemeriksaan,
            rp.id_penyakit,
            rp.nama,
            rp.umur,
            rp.no_telp,
            rp.jawaban,
            rp.created_at,
            p.nama_penyakit,
            hp.hasil_prediksi,
            hp.skor_prediksi,
            hp.model_version
        FROM riwayat_pemeriksaan rp
        LEFT JOIN penyakit p ON rp.id_penyakit = p.id_penyakit
        LEFT JOIN hasil_prediksi hp ON rp.id_pemeriksaan = hp.id_pemeriksaan
        ORDER BY rp.created_at DESC
    ";
    
    $result = $koneksi->query($query);
    $data = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    echo json_encode([
        "status" => true,
        "data" => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
}
?>
