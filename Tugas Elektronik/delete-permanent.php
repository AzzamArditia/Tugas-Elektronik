<?php
include "config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM toko_elektronik 
WHERE id_barang='$id'");

header("Location: trash.php");
?>