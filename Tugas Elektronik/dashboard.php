<?php
include "config/koneksi.php";

/* =========================
   STATISTIK BARANG
========================= */

$total_barang = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM toko_elektronik WHERE deleted_at IS NULL"));

$barang_baru = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM toko_elektronik 
WHERE Kondisi='Baru' AND deleted_at IS NULL"));

$barang_bekas = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM toko_elektronik 
WHERE Kondisi='Bekas' AND deleted_at IS NULL"));

$barang_rusak = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM toko_elektronik 
WHERE Kondisi='Rusak' AND deleted_at IS NULL"));

$stok_habis = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM toko_elektronik 
WHERE Stok=0 AND deleted_at IS NULL"));


/* =========================
   PAGINATION
========================= */

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;


/* =========================
   SEARCH + QUERY DATA
========================= */

if(isset($_GET['cari'])){
$cari = $_GET['cari'];

$data = mysqli_query($conn,"SELECT * FROM toko_elektronik 
WHERE Nama_Barang LIKE '%$cari%' 
AND deleted_at IS NULL 
LIMIT $start,$limit");

}else{

$data = mysqli_query($conn,"SELECT * FROM toko_elektronik 
WHERE deleted_at IS NULL 
LIMIT $start,$limit");

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<!-- HUBUNGKAN CSS -->
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<div class="topbar">

<h1>Dashboard Admin</h1>

<a class="btn btn-danger" href="logout.php">Logout</a>

</div>

<hr>

<h2>Statistik Barang</h2>

<div class="stats">

<div class="card">
<h3>Total Barang</h3>
<p><?= $total_barang['total']; ?></p>
</div>

<div class="card">
<h3>Barang Baru</h3>
<p><?= $barang_baru['total']; ?></p>
</div>

<div class="card">
<h3>Barang Bekas</h3>
<p><?= $barang_bekas['total']; ?></p>
</div>

<div class="card">
<h3>Barang Rusak</h3>
<p><?= $barang_rusak['total']; ?></p>
</div>

<div class="card">
<h3>Stok Habis</h3>
<p><?= $stok_habis['total']; ?></p>
</div>

</div>

<hr>

<h2>Tambah Barang</h2>

<form action="create.php" method="POST" enctype="multipart/form-data">

<label>Nama Barang</label>
<input type="text" name="nama_barang" required>

<label>Stok</label>
<input type="number" name="stok" required min="0">

<label>Kondisi</label>
<select name="kondisi" required>

<option value="Baru">Baru</option>
<option value="Bekas">Bekas</option>
<option value="Rusak">Rusak</option>

</select>

<label>Lokasi Rak</label>
<input type="text" name="lokasi_rak" required>

<label>Upload Gambar</label>
<input type="file" name="gambar" id="gambar" required>

<div class="preview">
<img id="previewImg" style="display:none;">
</div>

<button type="submit">Tambah</button>

</form>

<hr>

<h2>Daftar Barang</h2>

<form method="GET" class="search-box">

<input type="text" name="cari" placeholder="Cari barang...">

<button class="btn btn-primary" type="submit">Cari</button>

</form>

<table>

<tr>
<th>Nama Barang</th>
<th>Stok</th>
<th>Kondisi</th>
<th>Lokasi Rak</th>
<th>Gambar</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?= $row['Nama_Barang']; ?></td>

<td>
<?= $row['Stok'] == 0 ? "Stock Habis" : $row['Stok']; ?>
</td>

<td><?= $row['Kondisi']; ?></td>

<td><?= $row['Lokasi_Rak']; ?></td>

<td>

<?php if($row['gambar']){ ?>

<img src="gambar/<?= $row['gambar']; ?>" width="80">

<?php }else{ ?>

Tidak ada gambar

<?php } ?>

</td>

<td>

<a class="btn btn-warning" href="edit.php?id=<?= $row['id_barang']; ?>">Edit</a>

<a class="btn btn-danger"
onclick="return confirmDelete(<?= $row['id_barang']; ?>)">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<br>

<div class="pagination">

<?php

$total = mysqli_query($conn,"SELECT COUNT(*) as total FROM toko_elektronik WHERE deleted_at IS NULL");
$total_data = mysqli_fetch_assoc($total)['total'];

$total_page = ceil($total_data / $limit);

for($i=1;$i<=$total_page;$i++){

echo "<a href='?page=$i'> $i </a> ";

}

?>

</div>

</div>
<script>

document.getElementById("gambar").onchange = function(evt){

const [file] = this.files;

if(file){

let preview = document.getElementById("previewImg");

preview.src = URL.createObjectURL(file);

preview.style.display = "block";

}

}

</script>

<script>

function confirmDelete(id){

if(confirm("Apakah anda yakin ingin menghapus barang ini?")){

window.location = "delete.php?id="+id;

}

}

</script>

</body>
</html>