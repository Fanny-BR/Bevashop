<?php include 'data/function_dateindo.php' ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Transaksi Hari Ini</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <span>Tanggal : <?php
                
        ini_set('date.timezone', 'Asia/Jakarta');
                echo format_indo(date('Y-m-d')); ?></span>
                <a href="../apotek/halaman_laporan/print_tgl_sekarang.php" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print Data</a>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Tanggal</th>
                <th>No Invoice</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>QTY</th>
                <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        ini_set('date.timezone', 'Asia/Jakarta');
            $date = date('Y-m-d');
                $query = mysqli_query($koneksi, "SELECT transaksi.tgl_transaksi,transaksi.no_invoice, detail_transaksi.id_stok, barang.nama, detail_transaksi.harga, detail_transaksi.qty, detail_transaksi.total
                FROM detail_transaksi
                JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
                JOIN stok ON detail_transaksi.id_stok = stok.id 
                JOIN barang ON stok.id_barang = barang.id WHERE tgl_transaksi='$date'");
                $row = mysqli_num_rows($query);
                if($row > 0){
                while ($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo format_indo($data['tgl_transaksi']) ?></td>
                    <td><?php echo $data['no_invoice'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td>Rp. <?php echo number_format($data['harga']) ?></td>
                    <td><?php echo $data['qty'] ?></td>
                    <td><?php echo number_format($data['total']) ?></td>
                </tr>
                <?php }
                }else{ // Jika data tidak ada
                    echo "<tr><td align='center' class='bg-danger' colspan='6'>Data Transaksi Tidak Ada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>