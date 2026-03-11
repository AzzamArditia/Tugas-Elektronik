<?php
session_start();
include "config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Query cek user
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data  = mysqli_fetch_array($query);

if($data){
    // Jika login berhasil
    $_SESSION['username'] = $data['username'];
    header("Location: dashboard.php");
}else{
    // Jika login gagal
    header("Location: login.php?pesan=gagal");
}
?>