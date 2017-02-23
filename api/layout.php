<style>
body {
font-size: 2.2em;
font-family: sans-serif;
margin: 50px;
}
.kwitansi {
    width: auto;
    color: #555;
    margin: auto 0 50px;
    border: 3px solid #9b68da;
}
.kwitansi p {
    font-size: 0.9em;
    color: #333;
    padding: 20px 0;
    text-align: center;
}
.title-kwitansi {
    text-align: center;
    background: #9b68da;
}
.kwitansi h3 {
    padding: 20px;
    margin: 0;
    color: #fff;
    font-size: 1.2em;
}
.kwitansi h4 {
    text-align: center;
    color: #9b68da;
    margin: 0 0 10px;
    font-size: 1em;
}
.body-kwitansi {
    padding:  15px 60px;
    background: rgba(183, 160, 212, 0.17) url(http://psmb.marifatussalaam.org/@dmiral/css/logo-transparent.png) no-repeat center;
}
.body-kwitansi table {
    color: #555;
    width: 100%;
    font-size: 0.9em;
    border: none;
    background: transparent;
}
.body-kwitansi td:last-child {
    font-weight: bold;
}
table.footer-kwitansi td:last-child hr {
    margin: 0;
}
table.footer-kwitansi td:last-child {
    width: 300px;
    font-weight: normal;
    text-align: center;
}
</style>
<?php

// include db connect class
require_once 'db_connect.php';

// connecting to db
$db = new DB_CONNECT();


$sql = "SELECT nopendaftaran, hportu, nama, is_konfirmasi, tgl_konfirmasi FROM calonsiswa WHERE hportu='".$_GET['username']."'";
$query = mysql_query( $sql );
$row = mysql_fetch_array($query);

$date=date_create($row['tgl_konfirmasi']);

if($_GET['page'] == 'daftar'){
	echo "
	Alhamdulillah, data Anda telah tersimpan.<br><br>

	Terimakasih telah mendaftar di Pesantren Al-Qur'an Ma'rifatussalaam.<br><br>

	username : <strong>".$row['hportu']."</strong><br>
	password : <strong>12345</strong><br><br>

	Langkah berikutnya adalah :<br>

	<ol>
		<li>Membayar biaya pendaftaran sebesar Rp 250.000,- dengan cara ditransfer ke rekening atas nama Yayasan Ma'rifatussalaam :
			<ul>
				<li><strong>BRI Syariah KCP Subang Pejuang : 1015 981 403</strong></li>
				<li><strong>BSM KCP Subang : 7099 777 669</strong></li>
			</ul>
		</li>
		<li>Konfirmasi bukti transfer (pilih ke salah satu cara) :
			<ul>
				<li><strong>Dilampirkan via email ke : psb.mtms@gmail.com (untuk santri SMP), pmb.mtms@gmail.com (untuk santri Ma'had)</strong></li>
				<li><strong>Via sms atau WA : 0857 2005 1808</strong></li>
				<li>Jangan lupa, tuliskan nama lengkap calon santri.</li>
			</ul>
		</li>
		<li>Dalam waktu maksimal 3 x 24 jam, Anda akan memperoleh No. Pendaftaran, silahkan tunggu email notifikasi berikutnya.</li>
	</ol>

	Silahkan tentukan hari dan tanggal anda ingin melakukan tes seleksi dan kabarkan via sms ke :

	<strong>
	<ol>
		<li>Evi Siti Soviani - 0896 7605 1475</li>
		<li>Sutisna - 0819 3133 2223</li>
		<li>Jajang Supriatna - 0817 848 680</li>
		<li>Agus Yana - 0896 7876 6935</li>
	</ol>
	</strong>

	<br><br>

	Subang, ".date('d-m-Y')."<br><br>
	Panitia PSMB Ma'rifatussalaam";
} else if($_GET['page'] == 'konfirmasi'){

	if($row['is_konfirmasi'] == 0){
		echo "
		Alhamdulillah, data Anda telah tersimpan.<br><br>

		Terimakasih sudah melakukan pembayaran biaya Pendaftaran SMP Al-Qur'an Ma'rifatussalaam.<br><br>

		Kami akan segera mengkonfirmasi biaya pendaftaran Abi/Ummi<br>

		Silahkan tentukan hari dan tanggal anda ingin melakukan tes seleksi dan kabarkan via sms ke :

		<strong>
		<ol>
			<li>Evi Siti Soviani - 0896 7605 1475</li>
			<li>Sutisna - 0819 3133 2223</li>
			<li>Jajang Supriatna - 0817 848 680</li>
			<li>Agus Yana - 0896 7876 6935</li>
		</ol>
		</strong>

		<br><br>

		Subang, ".date('d-m-Y')."<br><br>
		Panitia PSMB Ma'rifatussalaam";
	} else {
		echo "

		<div class=\"wrap-kwitansi\">
			<div class=\"kwitansi\">
				<div class=\"title-kwitansi\">
					<h3><img src=\"http://psmb.marifatussalaam.org/@dmiral/css/logo.png\"> YAYASAN MA'RIFATUSSALAAM <img src=\"http://psmb.marifatussalaam.org/@dmiral/css/logo.png\"></h3>
				</div>
				<div class=\"body-kwitansi\">
					<h4>BUKTI PEMBAYARAN</h4>
					<table cellspacing=\"0\">
						<tr>
							<td>Telah terima dari</td>
							<td>:</td>
							<td>".ucwords(strtolower($row['nama']))."</td>
						</tr>
						<tr>
							<td>Banyaknya Uang</td>
							<td>:</td>
							<td>Dua Ratus Ribu Rupiah</td>
						</tr>
						<tr>
							<td>Untuk Pembayaran</td>
							<td>:</td>
							<td>Pendaftaran Santri Baru</td>
						</tr>
					</table>
					<table cellspacing=\"0\">
						<tr>
							<td class=\"text-center\"><p><strong>Nomor Pendaftaran <br> ".$row['nopendaftaran']."</strong></p></td>
						</tr>
					</table>
					<table class=\"footer-kwitansi\" cellspacing=\"0\">
						<tr>
							<td>Jumlah Rp. <strong>250.000</strong></td>
							<td></td>
							<td text-align=\"center\">
								<table>
									<tr>
										<td>Subang, ".date_format($date, 'd-m-Y')."</td>
									</tr>
									<tr>
										<td><br><br></td>
									</tr>
									<tr>
										<td><hr><strong>Bendahara</strong></td>
									</tr>
								</table>

							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
		No. Pendaftaran	: <strong>".$row['nopendaftaran']."</strong><br>
		Nama		: <strong>".$row['nama']."</strong><br>
		Username	: <strong>".$row['hportu']."</strong><br>
		Password	: <strong>12345</strong><br><br>

		Silahkan tentukan hari dan tanggal anda ingin melakukan tes seleksi dan kabarkan via sms ke :

		<strong>
		<ol>
			<li>Evi Siti Soviani - 0896 7605 1475</li>
			<li>Sutisna - 0819 3133 2223</li>
			<li>Jajang Supriatna - 0817 848 680</li>
			<li>Agus Yana - 0896 7876 6935</li>
		</ol>
		</strong>

		<br><br>

		Subang, ".date('d-m-Y')."<br><br>
		Panitia PSMB Ma'rifatussalaam";
	}
}

?>
