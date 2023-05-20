<?php
  $ambil=$koneksi->query("SELECT user.id, user.username, user.alamat, user.password, user.nama, user.nomor, user.id_level,user.gambar, level.nama_level
  FROM user, level
  WHERE user.id_level = level.id
  AND user.id='$_SESSION[id]'");
  $data=$ambil->fetch_array(MYSQLI_ASSOC);
  ?>
  <div class="row">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="index.php?page=akun">Akun</a></li>
        <li class="active">Edit Profil</li>
      </ol>
    </section>
    </div>
    <br>
  <div class="row">
<div class="col-lg-12">
  <!-- Horizontal Form -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Profil</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="box-body">
      
      <div class="form-group">
          <label for="des" class="col-sm-1 control-label">Foto</label>
        <img class="col-sm-2" src="halaman_akun/images/<?php echo $data['gambar'] ?>"><br> 
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Username</label>

          <div class="col-sm-10">
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
            <input readonly type="text" class="form-control" id="inputEmail3" name="username"
              value="<?php echo $data['username'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-1 control-label">Password</label>

          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" name="password"
              value="<?php echo $data['password'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Nama</label>

          <div class="col-sm-10">
            <input readonly type="text" class="form-control" id="inputEmail3" name="nama" value="<?php echo $data['nama'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Nomor</label>

          <div class="col-sm-10">
            <input readonly type="text" class="form-control" id="inputEmail3" name="nomor" value="<?php echo $data['nomor'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Alamat</label>

          <div class="col-sm-10">
            <textarea cols="52" name="alamat" rows="5" readonly><?php echo $data['alamat'] ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">Level</label>

          <div class="col-sm-10">
            <input readonly type="text" class="form-control" id="inputEmail3" name="level" value="<?php echo $data['nama_level'] ?>">
          
            
          </div>
        </div>
        
        <!-- <div class="form-group">
        <label for="profil" class="col-sm-1  control-label">Foto</label>
          <div class="col-sm-10">
              <input type="file" name="profil" >
          </div>
        </div> -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-1 btn"></div>
      <button type="submit" name="edit" class="btn btn-info ">Edit</button>
        
      <button type="warning" name="cancel" class="btn btn-Warning ">Cancel</button>
      </div>
      <!-- /.box-footer -->
    </form>
  </div>
  <!-- /.box -->
</div>
</div>

<?php

  if (isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
  }
	if (isset($_POST['edit'])){
        $id = mysqli_real_escape_string($koneksi,$_POST ['id']);
        $username     = mysqli_real_escape_string($koneksi,$_POST ['username']);
        $password     = mysqli_real_escape_string($koneksi,$_POST ['password']);
        $nama         = mysqli_real_escape_string($koneksi,$_POST ['nama']);
        $nomor        = mysqli_real_escape_string($koneksi,$_POST ['nomor']);
        $alamat       = mysqli_real_escape_string($koneksi,$_POST ['alamat']);
        $level        = mysqli_real_escape_string($koneksi,$_POST ['level']);
        // $profile       = $_FILES['profil']['name'];
        // $temp_name     = $_FILES['profil']['tmp_name'];
        // $namafile   = time().$profile;
        // $destination    = 'halaman_akun/images/'.$namafile;
        // if(move_uploaded_file($temp_name,$destination)){

        $sql          = "UPDATE user SET username='$username', password='$password', nama='$nama', nomor='$nomor', alamat='$alamat' WHERE id='$id'";
        $query        = mysqli_query($koneksi, $sql);
		if( $query){
      	
      // $id_kasir = $_SESSION['id'];
      // mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Mengedit Password')");
      
			echo "<script>swal('Data Akun Berhasil Diupdate', '', 'success');</script>";
			echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		} else {
			echo "<script>swal({
				type: 'error',
				title: 'Hapus Gagal',
				text: 'Data Akun Gagal Diupdate',
				footer: '<a href>Perlu Bantuan?</a>'
      })</script>";
        echo "<meta http-equiv='' content='1;url=index.php'>";
    }
  // }
    mysqli_close($koneksi);
	}

?>