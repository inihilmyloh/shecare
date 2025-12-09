<?php
include "../config/connection.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$id) {
    echo json_encode(["status" => false, "message" => "ID tidak valid"]);
    exit();
}

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
        WHERE rp.id_pemeriksaan = ?
    ";
    
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // Parse jawaban JSON dan ambil judul pertanyaan
        $jawabanArray = [];
        try {
            $jawabanRaw = $data['jawaban'] ?? '{}';
            $jawaban = json_decode($jawabanRaw, true);
            
            // Debug: log raw data
            error_log("Raw jawaban: " . $jawabanRaw);
            error_log("Decoded jawaban: " . json_encode($jawaban));
            error_log("Is array: " . (is_array($jawaban) ? 'yes' : 'no'));
            
            // Ensure jawaban is an array and not empty
            if (is_array($jawaban) && !empty($jawaban)) {
                // Fetch pertanyaan untuk ID penyakit ini
                $pertanyaanQuery = "
                    SELECT id_pertanyaan, judul_pertanyaan 
                    FROM pertanyaan 
                    WHERE id_penyakit = ?
                    ORDER BY id_pertanyaan
                ";
                $pertanyaanStmt = $koneksi->prepare($pertanyaanQuery);
                if (!$pertanyaanStmt) {
                    error_log("Prepare error: " . $koneksi->error);
                } else {
                    $pertanyaanStmt->bind_param("i", $data['id_penyakit']);
                    $pertanyaanStmt->execute();
                    $pertanyaanResult = $pertanyaanStmt->get_result();
                    
                    $pertanyaanMap = [];
                    while ($row = $pertanyaanResult->fetch_assoc()) {
                        $pertanyaanMap['pertanyaan_' . $row['id_pertanyaan']] = $row['judul_pertanyaan'];
                    }
                    
                    error_log("Pertanyaan map: " . json_encode($pertanyaanMap));
                    
                    // Map jawaban dengan deskripsi
                    $descriptions = [
                        '1' => 'Tidak Pernah',
                        '2' => 'Jarang',
                        '3' => 'Kadang-kadang',
                        '4' => 'Sering',
                        '5' => 'Sangat Sering'
                    ];
                    
                    foreach ($jawaban as $key => $value) {
                        $jawabanArray[] = [
                            'key' => $key,
                            'pertanyaan' => $pertanyaanMap[$key] ?? 'Pertanyaan tidak ditemukan',
                            'nilai' => $value,
                            'deskripsi' => $descriptions[$value] ?? 'Tidak diketahui'
                        ];
                    }
                    
                    error_log("Jawaban array: " . json_encode($jawabanArray));
                }
            } else {
                error_log("Jawaban is not array or is empty");
            }
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            // Jika gagal parse, tampilkan raw jawaban
            $jawabanArray = [];
        }
        
        $data['jawaban_array'] = $jawabanArray;
        
        echo json_encode([
            "status" => true,
            "data" => $data
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Data tidak ditemukan"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
}
?>

