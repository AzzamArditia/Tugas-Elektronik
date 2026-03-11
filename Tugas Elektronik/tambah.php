<?php
include 'koneksi.php';

if(isset($_POST['submit'])){

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp,"gambar/".$gambar);

mysqli_query($conn,"INSERT INTO toko_elektronik 
VALUES(NULL,'$nama','$harga','$stok','$gambar',NULL)");

header("location:dashboard.php");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Barang</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Tambah Barang</h1>

<form method="POST" enctype="multipart/form-data">

Nama Barang
<input type="text" name="nama" required>

Harga
<input type="number" name="harga" required>

Stok
<input type="number" name="stok" required>

Gambar
<input type="file" name="gambar" required>

<button type="submit" name="submit">Simpan</button>

</form>

</div>

</body>
</html>