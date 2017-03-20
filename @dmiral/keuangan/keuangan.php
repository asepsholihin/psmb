<?php
error_reporting(0);
// include db connect class
require_once 'db_connect.php';
// connecting to db
$db = new DB_CONNECT();
$response = array();

if($_POST['transfer'] == 1) {
  $transfer = 1;
} else {
  $transfer = 0;
}

// membuat no referensi
$result = mysql_query("SELECT substring(id_referensi,5,7) as id FROM log_transaksi ORDER BY id_referensi DESC LIMIT 1");
$row = mysql_fetch_assoc($result);
// menambah nilai id
$upid = $row['id'] + 1;
$lastid = date('Y').sprintf('%06s', $upid);

if($_POST['psp'] != "") {
    $sql1 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['psp'])."','Pengembangan Sarana & Prasarana','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql1);
    $response["error"] = "false";
}

if($_POST['psdm'] != "") {
    $sql2 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['psdm'])."','Pengembangan SDM','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql2);
    $response["error"] = "false";
}

if($_POST['kgttahunan'] != "") {
    $sql3 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['kgttahunan'])."','Kegiatan Tahunan','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql3);
    $response["error"] = "false";
}

if($_POST['seragam'] != "") {
    $sql4 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['seragam'])."','Seragam','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql4);
    $response["error"] = "false";
}

if($_POST['buku'] != "") {
    $sql5 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['buku'])."','Buku Paket & Modul','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql5);
    $response["error"] = "false";
}

if($_POST['orientasi'] != "") {
    $sql6 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['orientasi'])."','Orientasi Dan I\'dad','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql6);
    $response["error"] = "false";
}

if($_POST['spp'] != "") {
    $sql7 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['spp'])."','Iuran Bulanan/SPP','".$_POST['keterangan']." ".$_POST['keteranganthn']."','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql7);
    $response["error"] = "false";
}

if($_POST['komitmenbulanan'] != "") {
    $sql8 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['komitmenbulanan'])."','Komitmen Bulanan','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql8);
    $response["error"] = "false";
}

if($_POST['komitmentahunan'] != "") {
    $sql8 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['komitmentahunan'])."','Komitmen Tahunan','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql8);
    $response["error"] = "false";
}

if($_POST['uangsaku'] != "") {
    $sql9 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['uangsaku'])."','Uang Saku','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql9);
    $response["error"] = "false";
}

if($_POST['kaskomite'] != "") {
    $sql10 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['kaskomite'])."','Kas Komite','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql10);
    $response["error"] = "false";
}

if($_POST['infaq'] != "") {
    $sql11 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['infaq'])."','Infaq','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql11);
    $response["error"] = "false";
}

if($_POST['qurban'] != "") {
    $sql12 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['qurban'])."','Qurban','','',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql12);
    $response["error"] = "false";
}

if($_POST['lain'] != "") {
    $sql13 = "INSERT INTO log_transaksi VALUES ('','".$lastid."','".addslashes($_POST['nopendaftaran'])."','".str_replace(',','',$_POST['lain'])."','Lain-lain','','".$_POST['catatan']."',NOW(),'".$_POST['tanggal_transaksi']."','".$transfer."','Evi Siti Soviani','0')";
    mysql_query($sql13);
    $response["error"] = "false";
}

date_default_timezone_set('Asia/Jakarta');
$response["nopendaftaran"] = addslashes($_POST['nopendaftaran']);
$response["tanggal"] = date('Y-m-d');
echo json_encode($response);
?>
