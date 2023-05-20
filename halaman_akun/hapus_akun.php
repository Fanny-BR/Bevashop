<?php
	include("koneksi.php");
	$ambil=$koneksi->query("SELECT user.id, user.username, user.alamat, user.password, user.nama, user.nomor, user.id_level, user.gambar, level.nama_level
	FROM user, level
	WHERE user.id_level = level.id
	AND user.id='$_GET[id]'");
	$data=$ambil->fetch_array(MYSQLI_ASSOC);
	?>
	<form class="form-horizontal" method="post">
		<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
		<input type="hidden" class="form-control" id="inputEmail3" name="username"
		value="<?php echo $data['username'] ?>">
	</form>
	<?php
	if($_GET['id'] == $_SESSION['id'] ){
		echo "<script>swal({
			type: 'error',
			title: 'Hapus Gagal',
			text: 'Data akun gagal dihapus',
			footer: '<a href>Perlu Bantuan?</a>'
		})</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?page=akun'>";
	}

	if( $_GET['id'] != $_SESSION['id'] ) {
		$kode = $_GET['id'];
		$nama = $_GET['nama'];	
		$sql = "DELETE FROM user WHERE id='$kode'";
		$query = mysqli_query($koneksi, $sql);
		if($query) {	
			
			// $id_kasir = $_SESSION['id'];
			// mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Menghapus Akun Dengan ID $kode')");
			
			echo "<script>swal('Data akun Berhasil Dihapus', '', 'success');</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=akun'>";
		
		} else {
			echo "<script>swal({
				type: 'error',
				title: 'Hapus Gagal',
				text: 'Data akun gagal dihapus',
				footer: '<a href>Perlu Bantuan?</a>'
			})</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php?page=akun'>";
        }
        mysqli_close($koneksi);
    }
?>