<?php
	include('../koneksi.php');
    ini_set('date.timezone', 'Asia/Jakarta');
    include '../data/function_dateindo.php';
    $date = date('Y-m-d');
	$query = "SELECT transaksi.no_invoice, transaksi.tgl_transaksi, transaksi.jam_transaksi,user.nama 
    FROM transaksi, user
    WHERE transaksi.id_user = user.id";
	$sql = mysqli_query ($koneksi,$query);
	$data = array();
	while ($row = mysqli_fetch_assoc($sql)){
		array_push($data,$row);
	}
	$judul = "Data Riwayat Transaksi";
	$header = array(
		array("label"=>"NO INV", "length"=>50, "align"=>"C"),
		array("label"=>"TANGGAL", "length"=>75, "align"=>"C"),
		array("label"=>"JAM", "length"=>75, "align"=>"C"),
		array("label"=>"NAMA", "length"=>75, "align"=>"C")
	);
	require('../fpdf/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage('L','A4');
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,20,$judul,'0',1,'C');
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(0,255,10);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(128,0,0);
	foreach ($header as $kolom) {
		$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0',$kolom['align'],true);
	}
	$pdf->Ln();
	$pdf->SetFillColor(220,255,220);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');
	$fill=false;
	foreach ($data as $baris) {
		$i = 0;
		foreach ($baris as $cell){
			$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0',$kolom['align'], $fill);
			$i++;
		}
		$fill = !$fill;
		$pdf->Ln();
	}
	$pdf->Output('I','DATA RIWAYAT TRANSAKSI.pdf');
?>