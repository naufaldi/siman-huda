<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manajemen santri</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
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
				<a class="navbar-brand visible-xs-block visible-sm-block" href="#">Manajemen Santri</a>
				<a class="navbar-brand hidden-xs hidden-sm" href="#">Manajemen Santri</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Beranda</a></li>
					
					<li class="active"><a href="datakamar.php">Data Kamar</a></li>
					
					<li><a href="datakomplek.php">Data Komplek</a></li>
					
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Manajemen Santri &raquo; Data Kamar</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$nama_kamar = $_GET['nama_kamar'];
				$cek = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE nama_kamar='$nama_kamar'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info">Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM data_kamar WHERE nama_kamar='$nama_kamar'");
					if($delete){
						echo '<div class="alert alert-danger">Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-info">Data gagal dihapus.</div>';
					}
				}
			}
			?>
			
			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="urut" class="form-control" onchange="form.submit()">
						<option value="0">Filter</option>
						<!--<?php $urut = (isset($_GET['urut']) ? strtolower($_GET['urut']) : NULL);  ?>-->
						<option value="1" <?php if($urut == '1'){ echo 'selected'; } ?>>Ada Kapasitas Kamar Kosong</option>
						<option value="2" <?php if($urut == '2'){ echo 'selected'; } ?>>Kamar Penuh</option>
						<option value="3" <?php if($urut == '3'){ echo 'selected'; } ?>>Kamar Kelebihan Muatan</option>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>NO.</th>
					<th>NAMA KOMPLEK</th>
					<th>NAMA KAMAR</th>
					<th>KEADAAN KAMAR</th>
					<th>KAPASITAS KAMAR</th>
					<th>PENGHUNI SAAT INI</th>
					<th>JUMLAH LEMARI</th>

					<th>SETTING</th>
				</tr>
				<?php
				if($urut == '1'){
					$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE kapasitas > penghuni_sekarang ORDER BY nama_kamar ASC");
				}
				else if($urut == '2'){
					$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE kapasitas = penghuni_sekarang ORDER BY nama_kamar ASC");
				}
				else if($urut == '3'){
					$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE kapasitas < penghuni_sekarang ORDER BY nama_kamar ASC");
				}
				else{
					$sql = mysqli_query($koneksi, "SELECT * FROM data_kamar ORDER BY nama_kamar ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">Tidak ada data.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['nama_komplek'].'</td>
							<td>'.$row['nama_kamar'].'</td>
							<td>'.$row['keadaan_kamar'].'</td>
							<td>'.$row['kapasitas'].'</td>
							<td>'.$row['penghuni_sekarang'].'</td>
							<td>'.$row['jumlah_lemari'].'</td>
							<td>
								<a href="profile_kamar.php?nama_kamar='.$row['nama_kamar'].'" title="Lihat Detail"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
								
								
								
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>