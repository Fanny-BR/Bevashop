  <?php
  ini_set('date.timezone', 'Asia/Jakarta');
  $date = date('Y-m-d');
  $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE tgl_transaksi='$date'");
  $jumlah_transaksi = mysqli_num_rows($query);
  $query2 = mysqli_query($koneksi, "SELECT * FROM barang");
  $jumlah_barang = mysqli_num_rows($query2);
  $query3 = mysqli_query($koneksi, "SELECT * FROM stok WHERE tanggal='$date'");
  $barang_masuk = mysqli_num_rows($query3);
  $query4 = mysqli_query($koneksi, "SELECT SUM(total_bayar) AS totaltransaksi FROM transaksi where tgl_transaksi='$date'");
  while ($data = mysqli_fetch_array($query4)) {
      $totaltransaksi = $data['totaltransaksi'];

  }
  $barang = $koneksi->query("SELECT * FROM menipis
WHERE stok_total <= '5';");
$no1 = $barang->num_rows;
  ?>
  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
  </div>
  <br>

  <div class="callout callout-info">
      <h5>Selamat Datang <?php echo $_SESSION['nama'] ?></h5>
      <h3><b>Beva</b>Shop</h3>
      <span id='ct'></span>
      <span></span>
  </div>
  <!-- Small boxes (Stat box) -->
  <div class="row">
  
  <?php if ($_SESSION['level'] == 'Karyawan' ) { ?>
    <div class="col-lg-4 col-xs-12  ">
      <!-- small box -->
      <div class="small-box bg-aqua">
      <div class="inner">
          <h4 style="font-size:40px; font-weight: bold;">Rp. <?php echo number_format($totaltransaksi) ?></h4>
          <p>Pendapatan Hari Ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="index.php?page=laporan" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
        <h4 style="font-size:40px; font-weight: bold;"><?php echo number_format($jumlah_transaksi) ?></h4>
          <!-- <h3><?php echo $jumlah_transaksi ?></h3> -->
          <p>Transaksi Hari ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-cart"></i>
        </div>
        <a href="index.php?page=transaksihariini" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  
    
    <div class="col-lg-4 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
        <h4 style="font-size:40px; font-weight: bold;"><?php echo number_format($barang_masuk ) ?></h4>
          <!-- <h3><?php echo $barang_masuk ?></h3> -->
          <p>Barang masuk hari ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="index.php?page=barangmasuksihariini" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <?php }else{?>
    <div class="col-lg-3 col-xs-12  ">
      <!-- small box -->
      <div class="small-box bg-aqua">
      <div class="inner">
          <h4 style="font-size:40px; font-weight: bold;">Rp. <?php echo number_format($totaltransaksi) ?></h4>
          <p>Pendapatan Hari Ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="index.php?page=laporan" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
        <h4 style="font-size:40px; font-weight: bold;"><?php echo number_format($jumlah_transaksi) ?></h4>
          <!-- <h3><?php echo $jumlah_transaksi ?></h3> -->
          <p>Transaksi Hari ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-cart"></i>
        </div>
        <a href="index.php?page=transaksihariini" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
        <h4 style="font-size:40px; font-weight: bold;"><?php echo number_format($jumlah_barang) ?></h4>
          <!-- <h3><?php echo $jumlah_barang ?></h3> -->
          <p>Jumlah Barang saat ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="index.php?page=barang" class="small-box-footer">Info lebih lanjut <i
            class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    
    <div class="col-lg-3 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
        <h4 style="font-size:40px; font-weight: bold;"><?php echo number_format($barang_masuk ) ?></h4>
          <!-- <h3><?php echo $barang_masuk ?></h3> -->
          <p>Barang masuk hari ini</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="index.php?page=barangmasuksihariini" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
       <!-- Grafik laporan harian -->
<div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Grafik Pendapatan Harian</h3><br>
         
        </div>
      <div class="box-body">
      <canvas id="myChart"></canvas>
      </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <?php include 'data/grafikharian.php' ?>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Stok Menipis</h3><br>
         
        </div>
      <div class="box-body">
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
      <!-- /.box-body -->
  </div>
    <!-- /.box -->
  </div>
  <?php } ?>


