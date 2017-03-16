<?php
error_reporting(0);
require_once 'db_connect.php';
$db = new DB_CONNECT();

$sql = "SELECT b.nama, a.* FROM log_transaksi a JOIN calonsiswa b ON a.nopendaftaran=b.nopendaftaran WHERE jenis='Iuran Bulanan/SPP' ORDER BY tanggal DESC, nama ASC";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_array($query)){
    $data .= "
    <tr>
        <td align=\"center\">".$no."</td>
        <td>".$row['nama']."</td>
        <td>Rp. ".number_format($row['jumlah'],0,",",".")."</td>
        <td>".$row['keterangan']."</td>
        <td>".$row['tanggal_transaksi']."</td>
    </tr>
    ";
    $no++;
}

$sql_jumlah = "
SELECT
(SELECT SUM(jumlah) FROM log_transaksi WHERE jenis='Iuran Bulanan/SPP') AS total,
(SELECT SUM(jumlah) FROM log_transaksi WHERE jenis='Iuran Bulanan/SPP' AND tanggal='2017-01-10') AS today
";
$id = mysql_fetch_array(mysql_query($sql_jumlah));
?>
<style>
body {
    margin: 20px auto;
    width:90%;
    font-family: sans-serif;
}
a {text-decoration: none; color: #0093ff}
table {
    padding: 10px 0;
}
table thead th {
    padding: 10px !important;
    text-align: left;
}
table td {
    padding: 10px;
}
tr.head {
    background: #333;
    color: #fff;
}
</style>
<a href="laporan-koran.php">Laporan Koran</a> | <a href="laporan-spp.php">Laporan SPP</a>
<link rel="stylesheet" type="text/css" href="jquery.dataTables.css">
<table cellspacing="0" id="table_id" class="display">
    <thead>
        <tr class="head">
            <th width="1">No.</th>
            <th>Nama</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $data; ?>
    </tbody>
</table>

<h3>Pemasukan SPP hari ini: Rp. <?php echo number_format($id['today'],0,",","."); ?></h3>
<h3>Total Pemasukan SPP: Rp. <?php echo number_format($id['total'],0,",","."); ?></h3>

<script src="jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
    $('#table_id').DataTable();
});
</script>
