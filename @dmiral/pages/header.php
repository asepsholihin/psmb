<?php
include "config.php";

$sql = "SELECT role_pendaftaran,role_kelulusan,role_user,role_pemberkasan,role_wawancara,role_seleksi,role_quisioner FROM users WHERE username='".$_SESSION[session_username]."'";
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
switch ($row['role_pemberkasan']) {
    case '1':
        $pemberkasan = "
        <li><a class=\"pemberkasan\" href=\"?pg=pemberkasan\">Pemberkasan</a>
            <ul>
                <li><a href=\"pages/daftarberkas.php?tanggal=15-01-2017\" target=\"_blank\">Cetak 15-01-2017</a></li>
                <li><a href=\"pages/daftarberkas.php?tanggal=29-01-2017\" target=\"_blank\">Cetak 29-01-2017</a></li>
                <li><a href=\"pages/daftarberkas.php?tanggal=12-02-2017\" target=\"_blank\">Cetak 12-02-2017</a></li>
                <li><a href=\"pages/daftarberkas.php?tanggal=26-02-2017\" target=\"_blank\">Cetak 26-02-2017</a></li>
            </ul>
        </li>";
        break;
    case '0':
        $pemberkasan = '';
        break;
    default:
        # code...
        break;
}
switch ($row['role_wawancara']) {
    case '1':
        $wawancara = "
        <li>
            <a class=\"wawancara\" href=\"javascript:void(0)\">Wawancara</a>
            <ul>
                <li><a href=\"?pg=wawancara\">Input Wawancara</a></li>
                <li><a href=\"?pg=hasil-wawancara\">Lihat Hasil Wawancara</a></li>
            </ul>
        </li>";
        break;
    case '0':
        $wawancara = '';
        break;
    default:
        # code...
        break;
}
switch ($row['role_seleksi']) {
    case '1':
        $seleksi = "
        <li><a class=\"seleksi\" href=\"?pg=seleksi\">Seleksi</a></li>";
        break;
    case '0':
        $seleksi = '';
        break;
    default:
        # code...
        break;
}
switch ($row['role_quisioner']) {
    case '1':
        $quisioner = "
        <li>
            <a class=\"quisioner\" href=\"javascript:void(0)\">Quisioner</a>
            <ul>
                <li><a href=\"?pg=quisioner\">Input Quisioner</a></li>
                <li><a href=\"?pg=hasil-quisioner\">Lihat Hasil Quisioner</a></li>
            </ul>
        </li>";
        break;
    case '0':
        $quisioner = '';
        break;
    default:
        # code...
        break;
}

$header = "
<ul class=\"nav\">
    <li><a class=\"home\" href=\"?pg=home\">Home</a></li>
    <li><a class=\"calonsantri\" href=\"?pg=calonsantri\">Calon Santri</a></li>
    $pendaftaran
    $kelulusan
    $pemberkasan
    $wawancara
    $seleksi
    $quisioner
    $user
    <li style=\"float:right\"><a class=\"active\" href=\"?pg=logout\">Logout</a></li>
</ul>
";

?>
