<?php
$dbhost = 'localhost';
$dbuser = 'marifatu_dbapsmb';
$dbpass = 'mtms1zz@t1';
$koneksi = mysql_connect($dbhost, $dbuser, $dbpass);

mysql_select_db('marifatu_psmb');

if(! $koneksi )
{
  die('error');
}
?>
