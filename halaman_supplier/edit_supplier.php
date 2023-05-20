<?php
$ambil=$koneksi->query("SELECT * from supplier where id_supplier='$_GET[id_supplier]'");
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
        <li><a href="index.php?page=supplier">Supplier</a></li>
        <li class="active">Edit Supplier</li>
    </ol>
    </section>
    </div>
    <br>
<div class="row">
<div class="col-lg-12">
<!-- Horizontal Form -->
<div class="box box-info">
    <div class="box-header with-border">
    <h3 class="box-title">Edit Supplier</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post">
    <div class="box-body">
      
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">Nama Supplier</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="nama" value="<?php echo $data['nama'] ?>">
            <input type="hidden" name="id_supplier" value="<?php echo $data['id_supplier'] ?>">
        
        </div>
        </div>
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">Nomor</label>

        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" name="nomor" value="<?php echo $data['telepon'] ?>">
        </div>
        </div>
        <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label">Alamat</label>

        <div class="col-sm-10">
            <textarea cols="52" name="alamat" rows="5"><?php echo $data['alamat'] ?></textarea>
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

<?php

if (isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='1;url=index.php?page=supplier'>";
}
    if (isset($_POST['edit'])){
        $kode         = mysqli_real_escape_string($koneksi,$_POST ['id_supplier']);
        $nama         = mysqli_real_escape_string($koneksi,$_POST ['nama']);
        $nomor        = mysqli_real_escape_string($koneksi,$_POST ['nomor']);
        $alamat       = mysqli_real_escape_string($koneksi,$_POST ['alamat']);
        $sql          = "UPDATE supplier SET nama='$nama', telepon='$nomor', alamat='$alamat' WHERE id_supplier='$kode'";
        $query        = mysqli_query($koneksi, $sql);
        if( $query){
            echo "<script>swal('Data Supplier $nama Berhasil Diupdate', '', 'success');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=supplier'>";
        } else {
            echo "<script>swal({
                type: 'error',
                title: 'Hapus Gagal',
                text: 'Data Supplier Gagal Diupdate',
                footer: '<a href>Perlu Bantuan?</a>'
        })</script>";
        echo "<meta http-equiv='' content='1;url=index.php?page=supplier'>";
    }
    mysqli_close($koneksi);
    }

?>
<?php include 'data/validasi_form.php' ?>