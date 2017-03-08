<?php
error_reporting(0);

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

$sql = "SELECT nopendaftaran FROM berkas WHERE nopendaftaran='".$_POST['nopendaftaran']."'";
$cek = mysql_num_rows(mysql_query($sql));

if($cek > 0) {
    if($_POST['nopendaftaran'] != null) {
	    $sql = "UPDATE berkas SET 
	    nisn 			= '".$_POST['nisn']."',
	    akta_kelahiran 	= '".$_POST['akta_kelahiran']."',
	    ktp 			= '".$_POST['ktp']."',
	    kartu_keluarga	= '".$_POST['kartu_keluarga']."',
	    sertifikat		= '".$_POST['sertifikat']."',
	    raport 			= '".$_POST['raport']."',
	    foto 			= '".$_POST['foto']."',
	    catatan 		= '".$_POST['catatan']."'
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
	    $sql = "INSERT INTO berkas values(
	    	'".$_POST['nopendaftaran']."',
	    	'".$_POST['nisn']."',
	    	'".$_POST['akta_kelahiran']."',
	    	'".$_POST['ktp']."',
	    	'".$_POST['kartu_keluarga']."',
	    	'".$_POST['sertifikat']."',
	    	'".$_POST['raport']."',
	    	'".$_POST['foto']."',
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
