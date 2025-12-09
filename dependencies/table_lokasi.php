<?php

$nama_tabel = "lokasi";

$sql = "
    CREATE TABLE lokasi (
        id_lokasi INT AUTO_INCREMENT PRIMARY KEY,
        nama_lokasi VARCHAR(255) NOT NULL,
        alamat TEXT,
        latitude DOUBLE,
        longitude DOUBLE,
        deskripsi TEXT,
        thumbnail LONGBLOB,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

if ($koneksi->query($sql) === true) {
    echo "Tabel dibuat!: $nama_tabel <br>";
} else {
    echo "Error: saat membuat tabel $nama_tabel<br>";
}