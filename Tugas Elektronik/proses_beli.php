<?php
include "config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,
"UPDATE toko_elektronik 
SET Stok = Stok - 1
WHERE id_barang = '$id'");

header("Location: beli.php");
?>