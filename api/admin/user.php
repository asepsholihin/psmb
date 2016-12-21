<?php

// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$response = array();

$sql = "SELECT username FROM users WHERE username='".$_POST['username']."'";
$cek = mysql_num_rows(mysql_query($sql));

switch ($_POST['pendaftaran']) {
    case '1':
        $pendaftaran = '1';
        break;
    case '':
        $pendaftaran = '0';
        break;
    default:
        # code...
        break;
}
switch ($_POST['kelulusan']) {
    case '1':
        $kelulusan = '1';
        break;
    case '':
        $kelulusan = '0';
        break;
    default:
        # code...
        break;
}
switch ($_POST['user']) {
    case '1':
        $user = '1';
        break;
    case '':
        $user = '0';
        break;
    default:
        # code...
        break;
}

if ($_POST['type']=='tambah') {
	if($cek > 0) {
        $response["error"] = true;
        $response["message"] = $sql;
	} else {
		if($_POST['username'] != null) {
		    $sql = "INSERT INTO users values('','".$_POST['nama']."','".$_POST['username']."','".md5($_POST['password'])."','".$pendaftaran."','".$kelulusan."','".$user."')";
		    $query = mysql_query($sql);
		    if($query){
                $response["error"] = false;
		    } else {
                $response["error"] = true;
                $response["message"] = $sql;
		    }
		}
	}
} elseif ($_POST['type']=='edit') {
	if($_POST['username'] != null) {
	    $sql = "UPDATE users SET nama='".$_POST['nama']."', username='".$_POST['username']."', role_pendaftaran='".$pendaftaran."', role_kelulusan='".$kelulusan."', role_user='".$user."' WHERE username='".$_POST['username']."'";
	    $query = mysql_query($sql);
	    if($query){
            $response["error"] = false;
            $response["message"] = $sql;
	    } else {
            $response["error"] = true;
            $response["message"] = $sql;
	    }
	}
}

echo json_encode($response);
?>
