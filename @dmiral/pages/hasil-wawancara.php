<?php
include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran,a.nama,a.tmplahir,a.tgllahir,a.asalsekolah,a.hportu,b.petugas FROM calonsiswa a INNER JOIN quis_santri b ON a.nopendaftaran=b.nopendaftaran WHERE lulus=0 and aktif=1";
$query = mysqli_query($koneksi, $sql);
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
    $date = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);

    $querynilai = "SELECT catatan, (q001 + q002 + q003 + q004 + q005 + q006 + q007 + q008 + q009 + q010 + q011 + q012 + q013 + q014 + q015 + q016 + q017 + q018 + q019 + q020 + q021) as jml FROM quis_santri WHERE nopendaftaran='".$row['nopendaftaran']."'";
    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $querynilai));
    $nilai = $result['jml'];

    if($nilai >= 60 && $nilai < 70) {
      $nilaiwwc = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$nilai."</div>";
    } else if($nilai >= 70 && $nilai < 80) {
      $nilaiwwc = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$nilai."</div>";
    } else if($nilai >= 80 && $nilai < 90) {
      $nilaiwwc = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$nilai."</div>";
    } else if($nilai >= 90 && $nilai <= 100) {
      $nilaiwwc = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$nilai."</div>";
    } else {
      $nilaiwwc = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$nilai."</div>";
    }

    $data.="
    <tr>
        <td>".$no."</td>
        <td>".$row['nopendaftaran']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".$nilaiwwc."</td>
        <td><textarea class=\"catatan\" disabled>".$result['catatan']."</textarea></td>
        <td class=\"center\"><a target=\"_blank\" href=\"pages/detail-wawancara.php?nopendaftaran=".$row['nopendaftaran']."&nama=".ucwords(strtolower($row['nama']))."\">Cetak</a></td>
    </tr>
    ";
    $no++;
}

$content = "
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
	<thead>
		<tr>
      <th class=\"no-sort\" width=\"1\">No</th>
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th class=\"center\">Nilai</th>
			<th class=\"center\">Catatan</th>
			<th class=\"center\">Wawancara</th>
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
    $('.wawancara').addClass('active');
});
</script>
";

mysqli_close($koneksi);
?>
