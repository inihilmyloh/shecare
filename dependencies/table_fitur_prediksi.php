<?php
/**
 * File untuk membuat tabel prediksi di database
 * Letakkan di folder: /dependencies/table_fitur_prediksi.php
 * Panggil melalui dependencies/index.php
 */

$nama_tabel = "fitur_prediksi";

$sql = "
    CREATE TABLE IF NOT EXISTS `shecare_native`.`fitur_prediksi` (
        `id_fitur` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_penyakit` INT NOT NULL,
        `nama_fitur` VARCHAR(255) NOT NULL COMMENT 'Identifier teknis (snake_case)',
        `label_fitur` VARCHAR(255) NOT NULL COMMENT 'Label untuk ditampilkan di form',
        `tipe_input` ENUM('number', 'text', 'select', 'radio', 'textarea', 'checkbox') DEFAULT 'number',
        `deskripsi` TEXT COMMENT 'Penjelasan untuk user',
        `urutan` INT DEFAULT 0 COMMENT 'Urutan tampilan di form',
        
        `nilai_min` DECIMAL(10,2) COMMENT 'Nilai minimum untuk input number',
        `nilai_max` DECIMAL(10,2) COMMENT 'Nilai maksimum untuk input number',
        `step_value` DECIMAL(10,2) COMMENT 'Increment step untuk input number',
        `unit` VARCHAR(50) COMMENT 'Satuan (cm, kg, mmHg, dll)',
        
        `pilihan_json` JSON COMMENT 'Opsi untuk select/radio: {\"1\": \"Opsi A\", \"2\": \"Opsi B\"}',
        
        `is_active` BOOLEAN DEFAULT TRUE,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        
        CONSTRAINT fk_fitur_prediksi_penyakit FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE,
        INDEX idx_penyakit_urutan (`id_penyakit`, `urutan`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

if ($koneksi->query($sql) === true) {
    echo "✅ Tabel dibuat: $nama_tabel <br>";
} else {
    echo "❌ Error saat membuat tabel $nama_tabel: " . $koneksi->error . "<br>";
}

// Buat tabel hasil_prediksi
$nama_tabel2 = "hasil_prediksi";

$sql2 = "
    CREATE TABLE IF NOT EXISTS `shecare_native`.`hasil_prediksi` (
        `id_prediksi` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_pemeriksaan` INT NOT NULL COMMENT 'FK ke riwayat_pemeriksaan',
        `id_penyakit` INT NOT NULL COMMENT 'FK ke penyakit',
        
        `nilai_fitur` JSON NOT NULL COMMENT 'Input values untuk prediksi',
        
        `skor_prediksi` DECIMAL(5,4) COMMENT 'Confidence score (0.0 - 1.0)',
        `hasil_prediksi` VARCHAR(100) COMMENT 'Label hasil (Positif, Negatif, Risiko Tinggi, dll)',
        `deskripsi_hasil` TEXT COMMENT 'Penjelasan hasil prediksi',
        `rekomendasi` TEXT COMMENT 'Rekomendasi untuk user',
        
        `model_version` VARCHAR(50) DEFAULT 'v1.0' COMMENT 'Versi model ML yang digunakan',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        
        CONSTRAINT fk_hasil_prediksi_pemeriksaan FOREIGN KEY (`id_pemeriksaan`) REFERENCES `riwayat_pemeriksaan` (`id_pemeriksaan`) ON DELETE CASCADE,
        CONSTRAINT fk_hasil_prediksi_penyakit FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE,
        INDEX idx_pemeriksaan (`id_pemeriksaan`),
        INDEX idx_penyakit (`id_penyakit`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

if ($koneksi->query($sql2) === true) {
    echo "✅ Tabel dibuat: $nama_tabel2 <br>";
} else {
    echo "❌ Error saat membuat tabel $nama_tabel2: " . $koneksi->error . "<br>";
}

// Optional: Buat tabel prediksi_log untuk audit trail
$nama_tabel3 = "prediksi_log";

$sql3 = "
    CREATE TABLE IF NOT EXISTS `shecare_native`.`prediksi_log` (
        `id_log` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_prediksi` INT NOT NULL,
        `id_penyakit` INT NOT NULL,
        `user_id` INT COMMENT 'Opsional: jika ada user login',
        `nilai_input` JSON COMMENT 'Nilai input yang dikirim',
        `output_model` JSON COMMENT 'Output raw dari model ML',
        `confidence` DECIMAL(5,4),
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        
        CONSTRAINT fk_prediksi_log_prediksi FOREIGN KEY (`id_prediksi`) REFERENCES `hasil_prediksi` (`id_prediksi`) ON DELETE CASCADE,
        CONSTRAINT fk_prediksi_log_penyakit FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE,
        INDEX idx_penyakit_date (`id_penyakit`, `created_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";

if ($koneksi->query($sql3) === true) {
    echo "✅ Tabel dibuat: $nama_tabel3 <br>";
} else {
    echo "❌ Error saat membuat tabel $nama_tabel3: " . $koneksi->error . "<br>";
}

echo "<hr>";
echo "✨ Semua tabel untuk sistem prediksi telah dibuat!<br>";
echo "Dokumentasi lengkap: <a href='../DOKUMENTASI_PREDIKSI.md' target='_blank'>DOKUMENTASI_PREDIKSI.md</a>";
?>
