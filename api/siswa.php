<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$_POST['agama'] = "Islam";
$tahunmasuk = "2017";

switch ($_POST['kelamin']) {
    case 'Laki-laki':
        $kelamin='l';
        break;
    case 'Perempuan':
        $kelamin='p';
        break;
    default:
        # code...
        break;
}

switch ($_POST['warga']) {
    case 'Warga Negara Indonesia':
        $warga='WNI';
        break;
    case 'Warga Negara Asing':
        $warga='WNA';
        break;
    default:
        # code...
        break;
}

switch ($_POST['blnlahir']) {
    case 'Januari':
        $unblnlahir = '1';
        break;
    case 'Februari':
        $unblnlahir = '2';
        break;
    case 'Maret':
        $unblnlahir = '3';
        break;
    case 'April':
        $unblnlahir = '4';
        break;
    case 'Mei':
        $unblnlahir = '5';
        break;
    case 'Juni':
        $unblnlahir = '6';
        break;
    case 'Juli':
        $unblnlahir = '7';
        break;
    case 'Agustus':
        $unblnlahir = '8';
        break;
    case 'September':
        $unblnlahir = '9';
        break;
    case 'Oktober':
        $unblnlahir = '10';
        break;
    case 'November':
        $unblnlahir = '11';
        break;
    case 'Desember':
        $unblnlahir = '12';
        break;
    default:
        # code...
        break;
}

$un_tgllahir = date_create($_POST['tgllahir']."-".$unblnlahir."-".$_POST['thnlahir']);
$tgllahir = date_format($un_tgllahir,"Y-m-d");

if(!empty($_POST['username'])){
    $type = "UPDATE calonsiswa SET ";
    $where = "WHERE hportu='".$_POST['username']."'";
    $hportu = 0;
    $val_info3 = mysql_fetch_row(mysql_query("SELECT info3 FROM calonsiswa WHERE hportu='".$_POST['hportu']."'"));
    $info3 = $val_info3[0];
    $ts = "";
} else {
    $type = "INSERT INTO  calonsiswa SET replid='',";
    $where = "";
    $hportu = mysql_num_rows(mysql_query("SELECT hportu FROM calonsiswa WHERE hportu='".$_POST['hportu']."'"));
    $info3 = "12345";
    $ts = "ts=now(),";
}

if(!empty($_POST['registrasi'])){
    $registrasi = "website";
} else {
    $registrasi = "android";
}

