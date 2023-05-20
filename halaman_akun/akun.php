<div class="row">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Akun</li>
      </ol>
    </section>
    </div>
    <br>
          <div class="col-lg-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Master User</h3>
              </div>
              
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <a href="index.php?page=tambahakun" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </a>
        <br><br>
                  <thead>
                    <tr>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Nomor</th>
                      <th>Level</th>
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
              $query = mysqli_query($koneksi, "SELECT user.id, user.nama, user.nomor, user.id_level, user.gambar, level.nama_level
              FROM user, level
              WHERE user.id_level = level.id");
              $jumlah = mysqli_num_rows($query);
              while ($data = mysqli_fetch_array($query)) {
                  ?>
                    <tr>
                    <td><img width="40px"heigt="40px" src="halaman_akun/images/<?php echo $data['gambar'] ?>" class="img-circle" alt="User Image"></td>
                      <td><?php echo $data['nama'] ?></td>
                      <td><?php echo $data['nomor'] ?></td>
                      <td ><span class="label <?php if ($data['nama_level']=='admin') { echo"label-primary"; } else { echo"label-success"; } ?>"><?php echo $data['nama_level']; ?></span>
                      </td>
                      <td><center>
                        <a href="index.php?page=editakun&id=<?php echo $data['id']; ?>" class="btn btn-success"><i
                            class="fa fa-pencil"></i></a>
                        <a href="index.php?page=hapusakun&id=<?php echo $data['id']; ?>" class="btn btn-danger delete-akun delete-link" ><i
                            class="fa fa-trash"></i></a>
                      </center></td>
                    </tr>

                    <?php
              }?>
                  </tbody>
                </table>
              </div>
              </div>  
          </div>
              <!-- /.box-body -->
          

          <?php include 'data/validasi_form.php' ?>