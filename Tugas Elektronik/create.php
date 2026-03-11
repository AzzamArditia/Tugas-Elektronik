<?php
include "config/koneksi.php";

$nama_barang = $_POST['nama_barang'];
$stok        = $_POST['stok'];
$kondisi     = $_POST['kondisi'];
$lokasi_rak  = $_POST['lokasi_rak'];

/* upload gambar */
$gambar = $_FILES['gambar']['name'];
$tmp    = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp, "gambar/".$gambar);

/* insert database */
mysqli_query($conn,"INSERT INTO toko_elektronik
(Nama_Barang,Stok,Kondisi,Lokasi_Rak,gambar)
VALUES
('$nama_barang','$stok','$kondisi','$lokasi_rak','$gambar')");

/* redirect dengan pesan */
header("Location: dashboard.php?pesan=tambah");
?>