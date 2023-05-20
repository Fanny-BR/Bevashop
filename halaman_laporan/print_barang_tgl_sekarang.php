<?php
    ini_set('date.timezone', 'Asia/Jakarta');
    include '../data/function_dateindo.php';
    $date = date('Y-m-d');
	include('../koneksi.php');
	$query = "SELECT stok.`id`, barang.`nama`, supplier.`nama` AS supplier, stok.`stok_masuk`,  stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
    FROM stok
    JOIN barang
    ON barang.`id`=stok.`id_barang`
    JOIN supplier
    ON supplier.`id_supplier`=stok.`id_supplier`
    WHERE  and stok.tanggal='$date'";
	$sql = mysqli_query ($koneksi,$query);
	$data = array();
	while ($row = mysqli_fetch_assoc($sql)){
		array_push($data,$row);
    }
    $tgl = format_indo(date('Y-m-d')); 
	$judul = "Data Stok Masuk $tgl ";
	$header = array(
		array("label"=>"ID", "length"=>15, "align"=>"C"),
		array("label"=>"NAMA BARANG", "length"=>50, "align"=>"C"),
		array("label"=>"SUPPLIER", "length"=>35, "align"=>"C"),
		array("label"=>"STOK MASUK", "length"=>35, "align"=>"C"),
		array("label"=>"STOK SEKARANG", "length"=>35, "align"=>"C"),
		array("label"=>"TANGGAL", "length"=>35, "align"=>"C"),
		array("label"=>"HARGA", "length"=>35, "align"=>"C")
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
    $title = "DATA STOK MASUK $tgl.pdf";
	$pdf->Output('I',$title);
?>