<?php

require_once 'db_connect.php';
$db = new DB_CONNECT();

$response = array();

$sql = "SELECT nopendaftaran, nama FROM calonsiswa WHERE lulus=1 OR lulus=2 ORDER BY nama ASC";
$query = mysql_query($sql);
while($row = mysql_fetch_array($query)){
    $response[] = $row;
}

echo json_encode($response);

?>
