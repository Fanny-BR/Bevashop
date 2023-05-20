<?php
	include("koneksi.php");
	if(isset($_GET['id']) ){
		$kode = $_GET['id'];
		$sql = "DELETE FROM stok WHERE id='$kode'";
		
		/////////////////////////////
		// $id_kasir = $_SESSION['id'];
		// mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Meghapus Stok $kode')");
		// ////////////////////////////
		$query = mysqli_query($koneksi, $sql);
		if($query) {
			echo "<script>swal('Data Stok Berhasil Dihapus', '', 'success');</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=stok'>";
		} else {
			echo "<script>swal({
				type: 'error',
				title: 'Hapus Gagal',
				text: 'Data Stok gagal dihapus',
				footer: '<a href>Perlu Bantuan?</a>'
			})</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=stok'>";
        }
        mysqli_close($koneksi);
    }
?>