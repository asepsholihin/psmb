<?php

// array for JSON response
$response = array();

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT username, nama FROM users WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."'";
$query = mysql_query($sql);
$data = mysql_fetch_row($query);
$row = mysql_num_rows($query);
if( $row > 0 ) {
	session_start();
    	$_SESSION["session_logged"] = "true";
	$_SESSION["session_username"] = $data[0];
	$_SESSION["session_name"] = $data[1];
    	$response["error"] = false;
}else{
    $response["error"] = true;
    $response["message"] = $sql;
}

echo json_encode($response);
?>
