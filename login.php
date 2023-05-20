<!DOCTYPE html>

<?php
include 'koneksi.php';
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
if(isset($_SESSION["level"])){
  header("location:index.php");
  exit;
}

?>


<html>
<head>
  <title>Bevashop | Login</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" href="kasir.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Sweet Alert -->
  <link href="bower_components/sweet/sweetalert.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico">
	<!-- <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css"> -->
	<link rel="stylesheet" href="vendor/animate/animate.css"> 
	<link rel="stylesheet" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="css/util.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body class="hold-transition login-page">

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/neko.jpg);">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form method="POST" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Enter username" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password" required>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<input type="submit" name="masuk" class="login100-form-btn" value="Login">     
					</div> 
          
				</form>
			</div>
		</div>
	</div>
        

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="bower_components/sweet/sweetalert.min.js" type="text/javascript"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

<?php
if(isset($_POST['masuk'])){
  
  $username	= $_POST['username'];
  $password	= $_POST['password'];
  
  $query = mysqli_query($koneksi, "SELECT user.id, user.nama, user.nomor, user.alamat, user.username, user.password, user.gambar, level.nama_level
            FROM user, level  
            where user.id_level = level.id AND user.username='$username' AND user.password='$password'");
  if(mysqli_num_rows($query) == 0){
    echo "<script>swal({
      type: 'error',
      title: 'Login Gagal',
      text: 'Pastikan Username & Password Benar!!!',
      })</script>";
      echo "<meta http-equiv='' content='1;url=login.php'>";
  }else{
    $data = mysqli_fetch_assoc($query);
    
    if($data['nama_level'] == 'Admin'){
      echo "<script>swal('Login Berhasil', 'Selamat Datang $username', 'success');</script>";
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['level'] = $data['nama_level'];
                    $_SESSION['nomor'] = $data['nomor'];
                    $_SESSION['alamat'] = $data['alamat'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['gambar'] = $data['gambar'];
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }else if($data['nama_level'] == 'Karyawan'){
      echo "<script>swal('Login Berhasil', 'Selamat Datang $username', 'success');</script>";
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['level'] = $data['nama_level'];
                    $_SESSION['nomor'] = $data['nomor'];
                    $_SESSION['alamat'] = $data['alamat'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['gambar'] = $data['gambar'];
                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }else{
      echo "<script>swal({
        type: 'error',
        title: 'Login Gagal',
        text: 'Pastikan Username & Password Benar!!!'
        })</script>";
        echo "<meta http-equiv='' content='1;url=login.php'>";
    }
  }
}
?>