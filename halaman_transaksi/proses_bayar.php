<?php
session_start();
ini_set('date.timezone', 'Asia/Jakarta');
$bayar = preg_replace('/\D/', '', $_POST['bayar']);

include 'nomer_invoice.php';
$no_invoice = "$kodeBarang$date";


$t=time();
$jam = (date("H:i:s",$t));
$tanggal = date('Y-m-d');
$total = $_POST['total'];//total bayar awal
$kembalian = $bayar - $total;
$id_kasir = $_POST['idkasir'];

//proses insert ke tabel transaksi
mysqli_query($koneksi,"INSERT INTO transaksi (id,no_invoice,tgl_transaksi,jam_transaksi,total_bayar,jumlah_bayar,kembalian,id_user) values (NULL,'$no_invoice','$tanggal','$jam','$total','$bayar','$kembalian','$id_kasir')");

//mendapatkan id baru/ terakhir database
$id_transaksi = mysqli_insert_id($koneksi);

foreach ($_SESSION['keranjang'] as $key => $value) {

    $id_stok = $value['id'];
    $harga = $value['harga'];
    $qty = $value['qty'];
    $tot = $harga*$qty;

    mysqli_query($koneksi,"INSERT INTO detail_transaksi (id_detail_transaksi,id_transaksi,id_stok,harga,qty,total) values (NULL,'$id_transaksi','$id_stok','$harga','$qty','$tot')");
    mysqli_query($koneksi,"UPDATE stok set stok_sekarang = stok_sekarang - '$qty'
                            where id='$id_stok'");
    $_SESSION['keranjang'] = [];
    echo "<script>location='index.php?page=uangkembali&id=$id_transaksi';</script>";
}


?>