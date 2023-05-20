<?php
$host = "localhost";
$user = "root";
$pass = "";
$DB = "proyek2";
$koneksi = new mysqli("$host","$user","$pass","$DB");
if($koneksi -> connect_error){
    echo "<script>alert('Koneksi Gagal Ke Database');</script>".$koneksi->connect_error;
}
?>