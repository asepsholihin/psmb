<?php

require_once __DIR__ . '/db_connect.php';
// connecting to db
$db = new DB_CONNECT();

// array for JSON response
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

	$image = $_POST['image'];
	$name = "IMG_".date('YmdHis').".png";
	$path = "../public_html/psmb/img/uploads/".$name;
	$urlpath = "http://psmb.marifatussalaam.org/img/uploads/".$name;
		
	$sql = "UPDATE calonsiswa
	SET konfirmasi_biaya='1', bukti_transfer='".$urlpath."'
	WHERE hportu='".$_POST['username']."'";
	if(mysql_query($sql)){
		file_put_contents($path,base64_decode($image));
		$response["error"] = false;
		$response["message"] = 'Terimakasih sudah melakukan konfirmasi.';
	}else {
		$response["error"] = true;
    		$response["message"] = "Terjadi kesalahan.";
    }

}else{
	$response["error"] = true;
	$response["message"] = "Terjadi kesalahan.";
}
// Echo final json response to client

echo json_encode($response);
?>
