<?php
error_reporting(0);
// include db connect class
require_once '../db_connect.php';

// connecting to db
$db = new DB_CONNECT();

$sql = "SELECT nama, nopendaftaran from calonsiswa where aktif='1' and nama like '%".$_POST['search']."%'";
$query = mysql_query($sql);
if($query){
	while($row = mysql_fetch_assoc($query)) {
		echo "<li><a onclick=\"setsearch('".ucwords(strtolower($row['nama']))."','".$row['nopendaftaran']."')\" href=\"javascript:void(0)\">".$row['nama']." <br> ".$row['nopendaftaran']."</a></li>";
	}
    
} else {
    echo "error";
}


?>
