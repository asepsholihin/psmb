<?php
error_reporting(0);

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

$sql = "INSERT INTO quis_ortu SET
nopendaftaran = '".$_POST['nopendaftaran']."',
petugas = '".$_POST['petugas']."',
tanggal = NOW(),
evaluasi = '".$_POST['evaluasi']."',
q001 = '".$_POST['quis1']."',
q002 = '".$_POST['quis2']."',
q003 = '".$_POST['quis3']."',
q004 = '".$_POST['quis4']."',
q005 = '".$_POST['quis5']."',
q006 = '".$_POST['quis6']."',
q007 = '".$_POST['quis7']."',
q008 = '".$_POST['quis8']."',
q009 = '".$_POST['quis9']."',
q010 = '".$_POST['quis10']."',
q011 = '".$_POST['quis11']."',
q012 = '".$_POST['quis12']."',
q013 = '".$_POST['quis13']."',
q014 = '".$_POST['quis14']."',
q015 = '".$_POST['quis15']."',
q016 = '".$_POST['quis16']."',
q017 = '".$_POST['quis17']."',
q018 = '".$_POST['quis18']."',
q019 = '".$_POST['quis19']."',
q020 = '".$_POST['quis20']."'
";

if($_POST['nopendaftaran'] != null) {
    $query = mysql_query($sql);
    if($query){
        $response["error"] = false;       
    	$response["message"] = 'Berhasil disimpan';
    } else {
        $response["error"] = true;
    $response["message"] = 'Evaluasi pertama sudah selesai';
    }
} else {
	$response["error"] = true;
    $response["message"] = 'Ada yang salah!';
}
echo json_encode($response);

?>
