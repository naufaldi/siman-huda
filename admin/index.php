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
					<li class="active"><a href="index.php">Beranda</a></li>
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
			<h2>Manajemen Santri &raquo; Data Santri</h2>
			<hr />
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				$nis = $_GET['nis'];
				$cek = mysqli_query($koneksi, "SELECT * FROM santri WHERE nis='$nis'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info">Data tidak ditemukan.</div>';
				}else{
					$delete = mysqli_query($koneksi, "DELETE FROM santri WHERE nis='$nis'");
					if($delete){
						echo '<div class="alert alert-danger">Data berhasil dihapus.</div>';
					}else{
						echo '<div class="alert alert-info">Data gagal dihapus.</div>';
					}
				}
			}
			?>
			<form class="form-inline">
				
					
					
				<div class="form-group">
					<a href="login.php" class="btn btn-danger" onclick="return confirm('Yakin Keluar Dari Admin..?')"><span aria-hidden="true"></span>Keluar</a>
					<a href="add.php" class="btn btn-primary">Tambah Data Santri Baru</a>
					|| Pencarian Data Santri :
					<form method="GET" action="">
					<input type="text" class="form-control" name="query" placeholder = "Masukkan Parameter" />

					<select name="pencarian" id="pencarian" class="form-control" >
					<option value=""> - Cari berdasarkan -
					<option value="nama">Nama
					<option value="kamar">Kamar
					<option value="nama_komplek">Komplek
					<option value="jenis_kelamin">Jenis Kelamin
					<option value="sekolah">Sekolah / Kampus
					</select>
					<input type="submit" name="cari" class="btn btn-warning" value="Cari"/>
					<!-- <a href="index.php?cari=cari&pencarian=pencarian&query=" class="btn btn-warning">Cari</a> -->
					<div class="form-group">
					<select name="urut" class="form-control" onchange="form.submit()">
						<option value="0">Filter</option>
						<?php $urut = (isset($_GET['urut']) ? strtolower($_GET['urut']) : NULL);  ?>
						<option value="1" <?php if($urut == '1'){ echo 'selected'; } ?>>Santri Aktif</option>
						<option value="2" <?php if($urut == '2'){ echo 'selected'; } ?>>SantriTidak Aktif</option>
					</select>
				</div>
					</form>
				
				</div>

				
			</form>
			
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>NO.</th>
					<th>NIS</th>
					<th>NAMA LENGKAP</th>
					<th>NAMA WALI</th>
					<th>JENIS KELAMIN</th>
					<th>SEKOLAH</th>
					<th>KOMPLEK</th>
					<th>KAMAR</th>
					<th>STATUS</th>
					<th>SETTING</th>
				</tr>
				<?php
				if($urut){
					$sql = mysqli_query($koneksi, "SELECT * FROM santri WHERE status='$urut' ORDER BY nis ASC");
				}
				elseif (isset($_GET['cari'])) {
				$pencarian1			= $_GET['pencarian'];
				$query1				= $_GET['query'];
				//echo $pencarian1.$query1;
				$sql = mysqli_query($koneksi, "SELECT * FROM santri WHERE $pencarian1 like '%$query1%' ORDER BY nis ASC") or die(mysqli_error());
				}
				else{
					$sql = mysqli_query($koneksi, "SELECT * FROM santri ORDER BY nis ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">Tidak ada data.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['nis'].'</td>
							<td>'.$row['nama'].'</td>
							<td>'.$row['nama_wali'].'</td>
							<td>'.$row['jenis_kelamin'].'</td>
							<td>'.$row['sekolah'].'</td>
							<td>'.$row['nama_komplek'].'</td>
							<td>'.$row['kamar'].'</td>
							<td>';
							if($row['status'] == 1){
								echo '<span class="label label-success">Aktif</span>';
							}else{
								echo '<span class="label label-warning">Tidak Aktif</span>';
							}
						echo '
							</td>
							<td>
								<a href="profile.php?nis='.$row['nis'].'" title="Lihat Detail"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
								<a href="edit.php?nis='.$row['nis'].'" title="Rubah Data"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								
								<a href="index.php?aksi=delete&nis='.$row['nis'].'" title="Hapus Data" onclick="return confirm(\'Yakin Ingin Menghapus?\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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