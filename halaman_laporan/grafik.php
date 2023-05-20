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

  ?>
<div class="row">

  <section class="content-header">
    <h1>
      Dasboard
      <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Grafik</li>
    </ol>
  </section>
</div>
<br>

<!-- Form laporan penjualan -->
<div class="row">
    <!-- Grafik laporan harian -->
<div class="col-md-12">
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



    <div class="col-lg-6">
  

<!-- else if($(this).val() == '3'){
                $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sembunyikan form tanggal, bulan, tahun
                $('#form-periode').show(); // Tampilkan form bulan dan tahun
              }-->