<?php
include "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM toko_elektronik WHERE id_barang='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

$nama = $_POST['nama'];
$stok = $_POST['stok'];
$kondisi = $_POST['kondisi'];
$lokasi = $_POST['lokasi_rak'];

if($_FILES['gambar']['name']!=""){

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

move_uploaded_file($tmp,"gambar/".$gambar);

mysqli_query($conn,"UPDATE toko_elektronik SET
Nama_Barang='$nama',
Stok='$stok',
Kondisi='$kondisi',
Lokasi_Rak='$lokasi',
gambar='$gambar'
WHERE id_barang='$id'");

}else{

mysqli_query($conn,"UPDATE toko_elektronik SET
Nama_Barang='$nama',
Stok='$stok',
Kondisi='$kondisi',
Lokasi_Rak='$lokasi'
WHERE id_barang='$id'");

}

header("location:dashboard.php");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Barang</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Edit Barang</h1>

<form method="POST" enctype="multipart/form-data">

Nama Barang
<input type="text" name="nama" value="<?php echo $d['Nama_Barang']; ?>">

Stok
<input type="number" name="stok" value="<?php echo $d['Stok']; ?>">

Kondisi
<select name="kondisi">
<option value="Baru" <?php if($d['Kondisi']=="Baru") echo "selected"; ?>>Baru</option>
<option value="Bekas" <?php if($d['Kondisi']=="Bekas") echo "selected"; ?>>Bekas</option>
<option value="Rusak" <?php if($d['Kondisi']=="Rusak") echo "selected"; ?>>Rusak</option>
</select>

Lokasi Rak
<input type="text" name="lokasi_rak" value="<?php echo $d['Lokasi_Rak']; ?>">

<br><br>

Gambar Lama
<br><br>

<?php if($d['gambar']){ ?>
<img src="gambar/<?php echo $d['gambar']; ?>" width="120">
<?php } ?>

<br><br>

Ganti Gambar
<input type="file" name="gambar">

<br><br>

<button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>