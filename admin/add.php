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

	<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "ambilkota.php",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "ambilkecamatan.php",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
  $("#nama_komplek").change(function(){
    var nama_komplek = $("#nama_komplek").val();
    $.ajax({
        url: "ambilkamar.php",
        data: "nama_komplek="+nama_komplek,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#nama_kamar").html(msg);
        }
    });
  });
});
 
</script>
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
					<li class="active"><a href="add.php">Tambah Data</a></li>
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
			<h2>Manajemen Santri &raquo; Tambah Data Santri</h2>
			<hr />
			
			<?php
			if(isset($_POST['add'])){
				$nis			= $_POST['nis'];
				$nama			= $_POST['nama'];
				$tmp			= $_POST['tempat_lahir'];
				$tgl			= $_POST['tanggal_lahir'];
				$tlp			= $_POST['telp'];
				$jk				= $_POST['jenis_kelamin'];
				$sekolah		= $_POST['sekolah'];
				$nama_komplek	= $_POST['nama_komplek'];
				$kamar			= $_POST['kamar'];
				$provinsi		= $_POST['provinsi'];
				$kota_kabupaten = $_POST['kota'];
				$kecamatan		= $_POST['kec'];
				$alamat			= $_POST['alamat'];
				$status			= $_POST['status'];
				
				$cek = mysqli_query($koneksi, "SELECT * FROM santri WHERE nis='$nis'");
				if(mysqli_num_rows($cek) == 0){
								
						$insert = mysqli_query($koneksi, "INSERT INTO santri (nis, nama, tempat_lahir, tanggal_lahir, nama_wali, telp, jenis_kelamin, sekolah, nama_komplek, kamar, alamat, status)
														VALUES('$nis',  '$nama', '$tmp', '$tgl', '$namawali',  '$tlp', '$jk', '$sekolah', '$nama_komplek', '$kamar', '$alamat', '$status')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success">Pendaftaran berhasil dilakukan.</div>';
						}else{
							echo '<div class="alert alert-danger">Pendaftaran gagal dilakukan, silahkan coba lagi.</div>';
						}
					
				}else{
					echo '<div class="alert alert-danger">Santri dengan NIS tersebut sudah terdaftar.</div>';
				}
			}
			?>
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIS</label>
					<div class="col-sm-2">
						<input type="text" name="nis" class="form-control" placeholder="NIS" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA LENGKAP</label>
					<div class="col-sm-4">
						<input type="text" name="nama" class="form-control" placeholder="NAMA LENGKAP" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">TEMPAT & TANGGAL LAHIR</label>
					<div class="col-sm-3">
						<input type="text" name="tempat_lahir" class="form-control" placeholder="TEMPAT LAHIR" required>
					</div>
					<div class="col-sm-2">
						<div class="input-group date" data-provide="datepicker">
							<input type="text" name="tanggal_lahir" class="form-control" placeholder="0000-00-00">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">NAMA WALI</label>
					<div class="col-sm-3">
						<input type="text" name="namawali" class="form-control" placeholder="Nama Wali" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Telepon / Hp</label>
					<div class="col-sm-3">
						<input type="text" name="telp" class="form-control" placeholder="Telepon" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">JENIS KELAMIN</label>
					<div class="col-sm-2">
						<select name="jenis_kelamin" class="form-control" required>
							<option value="">JENIS KELAMIN</option>
							<option value="Laki-Laki">LAKI-LAKI</option>
							<option value="Perempuan">PEREMPUAN</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Sekolah/Kampus</label>
					<div class="col-sm-3">
						<input type="text" name="sekolah" class="form-control" placeholder="Sekolah/Kampus" required>
					</div>
				</div>
				<?php
					mysql_connect("localhost","root"," ");
					mysql_select_db("pesantren");
					?>
				<div class="form-group">
					<label class="col-sm-3 control-label">PROVINSI</label>
					<div class="col-sm-3">
						<select name="provinsi" id="propinsi"class="form-control" required>
							<option>PROVINSI</option>
							<?php
							//mengambil nama-nama propinsi yang ada di database
							$propinsi = mysql_query("SELECT * FROM prov ORDER BY nama_prov");
							while($p = mysql_fetch_array($propinsi)){
							echo "<option value=\"$p[id_prov]\">$p[nama_prov]</option>\n";
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KABUPATEN</label>
					<div class="col-sm-3">
						<select name="kota" id="kota" class="form-control" required>
							<option>KABUPATEN / KOTA</option>
							<?php
							//mengambil nama-nama propinsi yang ada di database
							$kota = mysql_query("SELECT * FROM kabkot ORDER BY nama_kabkot");
							while($p=mysql_fetch_array($propinsi)){
							echo "<option value=\"$p[id_kabkot]\">$p[nama_kabkot]</option>\n";
							}
							?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KECAMATAN</label>
					<div class="col-sm-3">
						<select name="kec" id="kec" class="form-control" required>
							<option>KABUPATEN / KOTA</option>
							
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">ALAMAT DETAIL</label>
					<div class="col-sm-6">
						<textarea name="alamat" class="form-control" placeholder="ALAMAT (Rt, Rw, Jalan, Desa)"></textarea>
					</div>
				</div>
					<div class="form-group">
					<label class="col-sm-3 control-label">KOMPLEK ASRAMA</label>
					<div class="col-sm-3">
						<select name="nama_komplek" id = 'nama_komplek'class="form-control" required>
							<option value = ''>PILIH KOMPLEK</option>
							<?php
							//mengambil nama-nama komplek yang ada di database
							$komplek = mysql_query("SELECT * FROM data_komplek ORDER BY nama_komplek");
							while($p = mysql_fetch_array($komplek)){
							echo "<option value=\"$p[nama_komplek]\">$p[nama_komplek]</option>\n";
							}
							//$komplek2 = $_POST['nama_komplek'];
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">KAMAR</label>
					<div class="col-sm-3">
						<select name="kamar" id="nama_kamar" class="form-control" required>
							<option>KAMAR</option>
							<?php
							//mengambil nama-nama propinsi yang ada di database
							$kamar = mysql_query("SELECT * FROM data_kamar ORDER BY nama_kamar");
							while($k=mysql_fetch_array($komplek)){
							echo "<option value=\"$k[nama_kamar]\">$k[nama_kamar]</option>\n";
							}
							?>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">STATUS</label>
					<div class="col-sm-2">
						<select name="status" class="form-control" required>
							<option value="">STATUS</option>
							<option value="1">AKTIF</option>
							<option value="2">TIDAK AKTIF</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-primary" value="TAMBAH">
						<a href="index.php" class="btn btn-warning">BATAL</a>
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