<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Manajemen</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#">Manajemen Santri</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">Manajemen Santri</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Beranda</a></li>
					<li><a href="add.php">Tambah Data</a></li>
					<li><a href="datakamar.php">Data Kamar</a></li>
					<li><a href="add_kamar.php">Tambah Data Kamar</a></li>
					<li><a href="datakomplek.php">Data Komplek</a></li>
					<li class="active"><a href="add_komplek.php">Tambah Data Komplek</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Manajemen Santri &raquo; Tambah Data Kamar</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){
				$nama_komplek				= $_POST['nama_komplek'];
				$ketua_komplek					= $_POST['ketua_komplek'];
				$bendahara_komplek				= $_POST['bendahara_komplek'];
				
				$cek = mysqli_query($koneksi, "SELECT * FROM data_komplek WHERE nama_komplek='$nama_komplek'");
				if(mysqli_num_rows($cek) == 0){
								
						$insert = mysqli_query($koneksi, "INSERT INTO data_komplek VALUES('$nama_komplek',  '$ketua_komplek', '$bendahara_komplek')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success">Penambahan data Komplek berhasil dilakukan.</div>';
						}else{
							echo '<div class="alert alert-danger">Penambahan data Komplek gagal dilakukan, silahkan coba lagi.</div>';
						}
					
				}else{
					echo '<div class="alert alert-danger">Komplekdengan nama tersebut sudah terdaftar.</div>';
				}
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA KOMPLEK</label>
					<div class="col-sm-2">
						<input type="text" name="nama_komplek" class="form-control" placeholder="Nama Komplek" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KETUA KOMPLEK</label>
					<div class="col-sm-3">
						<input type="text" name="ketua_komplek" class="form-control" placeholder="Ketua komplek" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">BENDAHARA KOMPLEK</label>
					<div class="col-sm-3">
						<input type="text" name="bendahara_komplek" class="form-control" placeholder="Bendahara Komplek" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-primary" value="TAMBAH">
						<a href="datakomplek.php" class="btn btn-warning">BATAL</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'yyyy-mm-dd',
	})
	</script>
</body>
</html>