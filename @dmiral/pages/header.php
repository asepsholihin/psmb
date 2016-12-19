<?php
include "config.php";

$sql = "SELECT role_pendaftaran,role_kelulusan,role_user FROM users WHERE username='".$_SESSION[session_username]."'";
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);

switch ($row['role_pendaftaran']) {
    case '1':
        $pendaftaran = "<li><a class=\"konfirmasipembayaran\" href=\"?pg=konfirmasipembayaran\">Konfirmasi Pembayaran</a></li>";
        break;
    case '0':
        $pendaftaran = '';
        break;
    default:
        # code...
        break;
}
switch ($row['role_kelulusan']) {
    case '1':
        $kelulusan = "<li><a class=\"kelulusan\" href=\"?pg=kelulusan\">Kelulusan</a></li>";
        break;
    case '0':
        $kelulusan = '';
        break;
    default:
        # code...
        break;
}
switch ($row['role_user']) {
    case '1':
        $user = "<li><a class=\"user\" href=\"?pg=user\">User</a></li>";
        break;
    case '0':
        $user = '';
        break;
    default:
        # code...
        break;
}

$header = "
<ul>
    <li><a class=\"home\" href=\"?pg=home\">Home</a></li>
    <li><a class=\"calonsantri\" href=\"?pg=calonsantri\">Calon Santri</a></li>
    $pendaftaran
    $kelulusan
    $user
    <li style=\"float:right\"><a class=\"active\" href=\"?pg=logout\">Logout</a></li>
</ul>
";

?>
