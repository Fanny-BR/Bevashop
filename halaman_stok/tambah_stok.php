<?php
   if (isset($_POST['cancel'])){
    echo "<meta http-equiv='refresh' content='1;url=index.php?page=stok'>";
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
    <li><a href="index.php?page=stok">Stok</a></li>
    <li class="active">Tambah Stok</li>
    </ol>
</section>
</div>

<br>
<div class="row">
    <div class="col-lg-12">
        <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Stok</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form  class="form-horizontal " method="post" >
            <div class="box-body">
            
            <div class="form-group">
                <label for="barang" class="col-sm-1 control-label">Nama</label>
                <div class="col-sm-10">
                <select name="barang" id="barang" class="form-control">
                    <option value="">-- Pilih Barang --</option>
                    <?php $ambil = $koneksi->query("SELECT * FROM barang");?>
                    <?php while ($data = $ambil->fetch_assoc()) {?>
                    <option value="<?php echo $data['id']; ?>"required><?php echo $data['nama']; ?></option>
                    <?php } ?>
                </select>
                
                </div>
            </div>

            <div class="form-group">
                <label for="supplier" class="col-sm-1 control-label">Supplier</label>
                <div class="col-sm-10">
                <select name="supplier" id="supplier" class="form-control">
                    <option value="">-- Pilih Supplier --</option>
                    <?php $ambil = $koneksi->query("SELECT * FROM supplier");?>
                    <?php while ($data = $ambil->fetch_assoc()) {?>
                    <option value="<?php echo $data['id_supplier']; ?>"required><?php echo $data['nama']; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>

            <div class="form-group">
                <label for="stok" class="col-sm-1 control-label">Stok Masuk</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukan Stok" required>
                <span class="text-warning"></span>
                </div>
            </div>
            
            <!-- <div class="form-group">
                <label for="tanggal" class="col-sm-1 control-label">Tanggal Masuk</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="tanggal" name="tanggal"  required>
                <span class="text-warning"></span>
                </div>
            </div> -->
            
            <!-- <div class="form-group">
                <label for="kadaluarsa" class="col-sm-1 control-label">Kadaluarsa</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="kadaluarsa" name="kadaluarsa"  required>
                <span class="text-warning"></span>
                </div>
            </div>-->
            
            <div class="form-group">
                <label for="harga" class="col-sm-1 control-label">Harga</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required>
                <span class="text-warning"></span>
                </div>
            </div>
            
            

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <div class="col-sm-1 btn"></div>
            <button type="submit" name="tambah" class="btn btn-info">Tambah</button>
            <!-- <button type="warning" name="cancel" class="btn btn-Warning ">Cancel</button> -->
            </div>
            <!-- /.box-footer -->
        </form>
        </div>
        <!-- /.box -->
    </div>
    <?php


    if (isset($_POST['tambah'])) {
        $barang     = mysqli_real_escape_string($koneksi, $_POST ['barang']);
        $supplier     = mysqli_real_escape_string($koneksi, $_POST ['supplier']);
        $stok         = mysqli_real_escape_string($koneksi, $_POST ['stok']);
        $tanggal        = mysqli_real_escape_string($koneksi, $_POST ['tanggal']);
       // $kadaluarsa       = mysqli_real_escape_string($koneksi, $_POST ['kadaluarsa']);
        $harga        = mysqli_real_escape_string($koneksi, $_POST ['harga']);
        
        
        // $id_kasir = $_SESSION['id'];
        // mysqli_query($koneksi, "INSERT INTO aktivitas (tanggal, id_user, aktivitas) values (now(), '$id_kasir' , 'Menambah Stok $barang')");
    
        $sql          = "INSERT INTO stok (id_barang, id_supplier, stok_masuk, stok_sekarang, harga, tanggal) 
        values ('$barang', '$supplier', '$stok', '$stok',  '$harga',NOW())";
        $query        = mysqli_query($koneksi, $sql);
        if ($query) {
            echo "<script>swal('Stok Berhasil Dibuat', 'Tambah Stok Berhasil', 'success');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=stok'>";
            } else {
            echo "<script>swal({
            type: 'error',
            title: 'Buat Stok Gagal',
            text: 'Data Gagal Ditambah.',
            footer: '<a href>Perlu Bantuan?</a>'
            })</script>";
            echo "<meta http-equiv='' content='1;url=index.php?page=stok'>";
        }
    
        mysqli_close($koneksi);
    }

?>
<?php include 'data/validasi_form.php' ?>

<?php include 'data/cekakun.php'; ?>