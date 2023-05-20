<div class="row">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Supplier</li>
        </ol>
    </section>
</div>
<br>
<div class="row">
    <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title"> Supplier</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <a href="index.php?page=tambahsupplier" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Supplier</a>
        <br><br>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Supplier</th>
              <th>Telepon</th>
              <th>Alamat</th>
              <th><center>Aksi</center></th>
            </tr>
          </thead>
          <tbody>
            <?php 

        include 'data/function_dateindo.php';
              $query = mysqli_query($koneksi, "SELECT * FROM supplier");
              $jumlah = mysqli_num_rows($query);
              while ($data = mysqli_fetch_array($query)){
              ?>
            <tr>
              <td><?php echo $data['id_supplier'] ?></td>
              <td><?php echo $data['nama'] ?></td>
              <td><?php echo $data['telepon'] ?></td>
              <td><?php echo $data['alamat'] ?></td>  
              <td>
                <center>
                <a href="index.php?page=editsupplier&id_supplier=<?php echo $data['id_supplier'];?>" class="btn btn-warning"><i
                    class="fa fa-pencil"></i></a>
                <a href="index.php?page=hapussupplier&id_supplier=<?php echo $data['id_supplier'];?>" class="btn btn-danger delete-supplier a"><i
                    class="fa fa-trash"></i></a>
                </center>
              </td>
            </tr>

            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<?php include 'data/validasi_form.php' ?>
