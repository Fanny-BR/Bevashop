<?php include 'data/function_dateindo.php' ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Barang Masuk Hari Ini</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <span>Tanggal : <?php
                
        ini_set('date.timezone', 'Asia/Jakarta');
                echo format_indo(date('Y-m-d')); ?></span>
                <a href="../bevashop/halaman_laporan/print_barang_tgl_sekarang2.php" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print Data</a>
            </div>
        </div>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Stok Awal</th>
                    <th>Stok Sekarang</th>
                    <th>Tanggal Masuk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                ini_set('date.timezone', 'Asia/Jakarta');
                $date = date('Y-m-d');
                $query = mysqli_query($koneksi, "SELECT barang.`nama`, supplier.`nama` AS supplier, stok.`stok_masuk`, stok.`id`, stok.`stok_sekarang`,stok.`tanggal`,stok.`harga`
                FROM stok
                JOIN barang
                ON barang.`id`=stok.`id_barang`
                JOIN supplier
                ON supplier.`id_supplier`=stok.`id_supplier`
                WHERE tanggal='$date'");
                $row = mysqli_num_rows($query);
                if ($row > 0) {
                while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['supplier'] ?></td>
                <td><?php echo $data['stok_masuk'] ?></td>
                <td><?php echo $data['stok_sekarang'] ?></td>
                <td><?php echo $data['tanggal'] ?></td>
                <td><?php echo $data['harga'] ?></td>
                </tr>
                <?php
                }
            }else{
                echo "<tr><td align='center' class='bg-danger' colspan='8'>Data Barang Masuk Hari Ini Tidak Ada</td></tr>";
            }
                ?>
            </tbody>
        </table>
    </div>
</div>