// mysql inserting a new row
$sql = "".$type."
nisn='".$_POST['nisn']."',
nik='".$_POST['nik']."',
noun='".$_POST['noun']."',
nama='".addslashes($_POST['nama'])."',
panggilan='".addslashes($_POST['panggilan'])."',
aktif='1',
tahunmasuk='".$tahunmasuk."',
suku='".$_POST['suku']."',
agama='Islam',
status='".$_POST['status']."',
kondisi='".$_POST['kondisi']."',
kelamin='".$kelamin."',
tmplahir='".addslashes($_POST['tmplahir'])."',
tgllahir='".$tgllahir."',
warga='".$warga."',
anakke='".$_POST['anakke']."',
jsaudara='".$_POST['jmlsodara']."',
statusanak='".$_POST['statusanak']."',
jkandung='".$_POST['jmlsodara']."',
jtiri='".$_POST['jmltiri']."',
bahasa='".$_POST['bahasa']."',
berat='".$_POST['berat']."',
tinggi='".$_POST['tinggi']."',
darah='".$_POST['darah']."',
alamatsiswa='".addslashes($_POST['alamatsiswa'])."',
jarak='".$_POST['jaraksekolah']."',
kodepossiswa='".$_POST['kodepossiswa']."',
hpsiswa='".$_POST['hpsiswa']."',
emailsiswa='".$_POST['emailsiswa']."',
kesehatan='".$_POST['penyakit']."',
asalsekolah='".addslashes($_POST['asalsekolah'])."',
noijasah='".$_POST['noijasah']."',
tglijasah='".$_POST['tglijasah']."',
ketsekolah='".addslashes($_POST['alamatsekolah'])."',
namaayah='".addslashes($_POST['namaayah'])."',
namaibu='".addslashes($_POST['namaibu'])."',
statusayah='".$_POST['statusayah']."',
statusibu='".$_POST['statusibu']."',
tmplahirayah='".$_POST['tmplahirayah']."',
tmplahiribu='".$_POST['tmplahiribu']."',
tgllahirayah='".$_POST['tgllahirayah']."',
tgllahiribu='".$_POST['tgllahiribu']."',
almayah='".$_POST['almayah']."',
almibu='".$_POST['almibu']."',
pendidikanayah='".$_POST['pendidikanayah']."',
pendidikanibu='".$_POST['pendidikanibu']."',
pekerjaanayah='".$_POST['pekerjaanayah']."',
pekerjaanibu='".$_POST['pekerjaanibu']."',
wali='".$_POST['wali']."',
penghasilanayah='".$_POST['penghasilanayah']."',
penghasilanibu='".$_POST['penghasilanibu']."',
alamatortu='".addslashes($_POST['alamatortu'])."',
telponortu='".$_POST['telponortu']."',
hportu='".$_POST['hportu']."',
emailayah='".$_POST['emailayah']."',
info3='".$info3."',
info2='".$_POST['seleksi']."',
".$ts."
registrasi='".$registrasi."'
".$where."
";

