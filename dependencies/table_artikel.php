<?php

$nama_tabel = "artikel";

$sql = "
    CREATE TABLE `shecare_native`.`artikel` (
        `id_artikel` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        `judul_artikel` VARCHAR(255) NOT NULL, 
        `deskripsi` TEXT NOT NULL, 
        `domain_asal` VARCHAR(255) NOT NULL, 
        `url` VARCHAR(255) NOT NULL, 
        `thumbnail` LONGBLOB NOT NULL, 
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
";

if ($koneksi->query($sql) === true) {
    echo "Tabel dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat tabel $nama_tabel<br>";
}