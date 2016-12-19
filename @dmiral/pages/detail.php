<?php
include "../config.php";
error_reporting(0);

$sql = "SELECT * FROM calonsiswa WHERE hportu='".$_GET['id']."'";
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);
if($row['kelamin'] == l){
	$kelamin = "Laki-laki";
} else {
	$kelamin = "Perempuan";
}
if($row['is_konfirmasi'] == 1){
    $bayar = "Sudah";
} else {
    $bayar = "Belum";
}
echo "
	
	<style>
	body {
	    font-family: calibri;
	    font-size: 0.8em;
	}
	hr {
		margin: 20px 0;
	}
	</style>
	<center><h1>Detail Calon Santri</h1></center>
	<hr>
	<table  width='100%' class='table-detail'>
		<tr>
			<td>
				<table class='table-detail'>
					<tr>
						<td>No Pendaftaran</td>
						<td>:</td>
						<td><strong>".$row['nopendaftaran']."</strong></td>
					</tr>
					<tr>
						<td>NIS</td>
						<td>:</td>
						<td><strong>".$row['nis']."</strong></td>
					</tr>
					<tr>
						<td>NIK</td>
						<td>:</td>
						<td><strong>".$row['nik']."</strong></td>
					</tr>
					<tr>
						<td valign=\"top\">Nama Lengkap</td>
						<td valign=\"top\">:</td>
						<td><strong>".$row['nama']."</strong></td>
					</tr>
					<tr>
						<td>Nama Panggilan</td>
						<td>:</td>
						<td><strong>".$row['panggilan']."</strong></td>
					</tr>
					<tr>
						<td>Kelamin</td>
						<td>:</td>
						<td><strong>".$kelamin."</strong></td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>:</td>
						<td><strong>".$row['tmplahir']."</strong></td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td><strong>".$row['tgllahir']."</strong></td>
					</tr>
					<tr>
						<td>Agama</td>
						<td>:</td>
						<td><strong>".$row['agama']."</strong></td>
					</tr>
					<tr>
						<td>Suku</td>
						<td>:</td>
						<td><strong>".$row['suku']."</strong></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><strong>".$row['status']."</strong></td>
					</tr>
				</table>
			
			</td>
			
			<td>		
				<table class='table-detail'>
					<tr>
						<td>Kondisi</td>
						<td>:</td>
						<td><strong>".$row['kondisi']."</strong></td>
					</tr>
					<tr>
						<td>Kewarganegaraan</td>
						<td>:</td>
						<td><strong>".$row['warga']."</strong></td>
					</tr>
					<tr>
						<td>Anak Ke</td>
						<td>:</td>
						<td><strong>".$row['anakke']."</strong></td>
					</tr>
					<tr>
						<td>Status Anak</td>
						<td>:</td>
						<td><strong>".$row['statusanak']."</strong></td>
					</tr>
					<tr>
						<td>Jumlah Saudara Kandung</td>
						<td>:</td>
						<td><strong>".$row['jkandung']."</strong></td>
					</tr>
					<tr>
						<td>Jumlah Saudara Tiri</td>
						<td>:</td>
						<td><strong>".$row['jtiri']."</strong></td>
					</tr>        
					<tr>
						<td>Golongan Darah</td>
						<td>:</td>
						<td><strong>".$row['darah']."</strong></td>
					</tr>
					<tr>
						<td>Berat Badan</td>
						<td>:</td>
						<td><strong>".$row['berat']." Kg</strong></td>
					</tr>
					<tr>
						<td>Tinggi Badan</td>
						<td>:</td>
						<td><strong>".$row['tinggi']." Cm</strong></td>
					</tr>
					<tr>
						<td>Riwayat Penyakit</td>
						<td>:</td>
						<td><strong>".$row['kesehatan']."</strong></td>
					</tr>
					<tr>
						<td>Bahasa</td>
						<td>:</td>
						<td><strong>".$row['bahasa']."</strong></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<hr>
	
	<table class='table-detail'>
	<tr>
	    <td valign=\"top\">Alamat</td>
	    <td valign=\"top\">:</td>
	    <td><strong>".$row['alamatsiswa']."</strong></td>
	</tr>
	<tr>
	    <td>Kode Pos</td>
	    <td>:</td>
	    <td><strong>".$row['kodepossiswa']."</strong></td>
	</tr>
	<tr>
	    <td>Jarak Ke Sekolah</td>
	    <td>:</td>
	    <td><strong>".$row['jarak']." Km</strong></td>
	</tr>
	<tr>
	    <td>Telepon</td>
	    <td>:</td>
	    <td><strong>".$row['telponsiswa']."</strong></td>
	</tr>
	<tr>
	    <td>Handphone Orangtua</td>
	    <td>:</td>
	    <td><strong>".$row['hportu']."</strong></td>
	</tr>
	<tr>
	    <td>Email Orangtua</td>
	    <td>:</td>
	    <td><strong>".$row['emailayah']."</strong></td>
	</tr>
	<tr>
	    <td>Asal Sekolah</td>
	    <td>:</td>
	    <td><strong>".$row['asalsekolah']."</strong></td>
	</tr>
	<tr>
	    <td>No. Seri Ijazah</td>
	    <td>:</td>
	    <td><strong>".$row['noijasah']."</strong></td>
	</tr>
	<tr>
	    <td>No. Seri SKHUN</td>
	    <td>:</td>
	    <td><strong>".$row['noskhun']."</strong></td>
	</tr>
	<tr>
	    <td>Tanggal Ijazah</td>
	    <td>:</td>
	    <td><strong>".$row['tglijasah']."</strong></td>
	</tr>
	<tr>
	    <td>Alamat Sekolah</td>
	    <td>:</td>
	    <td><strong>".$row['alamatsekolah']."</strong></td>
	</tr>
	</table>
	
	<hr>
	
	<table width='100%' class='table-detail'>
	<tr>
	<td>
	<table class='table-detail'>
	    <tr>
	        <td>Nama Ayah</td>
	        <td>:</td>
	        <td><strong>".$row['namaayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Status Ayah</td>
	        <td>:</td>
	        <td><strong>".$row['statusayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Tempat Lahir</td>
	        <td>:</td>
	        <td><strong>".$row['tmplahirayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Tanggal Lahir</td>
	        <td>:</td>
	        <td><strong>".$row['tgllahirayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Pendidikan Ayah</td>
	        <td>:</td>
	        <td><strong>".$row['pendidikanayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Pekerjaan Ayah</td>
	        <td>:</td>
	        <td><strong>".$row['pekerjaanayah']."</strong></td>
	    </tr>
	    <tr>
	        <td>Penghasilan Ayah</td>
	        <td>:</td>
	        <td><strong>".$row['penghasilanayah']."</strong></td>
	    </tr>
	</table>
	</td>
	<td>
	<table class='table-detail'>
	    <tr>
	        <td>Nama Ibu</td>
	        <td>:</td>
	        <td><strong>".$row['namaibu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Status Ibu</td>
	        <td>:</td>
	        <td><strong>".$row['statusibu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Tempat Lahir</td>
	        <td>:</td>
	        <td><strong>".$row['tmplahiribu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Tanggal Lahir</td>
	        <td>:</td>
	        <td><strong>".$row['tgllahiribu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Pendidikan Ibu</strong></td>
	        <td>:</td>
	        <td><strong>".$row['pendidikanibu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Pekerjaan Ibu</td>
	        <td>:</td>
	        <td><strong>".$row['pekerjaanibu']."</strong></td>
	    </tr>
	    <tr>
	        <td>Penghasilan Ibu</td>
	        <td>:</td>
	        <td><strong>".$row['penghasilanibu']."</strong></td>
	    </tr>
	</table>
	</td>
	</tr>
	</table>
	<hr>
	<table class='table-detail'>
	<tr>
	    <td>Daftar Melalui</td>
	    <td>:</td>
	    <td><strong>".$row['registrasi']."</strong></td>
	</tr>
	<tr>
	    <td>Tanggal Daftar</td>
	    <td>:</td>
	    <td><strong>".$row['ts']."</strong></td>
	</tr>
	<tr>
	    <td>Jenis Pembayaran</td>
	    <td>:</td>
	    <td><strong>".$row['transaksi']."</strong></td>
	</tr>
	<tr>
	    <td>Tanggal Konfirmasi</td>
	    <td>:</td>
	    <td><strong>".$row['tgl_konfirmasi']."</strong></td>
	</tr>
	</table>
";
?>