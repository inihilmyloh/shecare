<?php
$nama_tabel = "pertanyaan";

$sql = "
    CREATE TABLE `shecare_native`.`pertanyaan` (
        `id_pertanyaan` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        `judul_pertanyaan` TEXT NOT NULL, 
        `id_penyakit` INT NOT NULL, 
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
";

if ($koneksi->query($sql) === true) {
    echo "Tabel dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat tabel $nama_tabel<br>";
}