<?php
error_reporting(0);

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

$sql = "SELECT nopendaftaran FROM nilai_tes WHERE nopendaftaran='".$_POST['nopendaftaran']."'";
$cek = mysql_num_rows(mysql_query($sql));

if($cek > 0) {
    if($_POST['nopendaftaran'] != null) {
	    $sql = "UPDATE nilai_tes SET 
	    petugas 			= '".$_POST['petugas']."',
	    tkd 				= '".$_POST['tkd']."',
	    bacaan				= '".$_POST['bacaan']."',
	    tajwid				= '".$_POST['tajwid']."',
	    hafalan 			= '".$_POST['hafalan']."',
	    sholat 				= '".$_POST['sholat']."',
	    catatan 			= '".$_POST['catatan']."'
		WHERE nopendaftaran = '".$_POST['nopendaftaran']."'";
	    
	    $query = mysql_query($sql);
	    if($query){
            $response["error"] = false;
	    } else {
            $response["error"] = true;
            $response["message"] = $sql;
	    }
	}
} else {
	if($_POST['nopendaftaran'] != null) {
	    $sql = "INSERT INTO nilai_tes values(
	    	'".$_POST['nopendaftaran']."',
	    	'".$_POST['petugas']."',
	    	NOW(),
	    	'".$_POST['tkd']."',
	    	'".$_POST['bacaan']."',
	    	'".$_POST['tajwid']."',
	    	'".$_POST['hafalan']."',
	    	'".$_POST['sholat']."',
	    	'".$_POST['catatan']."')";
	    
	    $query = mysql_query($sql);
	    if($query){
            $response["error"] = false;
	    } else {
            $response["error"] = true;
            $response["message"] = $sql;
	    }
	}
}
echo json_encode($response);

?>
