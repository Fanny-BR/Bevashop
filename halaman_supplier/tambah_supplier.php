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
    <li><a href="index.php?page=supplier">Supplier</a></li>
    <li class="active">Tambah Supplier</li>
    </ol>
</section>
</div>

<br>
<div class="row">
    <div class="col-lg-12">
        <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Supplier</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal " method="post">
            <div class="box-body">
            <div class="form-group">
                <label for="username" class="col-sm-1 control-label">Kode</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="kode" name="kode"required>
                <span class="text-warning"></span>
                <span id="pesan"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-sm-1 control-label">Nama Supplier</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nomor" class="col-sm-1 control-label">Nomor</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nomor" name="nomor" required>
                <span class="text-warning"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-sm-1 control-label">Alamat</label>
                <div class="col-sm-10">
                <textarea required cols="52" id="alamat" name="alamat" rows="5"></textarea>
                <span class="text-warning"></span>
                </div>
            </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <div class="col-sm-1 btn"></div>
            <button type="submit" name="simpan" class="btn btn-info">Tambah</button>
            <!-- <button type="warning" name="cancel" class="btn btn-Warning ">Cancel</button> -->
            </div>
            <!-- /.box-footer -->
        </form>
        </div>
        <!-- /.box -->
    </div>
    <?php
 
    if (isset($_POST['simpan'])) {
        $kode         = mysqli_real_escape_string($koneksi, $_POST ['kode']);
        $nama         = mysqli_real_escape_string($koneksi, $_POST ['nama']);
        $nomor        = mysqli_real_escape_string($koneksi, $_POST ['nomor']);
        $alamat       = mysqli_real_escape_string($koneksi, $_POST ['alamat']);
        $sql          = "INSERT INTO supplier (id_supplier, nama, telepon, alamat) values ('$kode', '$nama', '$nomor', '$alamat')";
        $query        = mysqli_query($koneksi, $sql);
        if ($query) {
            echo "<script>swal('Supplier Berhasil Ditambah', '$nama', 'success');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=supplier'>";
            } else {
            echo "<script>swal({
            type: 'error',
            title: 'Tambah Supplier Gagal',
            text: 'Data Gagal Ditambah.',
            footer: '<a href>Perlu Bantuan?</a>'
            })</script>";
            echo "<meta http-equiv='' content='1;url=index.php?page=supplier'>";
        }
        mysqli_close($koneksi);
    }

?>
<?php include 'data/validasi_form.php' ?>

<?php include 'data/ceksupplier.php'; ?>