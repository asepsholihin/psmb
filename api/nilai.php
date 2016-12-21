<?php

// array for JSON response
$response = array();

require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "UPDATE calonsiswa SET
nilai = '1',
ujian1 ='".$_POST['k4pai']."',
ujian2 ='".$_POST['k4mtk']."',
ujian3 ='".$_POST['k4ind']."',
ujian4 ='".$_POST['k4ipa']."',
ujian5 ='".$_POST['k5pai']."',
ujian6 ='".$_POST['k5mtk']."',
ujian7 ='".$_POST['k5ind']."',
ujian8 ='".$_POST['k5ipa']."',
ujian9 ='".$_POST['k6pai']."',
ujian10 ='".$_POST['k6mtk']."',
ujian11 ='".$_POST['k6ind']."',
ujian12 ='".$_POST['k6ipa']."'
WHERE hportu='".$_POST['username']."'";
$query = mysql_query( $sql );

if(! $query ){
    $response["error"] = true;
    $response["message"] = "Terjadi kesalahan server!";
}else {
    $response["error"] = false;
    $response["message"] = "Nilai sudah tersimpan!";
}

echo json_encode($response);
?>
