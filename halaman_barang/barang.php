<div class="row">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang</li>
      </ol>
    </section>
    </div>
    <br>
<div class="row">
<!-- <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Import Excel</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-lg-12">
            <form method="post" enctype="multipart/form-data">
              <input type="file" class="form-control" name="excel" required="required">
              <br> 
              <button type="submit" name="import" class="btn btn-info"><i
              class="fa fa-file-excel-o"></i> Import Excel</button>
              <a href="halaman_barang/proses_export_excel.php" name="export" class="btn btn-success"><i
              class="fa fa-book"></i> Export Excel Barang</a>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div> -->
<!-- 
  <!-- <?php
  ini_set('date.timezone', 'Asia/Jakarta');
  $output = '';
  if(isset($_POST["import"]))
  {
  $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
  $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
  if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
  {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  require("Classes/PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output = "Data Berhasil Di Import";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
  $highestRow = $worksheet->getHighestRow();
  for($row=2; $row<=$highestRow; $row++)
  {

    $id = mysqli_real_escape_string($koneksi, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $id_kategori = mysqli_real_escape_string($koneksi, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $nama = mysqli_real_escape_string($koneksi, $worksheet->getCellByColumnAndRow(2, $row)->getValue());


    $query = "INSERT INTO barang(id, id_kategori, nama) VALUES ('".$id."', '".$id_kategori."','".$nama."')";
    mysqli_query($koneksi, $query);
  }
  } 

  }  
  else
  {
  $output = 'File Tidak Di Dukung'; //if non excel file then
  }
  echo "<script>swal('Status Import ?', '$output', 'info');</script>";
  echo "<meta http-equiv='refresh' content='1;url=index.php?page=barang'>";
}
  ?> --> 

  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Master Barang</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
        <form>
        <a href="index.php?page=tambahbarang" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Barang</a>
        <a>  </a>
        <a href="halaman_barang/print2.php" class="btn btn-danger"><i class="fa fa-print"></i> Export PDF</a>
        </form>
        <br><br>
          <thead>
            <tr>
              <th>Kode</th>
              <th>Gambar</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Deskripsi</th>
              <th><center>Action</center></th>
              
            </tr>
          </thead>
          <tbody>
            <?php 

        include 'data/function_dateindo.php';
              $query = mysqli_query($koneksi, "SELECT barang.id,barang.gambar, barang.nama, kategori.nama_kategori, barang.deskripsi
              FROM barang, kategori
              WHERE barang.id_kategori = kategori.id");
              $jumlah = mysqli_num_rows($query);
              while ($data = mysqli_fetch_array($query)){
              ?>
            <tr>
              <td>
                <?php echo $data['id']; ?>
              </td> <td><img width="90px" src="halaman_barang/images/<?php echo $data['gambar'] ?>" alt="Image"></td>
              <td><?php echo $data['nama'] ?></td>
              <td><?php echo $data['nama_kategori'] ?></td>
              <td><?php echo $data['deskripsi'] ?></td>
              <td><center>
                <a href="index.php?page=editbarang&id=<?php echo $data['id'];?>" class="btn btn-warning"><i
                    class="fa fa-pencil"></i></a>
                <a href="index.php?page=hapusbarang&id=<?php echo $data['id'];?>" class="btn btn-danger delete-link"><i
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