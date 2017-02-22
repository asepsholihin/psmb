<?php

// array for JSON response
$response = array();

// include db connect class
require_once 'db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT ujian1,ujian2,ujian3,ujian4,ujian5,ujian6,ujian7,ujian8,ujian9,ujian10,ujian11,ujian12 FROM calonsiswa WHERE hportu='".$_GET['username']."'";
$query = mysql_query( $sql );

if(! $query ){
    $response["error"] = true;
    $response["message"] = "Terjadi kesalahan server!";
}else {
    $response["error"] = false;
    $row = mysql_fetch_object($query);
    $response['error'] = false;
    $response['data'] = $row;
}

echo json_encode($response);
?>
