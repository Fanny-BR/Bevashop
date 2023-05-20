<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'proyek2');

$username = mysqli_real_escape_string($koneksi, $_POST['Inputusername']);
$sql = "select * from user where username = '$username'";
$process = mysqli_query($koneksi, $sql);
$num = mysqli_num_rows($process);
if($num == 0){
	echo " ✔ Username siap dipakai";
}else{
	echo " ❌ Username sudah tersedia";
}
?>