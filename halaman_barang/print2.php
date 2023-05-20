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
			table-layout:fixed;width: 1230px;
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
        $nama = "Data Barang Pada $date1.pdf";
        // echo '<img src = "../Berdiri.png">';
        echo '<b><div align="center">
       
        Data Barang '.$datein.'</div></b><br /><br />';
        $query = "SELECT barang.id, barang.nama, kategori.nama_kategori
        FROM barang, kategori
        WHERE barang.id_kategori = kategori.id"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
    
    ?>
	<table border="1" cellpadding="8">
	<tr>
        <th align="center">ID</th>
            <th align="center">Nama Barang</th>
            <th align="center">Kategori</th>
	</tr>
    <?php
    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
            $tgl = date('d-m-Y', strtotime($data['tgl_transaksi'])); // Ubah format tanggal jadi dd-mm-yyyy
            $totall = $totall+$data['total'];
            echo "<tr>";
            
            echo "<td>".$data['id']."</td>";
            echo "<td>".$data['nama']."</td>";
            echo "<td>".$data['nama_kategori']."</td>";
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
