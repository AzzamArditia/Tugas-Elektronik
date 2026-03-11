<?php
include "config/koneksi.php";

$id_barang   = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$stok        = $_POST['stok'];
$kondisi     = $_POST['kondisi'];
$lokasi_rak  = $_POST['lokasi_rak'];

$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

if($gambar != ""){
    
    move_uploaded_file($tmp, "gambar/".$gambar);

    mysqli_query($conn, "UPDATE toko_elektronik SET
    Nama_Barang='$nama_barang',
    Stok='$stok',
    Kondisi='$kondisi',
    Lokasi_Rak='$lokasi_rak',
    gambar='$gambar'
    WHERE id_barang='$id_barang'");

}else{

    mysqli_query($conn, "UPDATE toko_elektronik SET
    Nama_Barang='$nama_barang',
    Stok='$stok',
    Kondisi='$kondisi',
    Lokasi_Rak='$lokasi_rak'
    WHERE id_barang='$id_barang'");

}

header("Location: dashboard.php");
?>