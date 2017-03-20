<?php
include "config.php";
$data = "";
$sql = "SELECT b.id_referensi, a.nopendaftaran, a.nama, b.tanggal_transaksi FROM calonsiswa a LEFT JOIN log_transaksi b ON a.nopendaftaran=b.nopendaftaran WHERE lulus=1 OR lulus=2 GROUP BY a.nopendaftaran, b.tanggal_transaksi, b.transfer ORDER BY nama ASC";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $sqls = "
    SELECT b.nama, a.transfer, a.tanggal_transaksi,
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Pengembangan Sarana & Prasarana' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'psp',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Pengembangan SDM' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'psdm',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Kegiatan Tahunan' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'kgttahunan',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Seragam' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'seragam',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Buku Paket & Modul' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'buku',
    (SELECT jumlah FROM log_transaksi WHERE nopendaftaran='".$row['nopendaftaran']."' AND jenis='Orientasi Dan I\'dad' AND id_referensi='".$row['id_referensi']."' GROUP BY nopendaftaran) AS 'orientasi'
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

$sqltotal = "
SELECT
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Orientasi Dan I\'dad') AS orientasi,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Buku Paket & Modul') AS buku,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Seragam') AS seragam,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Kegiatan Tahunan') AS kgttahunan,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Pengembangan SDM') AS psdm,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Pengembangan Sarana & Prasarana') AS psp,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Komitmen Bulanan') AS komitmenbulanan,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Komitmen Tahunan') AS komitmentahunan,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Uang Saku') AS uangsaku,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Kas Komite') AS kaskomite,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Infaq') AS infaq,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Qurban') AS qurban,
(SELECT IFNULL(SUM(jumlah), 0) FROM `log_transaksi` WHERE jenis='Iuran Bulanan/SPP') AS spp
";
$querytotal = mysql_query($sqltotal);
$total = mysql_fetch_array($querytotal);

$content = "
$kwitansi
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
	<thead>
		<tr>
      <th class=\"no-sort\" width=\"1\">No</th>
			<th width=\"1\">Nama</th>
			<th class=\"no-sort center\">ORIENTASI DAN I'DAD</th>
			<th class=\"no-sort center\">BUKU PAKET DAN MODUL</th>
			<th class=\"no-sort center\">SERAGAM</th>
			<th class=\"no-sort center\">KEGIATAN TAHUNAN</th>
			<th class=\"no-sort center\">PENGEMBANGAN SDM</th>
			<th class=\"no-sort center\">PENGEMBANGAN SARPRAS</th>
			<th width=\"1\" class=\"no-sort center\">Tanggal</th>
			<th width=\"1\" class=\"center\">Transaksi</th>
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>
<br><br>

<div class=\"wrapbox\">
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['orientasi'],0,'.','.')."</h2></a>
      Orientasi Dan I'dad
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['buku'],0,'.','.')."</h2></a>
      Buku Paket & Modul
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['seragam'],0,'.','.')."</h2></a>
      Seragam
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['kgttahunan'],0,'.','.')."</h2></a>
      Kegiatan Tahunan
  </div>
</div>
<div class=\"wrapbox\">
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['psdm'],0,'.','.')."</h2></a>
      Pengembangan SDM
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['psp'],0,'.','.')."</h2></a>
      Pengembangan Sarpras
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['komitmenbulanan'],0,'.','.')."</h2></a>
      Komitmen Bulanan
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['komitmentahunan'],0,'.','.')."</h2></a>
      Komitmen Tahunan
  </div>
</div>

<div class=\"wrapbox\">
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['uangsaku'],0,'.','.')."</h2></a>
      Uang Saku
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['kaskomite'],0,'.','.')."</h2></a>
      Kas Komite
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['infaq'],0,'.','.')."</h2></a>
      Infaq
  </div>
  <div class=\"countbox\">
      <h2>Rp. ".number_format($total['qurban'],0,'.','.')."</h2></a>
      Qurban
  </div>
</div>

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
    $('.konfirmasipembayaran').addClass('active');

});
</script>
";

mysql_close($koneksi);
?>
