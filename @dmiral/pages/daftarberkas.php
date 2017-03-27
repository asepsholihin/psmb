<?php

include "../config.php";
$data = "";
$sql = "SELECT nopendaftaran,nama,asalsekolah,hportu FROM calonsiswa WHERE info2='".$_GET['tanggal']."' and aktif='1'";
$query = mysqli_query($koneksi, $sql);
$no = 1;
while($row=mysqli_fetch_array($query)) {
	$data .="
	<tr>
		<td>".$no."</td>
		<td>".$row['nopendaftaran']."</td>
		<td>".ucwords(strtolower($row['nama']))."</td>
		<td>".$row['asalsekolah']."</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	";
	$no++;
}


?>

<style>
table {
	width: 100%;
}
table td {
	border-bottom: 1px solid #ddd;
	border-right: 1px solid #ddd;
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
		<th>No.</th>
		<th>No. Pendaftaran</th>
		<th>Nama</th>
		<th>Asal Sekolah</th>
		<th>Biodata</th>
		<th>Akta</th>
		<th>KTP</th>
		<th>KK</th>
		<th>NISN</th>
		<th>Rapor</th>
		<th>SP</th>
		<th>Foto</th>
		<th>Komitmen</th>
		<th>Quis Santri</th>
		<th>Quis Ortu</th>

	</tr>
	<?php echo $data; ?>
</table>
