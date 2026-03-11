<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Halaman Beli</title>
</head>

<body>

<h1>Daftar Barang Toko</h1>

<table border="1" cellpadding="10">

<tr>
<th>Nama Barang</th>
<th>Stok</th>
<th>Kondisi</th>
<th>Lokasi Rak</th>
<th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn,
"SELECT * FROM toko_elektronik WHERE deleted_at IS NULL");

while($row = mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $row['Nama_Barang']; ?></td>

<td>
<?= $row['Stok'] == 0 ? "Stock Habis" : $row['Stok']; ?>
</td>

<td><?= $row['Kondisi']; ?></td>

<td><?= $row['Lokasi_Rak']; ?></td>

<td>

<?php if($row['Stok'] > 0){ ?>

<a href="proses_beli.php?id=<?= $row['id_barang']; ?>">
Beli
</a>

<?php } else { ?>

Stock Habis

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>