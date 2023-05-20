<?php
	include("koneksi.php");
	if(isset($_GET['id_supplier']) ){
		$kode = $_GET['id_supplier'];
		$sql = "DELETE FROM supplier WHERE id_supplier='$kode'";
		$query = mysqli_query($koneksi, $sql);
		if($query) {
			echo "<script>swal('Supplier Berhasil Di Hapus', '', 'success');</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=supplier'>";
		} else {
			echo "<script>swal({
				type: 'error',
				title: 'Hapus Gagal',
				text: 'Supplier Gagal Di Hapus',
				footer: '<a href>Perlu Bantuan?</a>'
			})</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=supplier'>";
        }
        mysqli_close($koneksi);
    }
?>