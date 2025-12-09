<?php 
  include 'config/connection.php';
  session_start();
  if(@$_SESSION['isLogin'] && @$_SESSION['role'] == "user") {
    include 'pages/layout/user/app2.php';
  } else if(@$_SESSION['isLogin'] && @$_SESSION['role'] == "admin") {
    include 'pages/layout/admin/index.php';
  } else {
    if(@$_GET['hal'] == 'login' || @$_GET['hal'] == 'register') {
      include 'pages/layout/user/auth.php';
    } else {
      include 'pages/layout/user/index.php';
    }
  }
?>