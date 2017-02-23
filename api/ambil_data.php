<?php

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT *, RIGHT(tgllahir,2) AS s_tgllahir, SUBSTRING(tgllahir,6,2) AS s_blnlahir, LEFT(tgllahir,4) AS s_thnlahir FROM calonsiswa WHERE hportu='".$_GET['username']."'";
$query = mysql_query($sql);
if($query){
    while($row = mysql_fetch_object($query)) {
        $response['error'] = false;
        $response['data'] = $row;
    }
    echo json_encode($response);
} else {

}

?>
