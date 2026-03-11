<?php

include "config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"UPDATE toko_elektronik 
SET deleted_at = NOW()
WHERE id_barang='$id'");

header("Location: dashboard.php");

?>