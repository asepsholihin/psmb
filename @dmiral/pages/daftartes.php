<?php

include "../config.php";
$data = "";
$sql = "SELECT nopendaftaran,nama,asalsekolah,hportu FROM calonsiswa WHERE info2='".$_GET['tanggal']."' and aktif=1";
$query = mysql_query($sql);
$no = 1;
while($row=mysql_fetch_array($query)) {
	$data .="
	<tr>
		<td>".$row['nopendaftaran']."</td>
		<td>".ucwords(strtolower($row['nama']))."</td>
		<td>".$row['asalsekolah']."</td>
		<td>".$row['hportu']."</td>
	</tr>
	";
}


?>

<style>
table {
	width: 100%;
}
table td {
	border-bottom: 1px solid #ddd;
	padding: 5px;
}
table th {
	background: #333;
	color: #fff;
	padding: 10px;
	text-align: left;
}
</style>
<center><h2>Daftar Nama Calon Santri Tes Seleksi<br>PSMB SMP Al-Qur'an Ma'rifatussalaam</h3></center>
<table cellspacing="0" cellpadding="0">
	<tr>
		<th>No. Pendaftaran</th>
		<th>Nama</th>
		<th>Asal Sekolah</th>
		<th>Handphone</th>

	</tr>
	<?php echo $data; ?>
</table>