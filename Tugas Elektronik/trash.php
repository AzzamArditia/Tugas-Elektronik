<?php
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Trash Barang</title>
</head>

<body>

<h1>Data Barang Terhapus</h1>

<a href="dashboard.php">Kembali ke Dashboard</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
<th>Nama Barang</th>
<th>Stok</th>
<th>Kondisi</th>
<th>Lokasi Rak</th>
<th>Gambar</th>
<th>Aksi</th>
</tr>

<?php
$data = mysqli_query($conn,"SELECT * FROM toko_elektronik 
WHERE deleted_at IS NOT NULL");

while($row = mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $row['Nama_Barang']; ?></td>

<td><?= $row['Stok']; ?></td>

<td><?= $row['Kondisi']; ?></td>

<td><?= $row['Lokasi_Rak']; ?></td>

<td>
<img src="gambar/<?= $row['gambar']; ?>" width="80">
</td>

<td>

<a href="restore.php?id=<?= $row['id_barang']; ?>">Restore</a> |

<a href="delete_permanent.php?id=<?= $row['id_barang']; ?>"
onclick="return confirm('Hapus permanen?')">
Delete Permanen
</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>