<?php

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sqlcek = "SELECT replid,nama,emailayah,kelamin FROM calonsiswa WHERE hportu='".$_POST['id']."'";
$querycek = mysql_query( $sqlcek );
$datacek = mysql_fetch_assoc($querycek);

if($datacek['kelamin'] == 'l') {
    $departemen = '30';
} else if($datacek['kelamin'] == 'p'){
    $departemen = '31';
}

//Generate No Pendaftaran!
$nopendaftaran = '2017'.$departemen.$datacek['replid'];

$sql = "UPDATE calonsiswa SET transaksi='".$_POST['type']."', is_konfirmasi=1, nopendaftaran='".$nopendaftaran."', tgl_konfirmasi=now() WHERE hportu='".$_POST['id']."'";
$query = mysql_query( $sql );

if(! $query ){
    echo 'error';
}else {
    echo 'success';

    $name=$datacek['nama'];
    $email=$datacek['emailayah'];
    $blind_email = "psb.mtms@gmail.com";
    $subject='Notifikasi No. Pendaftaran : '.$datacek['nama'].' - '.$nopendaftaran;

    $message="
    Assalaamu'alaikum wa Rahmatullaahi wa Barakaatuh.<br>
    Jazakumullah khairan katsir telah membayar biaya pendaftaran seleksi Penerimaan Santri & Mahasantri Baru Pesantren Al-Qur'an Ma'rifatussalaam untuk tahun pelajaran 2017-2018.<br><br>

    Berikut ini adalah No. Pendaftaran :<br><br>

    <strong>
    Nama : ".$datacek['nama']."<br>
    No. Pendaftaran : ".$nopendaftaran."<br><br>
    </strong>

    Silahkan pilih tanggal kedatangan untuk melaksanakan rangkaian tes seleksi :<br>

    <strong>
    - 15 Januari 2016 dan 29 Januari 2017<br>
    - 12 Februari 2016 dan 26 Februari 2017<br><br>
    </strong>

    Konfirmasi kedatangan via sms/WA : <strong>0857 2005 1808</strong><br>
    Dengan format : <strong>#Nama Calon Santri#No Pendaftaran#Tanggal Kedatangan(hari-bulan-tahun)</strong><br>
    Jam Pelayanan : 08.00-15.00<br><br>

    Tes seleksi meliputi :<br>

    1. Wawancara Calon Santri<br>
    - Keseharian, Motivasi<br>

    2. Tes Al-Qur’an<br>
    - Tahsin<br>
    - Hafalan<br>

    3. Tes Kemampuan Dasar<br>
    - Matematika (10 soal)<br>
    - IPA (10 soal)<br>
    - Bahasa (10 soal)<br>
    - Pengetahuan Aqidah dan Ibadah (10 soal)<br>

    4. Presentasi & Komitmen Orang Tua<br>
    - Quesioner Survey<br>
    - Komitmen Pembiayaan & Kontribusi<br>
    - Catatan Orang Tua/Wali tentang Calon Santri<br>

    5. Tes Potensi Kesehatan<br>
    - Mengirimkan surat keterangan tidak mengidap penyakit menular atau berbahaya dari dokter<br>

    Jangan lupa untuk membaca/mempelajari tata tertib Pesantren Al-Qur'an Ma'rifatussalaam.<br><br>

    Mohon email ini tidak dihapus dan jangan me-replay ke alamat email ini.<br><br>
    Syukron.<br>
    Wassalaamu 'alaikum wa Rahmatullaahi wa Barakaatuh.<br><br>
    Panitia PSMB Ma'rifatussalaam
    ";

    $to=$email;

    $message=$message;

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .="bcc: $blind_email\n";
    $headers .= "X-Priority: 1 (Highest)\n";
    $headers .= "X-MSMail-Priority: High\n";
    $headers .= "Importance: High\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

    // More headers
    $headers .= 'From: Panitia PSMB Ma\'rifatussalaam <noreply@marifatussalaam.org>'."\r\n";
    @mail($to,$subject,$message,$headers);

}

?>
