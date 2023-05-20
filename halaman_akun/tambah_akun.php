<?php
   if (isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='1;url=index.php?page=akun'>";
  }
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
    <li class="active">Tambah Akun</li>
    </ol>
</section>
</div>

<br>
<div class="row">
    <div class="col-lg-12">
        <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Buat Akun</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form  class="form-horizontal " method="post" enctype="multipart/form-data">
            <div class="box-body">
            <div class="form-group">
                <label for="username" class="col-sm-1 control-label">Username</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="Inputusername" name="username"
                    placeholder="Masukan username" required>
                <span class="text-warning"></span>
                <span id="pesan"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-1 control-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Masukan password" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmpassword" class="col-sm-1 control-label">Konfirmasi Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                    placeholder="Masukan password" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-1 control-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama lengkap" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nomor" class="col-sm-1 control-label">Nomor</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Masukan nomor hp" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-sm-1 control-label">Alamat</label>
                <div class="col-sm-10">
                <textarea cols="52" id="alamat" name="alamat" rows="5"></textarea>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="level" class="col-sm-1 control-label">Level</label>
                <div class="col-sm-10">
                <select name="level" id="level" class="form-control">
                    <option value="">-- Pilih Level --</option>
                    <?php $ambil = $koneksi->query("SELECT * FROM level");?>
                    <?php while ($data = $ambil->fetch_assoc()) {?>
                    <option value="<?php echo $data['id']; ?>"required><?php echo $data['nama_level']; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <label for="profil" class="col-sm-1  control-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" name="profil">
                </div>
            </div>
            
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <div class="col-sm-1 btn"></div>
            <button type="submit" name="simpan" class="btn btn-info">Daftar</button>
            <!-- <button type="warning" name="cancel" class="btn btn-Warning ">Cancel</button> -->
            </div>
            <!-- /.box-footer -->
        </form>
        </div>
        <!-- /.box -->
    </div>
    <?php


    if (isset($_POST['simpan'])) {
        $username     = mysqli_real_escape_string($koneksi, $_POST ['username']);
        $password     = mysqli_real_escape_string($koneksi, $_POST ['password']);
        $nama         = mysqli_real_escape_string($koneksi, $_POST ['nama']);
        $nomor        = mysqli_real_escape_string($koneksi, $_POST ['nomor']);
        $alamat       = mysqli_real_escape_string($koneksi, $_POST ['alamat']);
        $level        = mysqli_real_escape_string($koneksi, $_POST ['level']);
        $profile       = $_FILES['profil']['name'];
        $temp_name     = $_FILES['profil']['tmp_name'];
        $namafile   = time().$profile;
        $destination    = 'halaman_akun/images/'.$namafile;
        if(move_uploaded_file($temp_name,$destination)){
        

        $sql          = "INSERT INTO user (username, password, nama, nomor, alamat, id_level, gambar) 
        values ('$username', '$password', '$nama', '$nomor', '$alamat', '$level', '$namafile')";
        $query        = mysqli_query($koneksi, $sql);
        if ($query) {
            
            // $id_kasir = $_SESSION['id'];
            // mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Menambah Akun Dengan Nama $nama')");
            
            echo "<script>swal('Akun Berhasil Dibuat', 'Selamat Datang $username', 'success');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=akun'>";
            } else {
            echo "<script>swal({
            type: 'error',
            title: 'Buat Akun Gagal',
            text: 'Data Gagal Ditambah.',
            footer: '<a href>Perlu Bantuan?</a>'
            })</script>";
            echo "<meta http-equiv='' content='1;url=index.php?page=akun'>";
        }
    }
        mysqli_close($koneksi);
    }

?>
<?php include 'data/validasi_form.php' ?>

<?php include 'data/cekakun.php'; ?>