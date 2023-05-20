<?php
$barang = $koneksi->query("SELECT * FROM menipis
WHERE stok_total <= '5';");
$no1 = $barang->num_rows;
?>

<?php
$date = date('Y-m-d');
$tgl2 = date('Y-m-d', strtotime('+6 days', strtotime($date))); //operasi penjumlahan tanggal sebanyak 6 hari
// echo $tgl2; //print tanggal

//$kdl = $koneksi->query("SELECT barang.`nama`, stok.`stok_masuk`, stok.`id`, stok.`stok_sekarang`,stok.`tanggal`,stok.`kadaluarsa`,stok.`harga`
//FROM stok
//JOIN barang
//ON barang.`id`=stok.`id_barang`
//WHERE kadaluarsa <= '$tgl2' and kadaluarsa >= now();");
//$no = $kdl->num_rows;
//$ttl= $no + $no1;

//if($no1>0 && $no>0){
//  echo "<script>swal('Ada $ttl Barang yang Stoknya Menipis & Hampir Kadaluarsa', '', 'info');</script>"; 
//} 
//elseif($no>0){
//  echo "<script>swal('Ada $no Barang Hampir Kadaluarsa', '', 'info');</script>";
//}  
if($no1>0){
  echo "<script>swal('Saat nya bayar kos', '', 'info');</script>";
} 
?>
<?php
$date = date('Y-m-d');

$kdla = $koneksi->query("SELECT barang.`nama`, stok.`stok_masuk`, stok.`id`, stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
FROM stok
JOIN barang
ON barang.`id`=stok.`id_barang`
WHERE kadaluarsa <= now();");
?>
<div class="modal fade" id="stok" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Stok Barang Yang akan Habis</h4>
    </div>
    <div class="modal-body">
    <table class="table table-bordered table-striped">
  <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Stok Sekarang</th>
        </tr>
      </thead>
      <tbody>
<?php
while ($data = mysqli_fetch_array($barang)){
  ?>
<tr>
<td><?php echo $data['id'] ?></td>
<td><?php echo $data['nama'] ?></td>
<td><?php echo $data['stok_total'] ?></td>
</tr>
<?php }?>
</tbody>
</table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="kdl" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="kdl" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Stok Barang Yang akan Kadaluarsa</h4>
    </div>
    <div class="modal-body">
    <table class="table table-bordered table-striped">
  <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Stok Sekarang</th>
          <th>Kadaluarsa</th>
        </tr>
      </thead>
      <tbody>
<?php
while ($data = mysqli_fetch_array($kdl)){
  ?>
<tr>
<td><?php echo $data['id'] ?></td>
<td><?php echo $data['nama'] ?></td>
<td><?php echo $data['stok_sekarang'] ?></td>
<td><?php echo $data['kadaluarsa'] ?></td>
</tr>
<?php }?>
</tbody>
</table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="kdla" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="kdla" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Stok Barang Yang Kadaluarsa</h4>
    </div>
    <div class="modal-body">
    <table class="table table-bordered table-striped">
  <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Stok Sekarang</th>
          <th>Kadaluarsa</th>
        </tr>
      </thead>
      <tbody>
<?php
while ($data = mysqli_fetch_array($kdla)){
  ?>
<tr>
<td><?php echo $data['id'] ?></td>
<td><?php echo $data['nama'] ?></td>
<td><?php echo $data['stok_sekarang'] ?></td>
<td><?php echo $data['kadaluarsa'] ?></td>
</tr>
<?php }?>
</tbody>
</table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


<div class="row">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" >Stok</li>
      </ol>
    </section>
    </div>
    <br>
   
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Stok Barang</h3>
            
  </div>

  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
    <a href="index.php?page=tambahstok" class="btn btn-primary"><i class="fa fa-plus" ></i> Tambah Stok</a>
    <a>  </a>
        <a href="halaman_stok/print2.php" class="btn btn-danger"><i class="fa fa-print"></i> Cetak PDF</a>
    <a>  </a>
    <a data-toggle="modal" href="#stok" class="btn btn-success"><i class="fa fa-filter"></i> Stok Barang Menipis</a>
            
    <br><br>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nama Barang</th>
          <th>Supplier</th>
          <th>Stok Awal</th>
          <th>Stok Sekarang</th>
          <th>Tanggal Masuk</th>
          <th>Harga</th>
          <!-- <th>Aksi</th> -->
        </tr>
      </thead>
      <tbody>
        <?php 
        include 'data/function_dateindo.php';
              $query = mysqli_query($koneksi, "SELECT barang.`nama`, supplier.`nama` AS supplier, stok.`stok_masuk`, stok.`id`, stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
              FROM stok
              JOIN barang
              ON barang.`id`=stok.`id_barang`
              JOIN supplier
              ON supplier.`id_supplier`=stok.`id_supplier`
              ;
              ");
              $jumlah = mysqli_num_rows($query);
              while ($data = mysqli_fetch_array($query)){
              ?>
        <tr>
          <td><?php echo $data['id'] ?></td>
          <td><?php echo $data['nama'] ?></td>
          <td><?php echo $data['supplier'] ?></td>
          <td><?php echo $data['stok_masuk'] ?></td>
          <td><?php echo $data['stok_sekarang'] ?></td>
          <td><?php echo $data['tanggal'] ?></td>
          <td><?php echo $data['harga'] ?></td>
          <!-- <td>
                <center>
                <a href="index.php?page=hapusstok&id=<?php echo $data['id'];?>" class="btn btn-danger delete-stok a"><i
                    class="fa fa-trash"></i> Hapus</a>
                </center>
              </td> -->
        </tr>

        <?php }?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<?php include 'data/validasi_form.php' ?>