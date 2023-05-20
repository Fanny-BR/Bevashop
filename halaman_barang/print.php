<?php
	include('../koneksi.php');
	$query = "SELECT barang.id, barang.nama, kategori.nama_kategori
    FROM barang, kategori
    WHERE barang.id_kategori = kategori.id";
	$sql = mysqli_query ($koneksi,$query);
	$data = array();
	while ($row = mysqli_fetch_assoc($sql)){
		array_push($data,$row);
	}
	$judul = "Data Barang";
	$header = array(
		array("label"=>"ID", "length"=>30, "align"=>"C"),
		array("label"=>"NAMA BARANG", "length"=>125, "align"=>"C"),
		array("label"=>"KATEGORI", "length"=>120, "align"=>"C"),
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
	$pdf->Output('I','DATA BARANG.pdf');
?>