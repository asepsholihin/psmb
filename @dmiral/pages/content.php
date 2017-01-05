<?php
include "config.php";
$data ='';
$sql = "SELECT
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1  ) AS jmlpendaftar,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND registrasi='android') AS jmlandroid,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND registrasi='website') AS jmlwebsite,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND kelamin='l' ) AS jmllakilaki,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND kelamin='p' ) AS jmlperempuan,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND is_konfirmasi='1' ) AS jmlkonfirmasi,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND transaksi='transfer' ) AS jmltransfer,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND transaksi='tunai' ) AS jmltunai,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND transaksi='free' ) AS jmlfree,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND info2='15-01-2017' ) AS jmltgl1,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND info2='29-01-2017' ) AS jmltgl2,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND info2='12-02-2017' ) AS jmltgl3,
( SELECT COUNT(replid) FROM calonsiswa WHERE aktif=1 AND info2='26-02-2017' ) AS jmltgl4";
$query = mysql_query($sql);
$no = 1;
$row = mysql_fetch_assoc($query);
$content = "
<meta http-equiv=\"refresh\" content=\"300\">
<div class=\"wrapbox\">
    <div class=\"countbox\">
        <h1>".$row['jmllakilaki']."</h1>
        Ikhwan
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmlperempuan']."</h1>
        Akhwat
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmlkonfirmasi']."</h1>
        Sudah Bayar
    </div>
</div>
<div class=\"wrapbox\">
    <div class=\"countbox\">
        <h1>".$row['jmltransfer']."</h1>
        Transfer
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmltunai']."</h1>
        Tunai
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmlfree']."</h1>
        Free
    </div>
</div>
<div class=\"wrapbox\">
    <div class=\"countbox\">
        <h1>".$row['jmlpendaftar']."</h1>
        Total Pendaftar
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmlandroid']."</h1>
        Daftar Android
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmlwebsite']."</h1>
        Daftar Website
    </div>
    <!--<div class=\"countbox\">
        <h1>".$row['jmllulus']."</h1>
        Santri Lulus
    </div>-->
</div>
<div class=\"wrapbox\">
    <div class=\"countbox\">
        <h1>".$row['jmltgl1']."</h1>
        Tes 15-01-2017
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmltgl2']."</h1>
        Tes 29-01-2017
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmltgl3']."</h1>
        Tes 12-02-2017
    </div>
    <div class=\"countbox\">
        <h1>".$row['jmltgl4']."</h1>
        Tes 26-02-2017
    </div>
</div>

<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
<script>
$(document).ready(function(){
    $('.home').addClass('active');
});
</script>
";

mysql_close($koneksi);
?>
