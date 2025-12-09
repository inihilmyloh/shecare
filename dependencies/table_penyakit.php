<?php

$nama_tabel = "penyakit";

$sql = "
    CREATE TABLE `shecare_native`.`penyakit` (
        `id_penyakit` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        `nama_penyakit` VARCHAR(255) NOT NULL, 
        `deskripsi_penyakit` TEXT NOT NULL, 
        `thumbnail` LONGBLOB NOT NULL,
        `id_user` INT NOT NULL, 
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
    );
";

if ($koneksi->query($sql) === true) {
    echo "Tabel dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat tabel $nama_tabel<br>";
}