<?php
session_start();
include "../config/connection.php";
$email = $_POST['email'];
$pass =  $_POST['password'];

$sql = 'SELECT * FROM users WHERE email = "' . $email . '"';
$result = $koneksi->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if(password_verify($pass, $row['password'])) {
        $_SESSION['isLogin'] = true;
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['nama_user'];
        $_SESSION['id_user'] = $row['id_user'];
        echo json_encode(["status" => "success", "title" => "Berhasil", "message" => "Login berhasil. Anda akan diarahkan pada halaman dashboard"]);
        exit();
        }
    }
    echo json_encode(["status" => "error", "title" => "Kesalahan", "message" => "Email atau password salah!"]);
} else {
    echo json_encode(["status" => "error", "title" => "Kesalahan", "message" => "Akun dengan email $email, tidak terdaftar dalam database kami!"]);
}