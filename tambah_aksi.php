
<?php 

include "KONEKSI.PHP";

$nama = $_POST["nama"];
$nisn = $_POST["nisn"];
$alamat = $_POST["alamat"];

mysqli_query($koneksi, "INSERT into mahasiswa(nama,nisn,alamat) values('$nama','$nisn','$alamat')");

header("location:home.php")




?>
