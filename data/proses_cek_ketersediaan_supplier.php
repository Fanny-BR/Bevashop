<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'proyek2');

$kode = mysqli_real_escape_string($koneksi, $_POST['kode']);
$sql = "select * from supplier where id_supplier = '$kode'";
$process = mysqli_query($koneksi, $sql);
$num = mysqli_num_rows($process);
if($num == 0){
	echo " ✔ Kode siap dipakai";
}else{
	echo " ❌ Kode sudah tersedia";
}
?>