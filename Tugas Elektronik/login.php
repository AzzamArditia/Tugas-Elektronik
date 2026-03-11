<?php
session_start();

/* cek apakah form dikirim */
if(isset($_POST['username']) && isset($_POST['password'])){

$username = $_POST['username'];
$password = $_POST['password'];

/* akun login */
$admin_user = "admin";
$admin_pass = "admin123";

$user_user = "user";
$user_pass = "user123";

/* login admin */
if($username == $admin_user && $password == $admin_pass){

$_SESSION['role'] = "admin";
header("Location: dashboard.php");

/* login user */
}else if($username == $user_user && $password == $user_pass){

$_SESSION['role'] = "user";
header("Location: beli.php");

}else{

echo "<script>alert('Username atau Password salah'); window.location='index.php';</script>";

}

}else{

header("Location: index.php");

}
?>