<?php

// array for JSON response
$response = array();

// include db connect class
require_once 'db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT konfirmasi_biaya as biaya, nilai FROM calonsiswa WHERE hportu='".$_GET['username']."'";
$query = mysql_query( $sql );

if(! $query ){
    $response["error"] = true;
    $response["message"] = "Terjadi kesalahan server!";
}else {
    $response["error"] = false;
    $row = mysql_fetch_assoc($query);

    switch ($row['biaya']) {
        case '1':
            $row['biaya']='true';
            break;
        case '0':
            $row['biaya']='false';
            break;
        default:
            # code...
            break;
    }
    switch ($row['nilai']) {
        case '1':
            $row['nilai']='true';
            break;
        case '0':
            $row['nilai']='false';
            break;
        default:
            # code...
            break;
    }

    $response['data'] = $row;
}

echo json_encode($response);
?>
