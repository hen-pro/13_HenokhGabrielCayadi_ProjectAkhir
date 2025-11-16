
<?php 

include "KONEKSI.PHP";
$id_siswa = $_POST['id_siswa'];
$nama = $_POST['nama'];
$nisn = $_POST['nisn'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "UPDATE mahasiswa set nama='$nama',nisn='$nisn',alamat='$alamat' where id_siswa='$id_siswa'"); 

header("location:index.php")

?>
