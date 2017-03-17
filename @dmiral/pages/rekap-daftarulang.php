<?php
include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran, a.nama, b.tanggal_transaksi FROM calonsiswa a LEFT JOIN log_transaksi b ON a.nopendaftaran=b.nopendaftaran WHERE lulus=1 OR lulus=2 GROUP BY a.nopendaftaran, b.tanggal_transaksi ORDER BY nama ASC";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $sqls = "
    SELECT b.nama, a.transfer, a.tanggal_transaksi,
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Pengembangan Sarana & Prasarana' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'psp',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Pengembangan SDM' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'psdm',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Kegiatan Tahunan' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'kgttahunan',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Seragam' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'seragam',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Buku Paket & Modul' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'buku',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Orientasi Dan I\'dad' AND tanggal_transaksi='".$row['tanggal_transaksi']."' GROUP BY nopendaftaran) AS 'orientasi'
    FROM log_transaksi a JOIN calonsiswa b ON a.nopendaftaran=b.nopendaftaran WHERE a.nopendaftaran='".$row['nopendaftaran']."' GROUP BY a.nopendaftaran
    ";
    $querys = mysql_query($sqls);
    $uang = mysql_fetch_assoc($querys);



    if($uang['nama'] != '') {
      if($$uang['transfer'] == 1) {
        $transfer = 'Transfer';
      } else {
        $transfer = "Tunai";
      }
    } else {
      $transfer = "";
    }

    $data.="
    <tr>
        <td>".$no."</td>
        <td><strong>".$row['nopendaftaran']."</strong><br><a class=\"username\" href=\"pages/detail.php?id=".$row['hportu']."\" target=\"_bank\">".ucwords(strtolower($row['nama']))."</a></td>
        <td class=\"center\">Rp. ".number_format($uang['orientasi'],0,'.','.')."</td>
        <td class=\"center\">Rp. ".number_format($uang['buku'],0,'.','.')."</td>
        <td class=\"center\">Rp. ".number_format($uang['seragam'],0,'.','.')."</td>
        <td class=\"center\">Rp. ".number_format($uang['kgttahunan'],0,'.','.')."</td>
        <td class=\"center\">Rp. ".number_format($uang['psdm'],0,'.','.')."</td>
        <td class=\"center\">Rp. ".number_format($uang['psp'],0,'.','.')."</td>
        <td class=\"center\">".$row['tanggal_transaksi']."</td>
        <td class=\"center\">".$transfer."</td>
    </tr>
    ";
    $no++;

    $date = date_create($row['tgl_konfirmasi']);
}

$content = "
$kwitansi
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
	<thead>
		<tr>
      <th class=\"no-sort\" width=\"1\">No</th>
			<th>Nama</th>
			<th width=\"1\" class=\"no-sort center\">ORIENTASI DAN I'DAD</th>
			<th width=\"1\" class=\"no-sort center\">BUKU PAKET DAN MODUL</th>
			<th width=\"1\" class=\"no-sort center\">SERAGAM</th>
			<th width=\"1\" class=\"no-sort center\">KEGIATAN TAHUNAN</th>
			<th width=\"1\" class=\"no-sort center\">PENGEMBANGAN SDM</th>
			<th width=\"1\" class=\"no-sort center\">PENGEMBANGAN SARPRAS</th>
			<th width=\"1\" class=\"no-sort center\">Tanggal</th>
			<th width=\"1\" class=\"center\">Transaksi</th>
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>

<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
<script type=\"text/javascript\" charset=\"utf8\" src=\"//cdn.datatables.net/1.10.12/js/jquery.dataTables.js\"></script>
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
    $('.calonsantri').addClass('active');

});
</script>
";

mysql_close($koneksi);
?>
