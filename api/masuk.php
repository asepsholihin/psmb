<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT hportu, nama FROM calonsiswa WHERE hportu='".$_POST['username']."' AND info3='".$_POST['password']."'";
$query = mysql_query($sql);
$data = mysql_fetch_row($query);
$row = mysql_num_rows($query);
if( $row > 0 ) {
    $response["error"] = false;
    $response["username"] = $_POST['username'];
    $response["nama"] = $data[1];
}else{
    $response["error"] = true;
    $response["message"] = "Username atau Password salah!";
}

echo json_encode($response);
?>
