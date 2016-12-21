<?php
error_reporting(0);
require_once __DIR__ . '/db_connect.php';
// connecting to db
$db = new DB_CONNECT();

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    $allowed_ext	= array('jpg', 'png', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip');
	$file_name		= $_FILES['file']['name'];
	$file_ext		= strtolower(end(explode('.', $file_name)));
	$file_size		= $_FILES['file']['size'];
	$file_tmp		= $_FILES['file']['tmp_name'];

	$nama			= "IMG_".date('YmdHis');

	if(in_array($file_ext, $allowed_ext) === true){
		if($file_size < 1044070){
			$lokasi = '../public_html/psmb/img/uploads/'.$nama.'.'.$file_ext;
			$urlpath = 'http://psmb.marifatussalaam.org/img/uploads/'.$nama.'.'.$file_ext;
			move_uploaded_file($file_tmp, $lokasi);
            $sql = "UPDATE calonsiswa SET konfirmasi_biaya='1', bukti_transfer='".$urlpath."' WHERE hportu='".$_POST['username']."'";
			$in = mysql_query( $sql );
			if($in){
                $response["success"] = 1;
                $response["message"] = "File berhasil di Upload.";
			}else{
                $response["success"] = 0;
                $response["message"] = "Gagal upload file.";
			}
		}else{
            $response["success"] = 0;
            $response["message"] = "Besar ukuran file (file size) maksimal 1 Mb.";
		}
	}else{
        $response["success"] = 0;
        $response["message"] = "Ekstensi file tidak di izinkan.";
	}

}else{
    $response["success"] = 0;
    $response["message"] = "Terjadi kesalahan.";
}
// Echo final json response to client
echo json_encode($response);
?>
