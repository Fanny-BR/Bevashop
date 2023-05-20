<?php 
ini_set('date.timezone', 'Asia/Jakarta');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include '../koneksi.php';
$ambil=$koneksi->query("SELECT transaksi.tgl_transaksi, transaksi.id, transaksi.no_invoice, transaksi.jam_transaksi, transaksi.total_bayar,  transaksi.jumlah_bayar, transaksi.kembalian, user.nama
 FROM transaksi, user 
 WHERE transaksi.id_user = user.id 
 AND transaksi.id='$_GET[id]'");
 $data=$ambil->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Belanja</title>
    <style>
    .td{
        font-size: 10px;
        font-family: 'Consolas';
    }
    .th{
        font-size: 15px;
        font-family: 'Consolas';
    }
    .tk{
        font-size: 10px;
        font-family: 'Consolas';
        color:#c0c0c0 ;
    }
    </style>
</head>
<body>
    <div>
        <table width="250" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <th class="th"><h1>Bevashop</h1>
                Jl. Tegalan Desa Ngasem Kec Ngasem Kediri<br>
                HP 082338206740 <br> <br>
                </th>
            </tr>
            <tr align="center"><td><hr></td></tr>
            <tr>
                <td class="td"><?php echo $data['tgl_transaksi'] ?> <?php echo $data['jam_transaksi'] ?> | <?php echo $data['nama'] ?></td>
            </tr>
            <tr align="center"><td><hr></td></tr>
        </table>
        <table width="250" border="0" cellpadding="1" cellspacing="0">
        <?php 
            $query = mysqli_query($koneksi, "SELECT detail_transaksi.*, stok.* , barang.*
            FROM detail_transaksi,stok, barang
            WHERE detail_transaksi.id_stok = stok.id AND stok.id_barang = barang.id
            AND detail_transaksi.id_transaksi='$_GET[id]'");
            while ($data1 = mysqli_fetch_array($query)){
            ?>  
        <tr>
            <th align="left" class="td">Nama</th>
            <th class="td">Jumlah</th>
            <th class="td">Harga Satuan</th>
            <th class="td" align="right">Total</th>
        </tr>  
        <tr>
            <th align="left" class="td"><?php echo $data1['nama'] ?></th>
            <th class="td"><?php echo $data1['qty'] ?></th>
            <th class="td">Rp. <?php echo number_format($data1['harga']) ?></th>
            <th class="td" align="right">Rp. <?php echo number_format($data1['total'])?></th>
        </tr>
            <?php 
            $barang = $barang+$data1['qty'];
            }?>
        <tr>
            <td colspan="4"><hr></td>
        </tr>
        </table>
        <table width="250" border="0" cellpadding="1" cellspacing="0">
        <tr>
            <td align="right" colspan="right" class="td">jumlah Barang :</td>
            <td align="right" class="td"><?php echo $barang ?> Barang</td>
        </tr>
        <tr>
            <td align="right" colspan="right" class="td">Total :</td>
            <td align="right" class="td">Rp. <?php echo number_format($data['total_bayar']) ?></td>
        </tr>
        <tr>
            <td align="right" colspan="right" class="td">Jumlah Bayar :</td>
            <td align="right" class="td">Rp. <?php echo number_format($data['jumlah_bayar']) ?></td>
        </tr>
        <tr>
            <td align="right" colspan="right" class="td">Kembalian :</td>
            <td align="right" class="td">Rp. <?php echo number_format($data['kembalian']) ?></td>
        </tr>
        
        </table>
        <table width="250" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <br>
                <th class="tk"> -- Terima Kasih Sudah Belanja -- <br>
                </th>
            </tr>
        </table>
    </div>
</body>
<!--<script type="text/javascript">
window.print();
</script>-->
</html>