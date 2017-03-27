<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db     = 'psmb';

$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

if(! $koneksi )
{
  die('error');
}
?>
