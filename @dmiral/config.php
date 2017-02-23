<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db('psmb');

if(! $koneksi )
{
  die('error');
}
?>
