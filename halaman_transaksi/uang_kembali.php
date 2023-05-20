<?php
include 'data/function_dateindo.php';

    $ambil=$koneksi->query("SELECT transaksi.tgl_transaksi, transaksi.id, transaksi.no_invoice, transaksi.jam_transaksi, transaksi.total_bayar, transaksi.jumlah_bayar, transaksi.kembalian, user.nama
    FROM transaksi, user 
    WHERE transaksi.id_user = user.id 
    AND transaksi.id='$_GET[id]'");
    $data=$ambil->fetch_array(MYSQLI_ASSOC);

 ?>
   <!-- Main content -->
   <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-shopping-cart"></i> Detail Belanja
            <!-- <small class="pull-right"><?php echo $data['tgl_transaksi']?></small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">

        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">INVOICE</p>
          <p class="label label-success" style="margin-top: 10px; font-size:25px; font-weight: bold; color:black;">
          <?php echo $data['no_invoice'] ?>
          </p>
        </div>
        <div class="col-sm-6 invoice-col">
          <address>
            <b>Customer :</b> <span class="label label-info">Umum</span><br>
            <b>Kasir    : </b><?php echo $data['nama'] ?><br>
            <b>Tanggal  :</b> <?php echo format_indo($data['tgl_transaksi']) ?><br>
            <b>Jam      :</b> <?php echo $data['jam_transaksi'] ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<br>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
          <th>Kode</th>
          <th>Nama Produk</th>
          <th>Harga Satuan</th>
          <th>Qty</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              $query = mysqli_query($koneksi, "SELECT detail_transaksi.*, stok.* , barang.*
              FROM detail_transaksi,stok, barang
              WHERE detail_transaksi.id_stok = stok.id AND stok.id_barang = barang.id
              AND detail_transaksi.id_transaksi='$_GET[id]'");
              while ($data1 = mysqli_fetch_array($query)){
              ?>
            <tr>
              <td><?php echo $data1['id_stok'] ?></td>
              <td><?php echo $data1['nama'] ?></td>
              <td>Rp. <?php echo number_format($data1['harga'])?></td>
              <td><?php echo $data1['qty'] ?></td>
            </tr>
              <?php 
            $jumlah1 = $jumlah1+$data1['qty'];  
            } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
       <!-- /.col -->
       <div class="col-xs-6">
          <p class="lead">Detail Pembayaran</p>

          <div class="table-responsive">
            <table class="table">
            <tr>
                <th>Jumlah Barang:</th>
                <td> <?php echo $jumlah1 ?> Barang</td>
              </tr><tr>
                <th>Jumlah Bayar:</th>
                <td>Rp. <?php echo number_format($data['jumlah_bayar']) ?></td>
              </tr>
              <tr>
                <th style="width:50%">Uang Kembalian:</th>
                <td>Rp. <?php echo number_format($data['kembalian']) ?></td>
              </tr>
              
             
            </table>
          </div>
        </div>
        <!-- /.col -->
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">TOTAL BAYAR :</p>
          <p class="text-muted well well-sm " style="margin-top: 10px; font-size:50px; font-weight: bold; color:black;">
          Rp. <?php echo number_format($data['total_bayar']) ?>
          </p>
        </div>
       
      </div>
      <!-- /.row -->

  

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <button onclick="window.open('halaman_transaksi/nota.php?id=<?php echo $data['id']; ?>','mywindow','width=265px, height=400px')" class="btn btn-success"><i class="fa fa-print"></i> Cetak Struk</button>
          <a href="index.php?page=transaksi" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-refresh"></i> Transaksi Baru
          </a>
        </div>
      </div>
    </section>