if($_POST['nama'] == ""){
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Nama Lengkap anda.";
  echo json_encode($response);
} else if($_POST['panggilan'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Nama Panggilan anda.";
  echo json_encode($response);
} else if($_POST['suku'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Suku anda.";
  echo json_encode($response);
} else if($_POST['agama'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Agama anda.";
  echo json_encode($response);
} else if($_POST['tmplahir'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tempat Lahir anda.";
  echo json_encode($response);
} else if($_POST['tgllahir'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tanggal Lahir anda.";
  echo json_encode($response);
} else if($_POST['anakke'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Anak Keberapa.";
  echo json_encode($response);
} else if($_POST['jmlsodara'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Jumlah Saudara anda.";
  echo json_encode($response);
} else if($_POST['bahasa'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Bahasa anda.";
  echo json_encode($response);
} else if($_POST['berat'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Berat Badan anda.";
  echo json_encode($response);
} else if($_POST['tinggi'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tinggi Badan anda.";
  echo json_encode($response);
} else if($_POST['alamatsiswa'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Alamat anda.";
  echo json_encode($response);
} else if($_POST['asalsekolah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Asal Sekolah anda.";
  echo json_encode($response);
} else if($_POST['alamatsekolah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Alamat Sekolah anda.";
  echo json_encode($response);
} else if($_POST['namaayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Nama Ayah anda.";
  echo json_encode($response);
} else if($_POST['namaibu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Nama Ibu anda.";
  echo json_encode($response);
} else if($_POST['tmplahirayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tempat Lahir Ayah anda.";
  echo json_encode($response);
} else if($_POST['tmplahiribu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tempat Lahir Ibu anda.";
  echo json_encode($response);
} else if($_POST['tgllahirayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tanggal Lahir Ayah anda.";
  echo json_encode($response);
} else if($_POST['tgllahiribu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Tanggal Lahir Ibu anda.";
  echo json_encode($response);
} else if($_POST['pendidikanayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Pendidikan Ayah anda.";
  echo json_encode($response);
} else if($_POST['pendidikanibu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Pendidikan Ibu anda.";
  echo json_encode($response);
} else if($_POST['pekerjaanayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Pekerjaan Ayah anda.";
  echo json_encode($response);
} else if($_POST['alamatortu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Alamat Orangtua anda.";
  echo json_encode($response);
} else if($_POST['hportu'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi HP Ayah/Ibu anda.";
  echo json_encode($response);
} else if($_POST['emailayah'] == "") {
  $response["success"] = 0;
  $response["message"] = "Silahkan isi Email Orangtua anda.";
  echo json_encode($response);
} else {
    if ($hportu > 0 ) {    
        $response["success"] = 0;
        $response["message"] = "No HP sudah digunakan.";
        // echoing JSON response
        echo json_encode($response);
        
    } else {
    	$tambahdata = mysql_query( $sql );
        if(! $tambahdata )
        {
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! terjadi kesalahan server.";

            // echoing JSON response
            echo json_encode($response);
        } else {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Terimakasih telah mendaftar, Silahkan login <a href='http://psmb.marifatussalaam.org/anjungan' class='alert-link'>disini!</a>";

            // echoing JSON response
            echo json_encode($response);

            $name = addslashes($_POST['nama']);
            $email = $_POST['emailayah'];
            $blind_email = "psb.mtms@gmail.com";
            $subject = 'Notifikasi Pendaftaran : '.$_POST['nama'];
            $message = "
            Alhamdulillah, data Anda telah tersimpan.<br><br>

            Terimakasih telah mendaftar di Pesantren Al-Qur'an Ma'rifatussalaam.<br>
            Berikut adalah data yang telah Anda inputkan, silahkan dibaca ulang, jika masih ada yang salah atau kurang, silahkan diperbaiki dan boleh menyusul dilengkapi.<br><br>

            Nama: ".addslashes($_POST['nama'])."<br>
            Kelamin: ".$_POST['kelamin']."<br>
            Tempat Lahir: ".$_POST['tmplahir']."<br>
            Tanggal Lahir: ".$_POST['tgllahir']."-".$unblnlahir."-".$_POST['thnlahir']."<br>
            Asal Sekolah: ".addslashes($_POST['asalsekolah'])."<br><br>


            <strong>Silahkan unduh Aplikasi PSMB Ma'rifatussalaam untuk mengubah data jika ada kesalahan saat mendaftar, konfirmasi pendaftaran dan upload nilai raport <a href='https://play.google.com/store/apps/details?id=psmbmarifatussalaam.asepsholihin.id.psmbmarifatussalaam&hl=in'>disini</a></strong><br><br>

            Gunakan url ini jika tautan diatas tidak bekerja<br>
            https://play.google.com/store/apps/details?id=psmbmarifatussalaam.asepsholihin.id.psmbmarifatussalaam&hl=in <br><br>

            username : ".$_POST['hportu']."<br>
            password : 12345<br>
            *Ubah password sesegera mungkin<br><br><br>

            Langkah berikutnya adalah :<br>
            1. Membayar biaya pendaftaran sebesar Rp 250.000,- dengan cara ditransfer ke rekening atas nama Yayasan Ma'rifatussalaam :<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BRI Syariah KCP Subang Pejuang : 1015 981 403<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BSM KCP Subang : 7099 777 669</strong><br>
            2. Konfirmasi bukti transfer (pilih ke salah satu cara) :<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>a. Dilampirkan via email ke : psb.mtms@gmail.com (untuk santri SMP), pmb.mtms@gmail.com (untuk santri Ma'had)<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. via sms atau WA : 0857 2005 1808</strong><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c. via sms atau WA : 0896 7876 6935 | 0877 2658 2425 | 0817 848 680 | 0812 2431 8410</strong><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jangan lupa, tuliskan nama lengkap calon santri.<br>
            3. Dalam waktu maksimal 3 x 24 jam, Anda akan memperoleh No. Pendaftaran, silahkan tunggu email notifikasi berikutnya.<br><br>

            Mohon email ini tidak dihapus dan jangan me-replay ke alamat email ini.<br><br>

            Subang, ".date('d-m-Y')."<br><br>


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
    }
}

?>
