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
	
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
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
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#">Manajemen User</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">Manajemen User</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Beranda</a></li>
					
					<li><a href="datakamar.php">Data Kamar</a></li>
					
					<li><a href="datakomplek.php">Data Komplek</a></li>
					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Manajemen User &raquo; Edit Data Komplek</h2>
			<hr />
			
			<?php
			$namakomplek = $_GET['nama_komplek'];
			$sql = mysqli_query($koneksi, "SELECT * FROM data_komplek WHERE nama_komplek='$namakomplek'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: datakomplek.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				
				$ketua_komplek				= $_POST['ketua_komplek'];
				$bendahara_komplek				= $_POST['bendahara_komplek'];
				
				$update = mysqli_query($koneksi, "UPDATE  data_komplek SET ketua_komplek='$ketua_komplek', bendahara_komplek = '$bendahara_komplek' WHERE nama_komplek = '$namakomplek'") or die(mysqli_error());
				if($update){
					header("Location: edit_komplek.php?namakomplek=".$namakomplek."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger">Data Komplek gagal disimpan, silahkan coba lagi.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success">Data berhasil disimpan.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<?php
					mysql_connect("localhost","root","");
					mysql_select_db("pesantren");
					?>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA KOMPLEK</label>
					<div class="col-sm-2">
						<input type="text" name="nama_komplek" class="form-control" placeholder="Nama Komplek"  value="<?php echo $row['nama_komplek']; ?>" disabled>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">KETUA KOMPLEK</label>
					<div class="col-sm-3">
						<input type="text" name="ketua_komplek" class="form-control" placeholder="Ketua Komplek" value="<?php echo $row['ketua_komplek']; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">BENDAHARA KOMPLEK</label>
					<div class="col-sm-3">
						<input type="text" name="bendahara_komplek" class="form-control" placeholder="Bendahara Komplek" value="<?php echo $row['bendahara_komplek']; ?>" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-primary" value="SIMPAN">
						<a href="datakomplek.php" class="btn btn-warning">BATAL</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
</body>
</html>