<?php
mysql_connect("localhost","root","");
mysql_select_db("pesantren");
$komplek = $_GET['nama_komplek'];
$kamar = mysql_query("SELECT nama_kamar FROM data_kamar WHERE nama_komplek = '$komplek' order by nama_kamar");
echo "<option>-- Pilih Kamar --</option>";
while($k = mysql_fetch_array($kamar)){
    echo "<option value=\"".$k['nama_kamar']."\">".$k['nama_kamar']."</option>\n";
}
?>