
<?php
    if(@$env == null && @$koneksi == null) {
        include "../config/connection.php";
    }
    $database = $env["DATABASE_NAME"];
    // Dropping Database
    echo "Sedang me-reset database $database <br>";
    $sql = "DROP DATABASE IF EXISTS $database";
    if($koneksi->query($sql) === true) {
        echo "Reset database berhasil!: $database <br>";
    } else {
        echo "Error: saat me-reset database <br>";
    }

    // Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    if($koneksi->query($sql) === true) {
        echo "Database dibuat!: $database <br>";
    } else {
        echo "Error: saat membuat database <br>";
    }

    // Use Database
    $sql = "USE $database";
    if($koneksi->query($sql) === true) {
        echo "Use berhasil!: $database <br>";
    } else {
        echo "Error: saat men-select database <br>";
    }

    // Create Table Users
    include "table_user.php";

    // // Create Table Artikel
    include "table_artikel.php";

    // // Create Table Penyakit
    include "table_penyakit.php";

    // // Create Table Pertanyaan
    include "table_pertanyaan.php";

    // // Create Table Booking
    // include "table_booking.php";

    // // Create Table Transaksi
    // include "table_transaksi.php";

    // // Create Table Detail Transaksi
    // include "table_detail_transaksi.php";

    // // Index
    // // Create Table Indexes
    // include "table_indexes.php";

    // // Create Foreign Key Table
    include "table_foreign_key.php";

    echo "<br> Reset dan setup database $database selesai.";
    echo "Silahkan refresh halaman untuk melanjutkan.";