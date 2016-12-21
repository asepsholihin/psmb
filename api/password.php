<?php
require_once __DIR__ . '/db_connect.php';
// connecting to db
$db = new DB_CONNECT();

$newpass = $_POST['newpass'];
$oldpass = $_POST['oldpass'];

$password = mysql_fetch_row(mysql_query("SELECT info3 FROM calonsiswa WHERE hportu='".$_POST['username']."'"));

if($oldpass == $password[0]){
    $sql = "UPDATE calonsiswa SET info3='".$newpass."' WHERE hportu='".$_POST['username']."'";
    $query = mysql_query($sql);
    if($query){
        echo 'Password telah berubah.';
    }else{
        echo 'Terjadi kesalahan server.';
    }
} else {
    echo 'Password yang anda masukkan tidak sesuai.';
}

?>
