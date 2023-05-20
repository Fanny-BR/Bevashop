<?php
ini_set('date.timezone', 'Asia/Jakarta');
$total_bayar = 0;
$qty = 0;
if(isset($_SESSION['keranjang'])){
  foreach ($_SESSION['keranjang'] as $key => $value){
        $total_bayar += $value['harga']*$value['qty'];
        $qty += $value['qty'];
  }
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
        <li class="active">Transaksi</li>
      </ol>
    </section>
    </div>
    <br>
<div class="row">
  <!-- general form elements -->
    <div class="col-lg-12">
  <div class="box box-info">
    <div class="box-body">
    <div class="col-lg-3">
    <form class="form-horizontal">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Date</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputEmail3" value="<?php echo date('Y-m-d');?>" readonly>
          </div>
        </div>
        <?php if ($_SESSION['level'] == 'Karyawan' ) { ?>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-3 control-label">Kasir</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" id="inputPassword3" value="<?php echo $_SESSION['nama'] ?>" readonly>
          </div>
        </div>
        <?php } ?>
    </form>
  </div>
      <div class="col-lg-9">
      <form class="form-horizontal" action="index.php?page=keranjang" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1" class="col-sm-2 control-label">Kode Barang</label>
          <div class="col-sm-10">
          <div class="input-group">
            <div class="input-group-btn">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Add</button>
            </div>
            <!-- /btn-group -->
            <input type="text" name="id_barang" placeholder="Masukan kode barang" class="form-control"
              value="<?php echo $_GET['id']; ?>" required>
          </div>
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1" class="col-sm-2 control-label">Qty</label>
          <div class="col-sm-10">
          <input type="number" name="jumlah" class="form-control" id="exampleInputEmail1"
            placeholder="masukan jumlah barang" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary pull-right col-sm-2" style="margin-top: 10px; font-size:20px;" name="tambah"><i class="fa fa-plus"></i> Tambah</button>
      </form>
    </div>
    
    

  </div>
  <!-- /.box -->
</div>
    </div>



<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Produk</h4>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>Stok</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $query = mysqli_query($koneksi, "SELECT barang.`id`,barang.`nama`, supplier.`nama` AS supplier, stok.`stok_masuk`, stok.`id`, stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
              FROM stok
              JOIN barang
              ON barang.`id`=stok.`id_barang`
              JOIN supplier
              ON supplier.`id_supplier`=stok.`id_supplier`
              where stok.stok_sekarang >= 1 "); 
              $jumlah = mysqli_num_rows($query);
              while ($data = mysqli_fetch_array($query)){
              ?>
            <tr>
              <td><?php echo $data['id'] ?></td>
              <td><?php echo $data['nama'] ?></td>
              <td><?php echo $data['stok_sekarang'] ?></td>
              <td><?php echo $data['harga'] ?></td>
              <td>
                <a href="index.php?page=pilihproduk&id=<?php echo $data['id'];?>" class="btn btn-info"><i
                    class="fa fa-check"></i> Pilih</a>
              </td>
            </tr>

            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->





<div class="col-md-12">
  <div class="box box-info">
    <div class="box-header with-border">
    <h4 class ="pull-right box-title" >Total Barang : <?php echo $qty ?> Barang</h4>
      <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Keranjang</h3>
      
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="index.php?page=updateqty" method="post">
        <table class="table table-bordered">
          <tr>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Sub Total</th>
            <th>Aksi</th>
          </tr>
          <?php foreach ($_SESSION['keranjang'] as $key => $value){?>
          <tr>
            <td><?=$value['id']?></td>
            <td><?=$value['nama']?></td>
            <td>Rp. <?=number_format($value['harga']) ?></td>
            <td class="col-sm-2"><input type="number" class="form-control" name="qty[]" value="<?=$value['qty']?>"></td>
            <td>Rp. <?=number_format($value['qty']*$value['harga'])?></td>
            <td>
              <button type="submit" class="btn btn-success">Perbarui</button>
              <a href="index.php?page=hapuskeranjang&id=<?=$value['id']?>" class="btn btn-danger"><i
                  class="fa fa-trash"></i> Hapus</a>
            
            </td>
          </tr>
          <?php } ?>
        </table>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

<div class="col-lg-12">
  <!-- Horizontal Form -->
  <div class="box box-info">
  <br>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" action="index.php?page=prosesbayar" method="post"">
      <div class="box-body">
        <div class="form-group">
          <label for="totalbayar" class="col-sm-3 control-label">Total Bayar</label>
          <div class="col-sm-9">
            <input type="text" readonly style="font-size:20px; font-weight: bold;"
              value="Rp. <?php echo number_format($total_bayar) ?>" class="form-control">
              <input type="hidden" readonly style="font-size:20px; font-weight: bold;"
              value="<?php echo $total_bayar ?>" class="form-control" id="totalbayar">
          </div>
        </div>

        <input type="hidden" name="idkasir" value="<?php echo $_SESSION['id'] ?>">
        <input type="hidden" name="total" value="<?php echo $total_bayar ?>">

        <div class="form-group">
          <label for="bayar" class="col-sm-3 control-label">Bayar</label>
          <div class="col-sm-9">
            <input type="text" name="bayar" id="diskonglobal" style="font-size:20px; font-weight: bold;" class="form-control" placeholder="Masukan Jumlah Bayar" required>
          </div>
        </div>
        
<div class="col-sm-12">
  <br>
  <div class="row">
    <div class="col-sm-2">
      <button type="submit" style="margin-top: 10px; font-size:20px;" class="btn btn-success"><i class="fa fa-money"></i> Proses Pembayaran</button>
      </form>
    </div>
    <div class="col-sm-10">
      <a href="index.php?page=reset" style="margin-top: 10px; font-size:20px;" class="pull-right btn btn-warning"><i class="fa fa-refresh"></i> Batal</a>
    </div>
  </div>
</div>
<!-- 
        <div class="form-group">
          <label for="bayar" class="col-sm-3 control-label">Diskon</label>
          <div class="col-sm-3">
            <input type="text" name="diskonglobal" id="diskonglobal" style="font-size:20px; font-weight: bold;" class="form-control" placeholder="%">
          </div>
        </div> -->
<!-- 
        <div class="form-group">
          <label for="bayar" class="col-sm-3 control-label">Sub Total Bayar</label>
          <div class="col-sm-9">
            <input type="text" id="hargatotal" style="font-size:20px; font-weight: bold;" class="form-control" readonly>
          </div>
        </div> -->

      </div>
      <!-- /.box-body -->

<!-- Memanggil function javascript rupiah -->
<?php include 'data/function_rupiah.php' ?>

      <!-- /.box-footer -->
      <br>
  </div>
  <!-- /.box -->
</div>




<script type="text/javascript">
 function rubah(angka){
   var reverse = angka.toString().split('').reverse().join(''),
   ribuan = reverse.match(/\d{1,3}/g);
   ribuan = ribuan.join(',').split('').reverse().join('');
   return ribuan;
 }

  $(document).ready(function(){
      $("#diskonglobal").keyup(function(){
        var harga  = parseInt($("#totalbayar").val());
        var diskon  = parseInt($("#diskonglobal").val());
        var total = diskon - harga ;
        $("#hargatotal").val("Rp. " + rubah(total));     
      });
  });

</script>