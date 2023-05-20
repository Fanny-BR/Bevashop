
<?php
	include("koneksi.php");
	if( isset($_GET['id']) ){
	
		$kode = $_GET['id'];
		/////////////////////////////
		// $id_kasir = $_SESSION['id'];
		// // $nama     = mysqli_real_escape_string($koneksi,$_POST ['nama']);
		// mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Meghapus Barang Dengan ID $kode')");
		// ////////////////////////////
		$sql = "DELETE FROM barang WHERE id='$kode'";
		
		$query = mysqli_query($koneksi, $sql);
		
		if($query) {
			echo "<script>swal('Produk $kode Berhasil Di Hapus', '', 'success');</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
		} else {
			echo "<script>swal({
				type: 'error',
				title: 'Hapus Gagal',
				text: 'Produk $kode Gagal Di Hapus',
				footer: '<a href>Perlu Bantuan?</a>'
		})</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
        }
        mysqli_close($koneksi);
    }
    

?>