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
					<li><a href="add.php">Tambah Data</a></li>
					<li><a href="datakamar.php">Data Kamar</a></li>
					<li><a href="add_kamar.php">Tambah Data Kamar</a></li>
					<li><a href="datakomplek.php">Data Komplek</a></li>
					<li><a href="add_komplek.php">Tambah Data Komplek</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Manajemen User &raquo; Edit Data Kamar</h2>
			<hr />
			
			<?php
			$namakamar = $_GET['namakamar'];
			$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE nama_kamar='$namakamar'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: datakamar.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				
				$nama_komplek				= $_POST['nama_komplek'];
				$nama_kamar					= $_POST['nama_kamar'];
				$keadaan_kamar				= $_POST['keadaan_kamar'];
				$kapasitas					= $_POST['kapasitas'];
				$penghuni_sekarang			= $_POST['penghuni_sekarang'];
				$jumlah_lemari				= $_POST['jumlah_lemari'];
				
				$update = mysqli_query($koneksi, "UPDATE  data_kamar SET nama_komplek='$nama_komplek', keadaan_kamar='$keadaan_kamar', kapasitas = '$kapasitas', penghuni_sekarang = '$penghuni_sekarang', jumlah_lemari = '$jumlah_lemari' WHERE nama_kamar = '$namakamar'") or die(mysqli_error());
				if($update){
					header("Location: edit_kamar.php?namakamar=".$namakamar."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger">Data gagal disimpan, silahkan coba lagi.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success">Data berhasil disimpan.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<?php
					mysql_connect("localhost","root","2");
					mysql_select_db("pesantren");
					?>
				<div class="form-group">
					<label class="col-sm-3 control-label">KOMPLEK ASRAMA</label>
					<div class="col-sm-3">
						<select name="nama_komplek" class="form-control" required>
							<option value = ''>PILIH KOMPLEK</option>
							<?php
							//mengambil nama-nama komplek yang ada di database
							$komplek = mysql_query("SELECT * FROM data_komplek ORDER BY nama_komplek");
							while($p = mysql_fetch_array($komplek)){
							echo "<option value=\"$p[nama_komplek]\">$p[nama_komplek]</option>\n";
							}
							?>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA KAMAR</label>
					<div class="col-sm-2">
						<input type="text" name="nama_kamar" class="form-control" placeholder="Nama Kamar"  value="<?php echo $row['nama_kamar']; ?>" placeholder="Nama Kamar" disabled>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KEADAAN KAMAR</label>
					<div class="col-sm-3">
						<select name="keadaan_kamar" id="komplek"class="form-control" required>
							<option value = ''>Pilih Keadaan Kamar</option>
							<option value = 'Sangat Baik'<?php if($row['keadaan_kamar'] == 'Sangat Baik'){ echo 'selected'; } ?>>Sangat Baik</option>
							<option value = 'Baik'<?php if($row['keadaan_kamar'] == 'Baik'){ echo 'selected'; } ?>>Baik</option>
							<option value = 'Kurang Baik'<?php if($row['keadaan_kamar'] == 'Kurang Baik'){ echo 'selected'; } ?>>Kurang Baik</option>
							<option value = 'Buruk'<?php if($row['keadaan_kamar'] == 'Buruk'){ echo 'selected'; } ?>>Buruk</option>
							
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">KAPASITAS KAMAR</label>
					<div class="col-sm-3">
						<input type="text" name="kapasitas" class="form-control" placeholder="Kapasitas Kamar" value="<?php echo $row['kapasitas']; ?>" placeholder="Kapasitas Kamar" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Jumlah Penghuni Sekarang</label>
					<div class="col-sm-3">
						<input type="text" name="penghuni_sekarang" class="form-control" placeholder="Jumlah Penghuni Sekarang" value="<?php echo $row['penghuni_sekarang']; ?>" placeholder="Jumlah Penghuni Saat Ini" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">JUMLAH LEMARI</label>
					<div class="col-sm-3">
						<input type="text" name="jumlah_lemari" class="form-control" placeholder="Jumlah Lemari" value="<?php echo $row['jumlah_lemari']; ?>" placeholder="Jumlah Lemari" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-primary" value="SIMPAN">
						<a href="datakamar.php" class="btn btn-warning">BATAL</a>
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