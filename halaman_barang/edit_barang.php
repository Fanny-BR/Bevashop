<?php
  $ambil=$koneksi->query("SELECT barang.id, barang.nama, barang.gambar, kategori.nama_kategori , barang.deskripsi
  FROM barang 
  JOIN kategori ON barang.id_kategori = kategori.id 
  WHERE barang.id='$_GET[id]'");
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
        <li><a href="index.php?page=editbarang" >Barang</a></li>
        <li class="active">Edit Barang</li>
      </ol>
    </section>
    </div>
    <br>
<div class="row">
<div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
              <div class="box-body">
              <div class="form-group">
                  <label for="des" class="col-sm-1 control-label"></label>
                <img class="col-sm-2" src="halaman_barang/images/<?php echo $data['gambar'] ?>"><br> 
                </div>
                <div class="form-group">
                <label for="gambar" class="col-sm-1  control-label">Gambar</label>
                  <div class="col-sm-10">
                      <input type="file" name="gambar">
                  </div>
                </div>
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label">ID</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="kode" value="<?php echo $data['id'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" name="nama" value="<?php echo $data['nama'] ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label">Deskripsi</label>

                  <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="inputEmail3" name="deskripsi" ><?php echo $data['deskripsi'] ?></textarea>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-1 control-label">Kategori</label>

                  <div class="col-sm-10">
                  <select name="kategori" id="kategori" class="form-control">
                      <?php $ambil = $koneksi->query("SELECT * FROM kategori");?>
                      <?php while($data = $ambil->fetch_assoc()){?>
                      <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_kategori']?></option>
                      <?php } ?>
                  </select>
                  </div>
                </div>
             
               
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
<!-- Memanggil function javascript rupiah -->
<?php include 'data/function_rupiah.php' ?>
<?php
  if (isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
  }
	if (isset($_POST['edit'])){
        $kode     = mysqli_real_escape_string($koneksi,$_POST ['kode']);
        $nama     = mysqli_real_escape_string($koneksi,$_POST ['nama']);
        $id_kategori     = mysqli_real_escape_string($koneksi,$_POST ['kategori']); 
        $deskripsi     = mysqli_real_escape_string($koneksi,$_POST ['deskripsi']); 
        $gambar      = $_FILES['gambar']['name'];
        $temp_name    = $_FILES['gambar']['tmp_name'];
        $namafile     = time().$gambar;
        $destination  = 'halaman_barang/images/'.$namafile;
        if(move_uploaded_file($temp_name,$destination)){
          $sql      = "UPDATE barang SET nama='$nama',id_kategori='$id_kategori' , gambar='$namafile', deskripsi='$deskripsi' WHERE id='$kode'";
          $query    = mysqli_query($koneksi, $sql);
          if($query){
            echo "<script>swal('Produk $nama Berhasil Diedit', '', 'success');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
          } else {
            echo "<script>swal({
              type: 'error',
              title: 'Edit Gagal',
              text: 'Produk $nama Gagal Diedit',
              footer: '<a href>Perlu Bantuan?</a>'
              })</script>";
              echo "<meta http-equiv='' content='1;url=index.php?page=barang'>";
          }
        }else{
        // /////////////////////////////
        // $id_kasir = $_SESSION['id'];
        // mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Mengedit Barang Dengan ID $kode')");
        // ////////////////////////////
        $sql = "UPDATE barang SET nama='$nama',id_kategori='$id_kategori' , deskripsi='$deskripsi' WHERE id='$kode'";
        $query    = mysqli_query($koneksi, $sql);
        if($query){
          echo "<script>swal('Produk $nama Berhasil Diedit', '', 'success');</script>";
          echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
        } else {
          echo "<script>swal({
            type: 'error',
            title: 'Edit Gagal',
            text: 'Produk $nama Gagal Diedit',
            footer: '<a href>Perlu Bantuan?</a>'
            })</script>";
            echo "<meta http-equiv='' content='1;url=index.php?page=barang'>";
        }
      }
    mysqli_close($koneksi);
	}
?>
<?php include 'data/validasi_form.php' ?>