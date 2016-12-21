<?php

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

if($_POST['hportu'] != null) {
    $sql = "UPDATE calonsiswa SET info2='".$_POST['info2']."' WHERE hportu='".$_POST['hportu']."'";
    $query = mysql_query($sql);
    if($query){
        $response["error"] = false;
    } else {
        $response["error"] = true;
        $response["message"] = $sql;
    }
}
echo json_encode($response);

?>
