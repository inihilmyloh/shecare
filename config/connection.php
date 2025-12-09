<?php

    // $env = parse_ini_file(".env");

    // $koneksi = new mysqli($env["DATABASE_HOST"], $env["DATABASE_USERNAME"], $env["DATABASE_PASSWORD"], $env["DATABASE_NAME"]);

# Konek ke Web Server Lokal
$myHost	= "shecare.mif.myhost.id";
$myUser	= "mifmyho2_shecare";
$myPass	= "MIF@2025";
$myDbs	= "mifmyho2_shecare";
$pagedesc = "SheCare";
$koneksi = mysqli_connect( $myHost, $myUser, $myPass, $myDbs);

    if ($koneksi->connect_error) {

        die("Connection failed: " . $koneksi->connect_error);

    } 

    $result = $koneksi->query("SHOW TABLES");

    $d = $result->fetch_array();

    if(isset($d) != 1) {

        include "dependencies/index.php";

    }

?>