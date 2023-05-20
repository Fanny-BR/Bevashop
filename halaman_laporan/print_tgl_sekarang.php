<?php ob_start(); 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include 'data/function_dateindo.php';
?>

<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse;
			table-layout:fixed;width: 630px;
		}
		table td {
			word-wrap:break-word;
			width: 20%;
		}
	</style>
</head>
<body>
<?php
include '../koneksi.php';
ini_set('date.timezone', 'Asia/Jakarta');
        $date = date('Y-m-d', strtotime('now'));
        $date1 = date('d-m-Y', strtotime('now'));
        // $datein = format_indo(date('Y-m-d'));
        $nama = "Data Transaksi $date1.pdf";
        echo '<b><div align="center">
        Data Transaksi '.$date1.'</div></b><br /><br />';
        $query = "SELECT transaksi.tgl_transaksi,transaksi.no_invoice, detail_transaksi.id_stok, barang.nama, detail_transaksi.harga, detail_transaksi.qty, detail_transaksi.total
        FROM detail_transaksi
        JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
        JOIN stok ON detail_transaksi.id_stok = stok.id 
        JOIN barang ON stok.id_barang = barang.id WHERE DATE(tgl_transaksi)='$date'"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    
    ?>
	<table border="1" cellpadding="8">
	<tr>
        <th align="center">Tanggal</th>
            <th align="center">No Invoice</th>
            <th align="center">Nama</th>
            <th align="center">Harga</th>
            <th align="center">QTY</th>
            <th class="bg-primary">Total</th>
	</tr>
    <?php
    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
            $tgl = date('d-m-Y', strtotime($data['tgl_transaksi'])); // Ubah format tanggal jadi dd-mm-yyyy
            $totall = $totall+$data['total'];
            echo "<tr>";
            echo "<td>".$tgl."</td>";
            echo "<td>".$data['no_invoice']."</td>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>Rp. ".number_format($data['harga'])."</td>";
            echo "<td>".$data['qty']."</td>";
            echo "<td class='bg-primary'>Rp.".number_format($data['total'])."</td>";
            echo "</tr>";
        }
    }else{ // Jika data tidak ada
        echo "<tr><td colspan='6'>Data tidak ada</td></tr>";
    }
    ?>
    <tfoot>
    <tr  class="bg-primary">
        <th colspan="5">Total Penjualan</th>
            <th>Rp. <?php echo number_format($totall) ?></th>
            </tr>
    </tfoot>
	</table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require_once('../bower_components/html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output($nama, 'D');
?>
