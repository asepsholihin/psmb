<?php

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

if($_POST['nopendaftaran'] != null) {
  $sql = "UPDATE calonsiswa SET
  nilai   = '1',
  ujian1 	= '".$_POST['4mtk']."',
  ujian2 	= '".$_POST['4ind']."',
  ujian3	= '".$_POST['4ipa']."',
  ujian4	= '".$_POST['4ing']."',
  ujian5 	= '".$_POST['5mtk']."',
  ujian6 	= '".$_POST['5ind']."',
  ujian7	= '".$_POST['5ipa']."',
  ujian8	= '".$_POST['5ing']."',
  ujian9 	= '".$_POST['6mtk']."',
  ujian10 = '".$_POST['6ind']."',
  ujian11	= '".$_POST['6ipa']."',
  ujian12	= '".$_POST['6ing']."'
WHERE nopendaftaran = '".$_POST['nopendaftaran']."'";

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
