<?php
require_once 'db_connect.php';
$db = new DB_CONNECT();

$sql = "SELECT b.nama, a.nopendaftaran, a.tanggal_transaksi, a.tanggal, a.id_referensi, a.transfer FROM log_transaksi a JOIN calonsiswa b ON a.nopendaftaran=b.nopendaftaran GROUP BY id_referensi ORDER BY tanggal DESC";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_array($query)){

  if($row['transfer'] == 1) {
    $transaksi = "Transfer";
  } else {
    $transaksi = "Tunai";
  }

  $data .= "
  <tr>
      <td align=\"center\">".$no."</td>
      <td>".$row['nama']."</td>
      <td>".$row['tanggal_transaksi']."</td>
      <td>".$transaksi."</td>
      <td><a href=\"faktur.php?id_referensi=".$row['id_referensi']."\" target=\"_blank\">Print</td>
  </tr>
  ";
  $no++;
}
?>
<style>
body {
    margin: 20px auto;
    width:70%;
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
            <th>Tanggal</th>
            <th>Transaksi</th>
            <th>Kwitansi</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $data; ?>
    </tbody>
</table>

<script src="jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
    $('#table_id').DataTable({
        'columnDefs': [
            {
                'targets': 'no-sort',
                'orderable': false,
            }
        ]
    });
});
</script>
