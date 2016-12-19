<?php
include "config.php";
session_start();
$sql = "SELECT konfirmasi_biaya,ujian1,ujian2,ujian3,ujian4,ujian5,ujian6,ujian7,ujian8,ujian9,ujian10,ujian11,ujian12 FROM calonsiswa WHERE hportu='".$_SESSION["session_username"]."'";
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);
switch ($row['konfirmasi_biaya']) {
    case '0':
        $info1 = '<p class="info text-warning bg-warning">Belum konfirmasi biaya pendaftaran! silahkan konfirmasi <a href="?pg=konfirmasipembayaran">disini</a></p>';
        break;
    default:
        break;
}
if ($row['ujian1'] == 0 || $row['ujian2'] == 0 || $row['ujian3'] == 0 || $row['ujian4'] == 0 || $row['ujian5'] == 0 || $row['ujian6'] == 0 || $row['ujian7'] == 0 || $row['ujian8'] == 0 || $row['ujian9'] == 0 || $row['ujian10'] == 0 || $row['ujian11'] == 0 || $row['ujian12'] == 0) {
    $info2 = '<p class="info text-warning bg-warning">Belum mengisi nilai raport SD! silahkan isi <a href="?pg=uploadnilai">disini</a></p>';
}


$content = "
<div class=\"row\">
    <div class=\"col-md-6 col-md-offset-3\">
        <h2>Selamat Datang, ".$_SESSION["session_name"]."</h2>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-6 col-md-offset-3\">
        $info1
        $info2
    </div>
</div>

<script>
$(document).ready(function(){
    $('.home').addClass('active');

});
</script>
";

mysql_close($koneksi);
?>
