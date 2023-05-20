<?php ob_start(); 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include '../data/function_dateindo.php';
?>

<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse;
			table-layout:fixed;width: 520px;
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
        $datein = format_indo(date('Y-m-d'));
        $nama = "Data Stok Barang Pada $date1.pdf";
        // echo '<img src = "../Berdiri.png">';
        echo '<b><div align="center">
       
        Data Stok Barang pada '.$datein.'</div></b><br /><br />';
        $query = "SELECT stok.`id`, barang.`nama`, supplier.`nama` AS supplier, stok.`stok_masuk`,  stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
        FROM stok
        JOIN barang
        ON barang.`id`=stok.`id_barang`
        JOIN supplier
        ON supplier.`id_supplier`=stok.`id_supplier`"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    
    ?>
	<table border="1" cellpadding="8">
	<tr>
        <th align="center">ID</th>
            <th align="center">Nama Barang</th>
            <th align="center">Supplier</th>
            <th align="center">Stok Masuk</th>
            <th align="center">Stok Sekarang</th>
            <th align="center">Tanggal Masuk</th>
            <th align="center">Harga</th>
	</tr>
    <?php
    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
            $tgl = date('d-m-Y', strtotime($data['tanggal'])); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl2 = date('d-m-Y', strtotime($data['kadaluarsa'])); // Ubah format tanggal jadi dd-mm-yyyy
            $totall = $totall+$data['total'];
            echo "<tr>";
            
            echo "<td align='center'>".$data['id']."</td>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>".$data['supplier']."</td>";
            echo "<td align='center'>".$data['stok_masuk']."</td>";
            echo "<td align='center'>".$data['stok_sekarang']."</td>";
            echo "<td>".$tgl."</td>";
            echo "<td>Rp. ".number_format($data['harga'])."</td>";
            echo "</tr>";
        }
    }else{ // Jika data tidak ada
        echo "<tr><td colspan='6'>Data tidak ada</td></tr>";
    }
    ?>
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
