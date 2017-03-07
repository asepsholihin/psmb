<?php
include "config.php";
$data = "";
$sql = "
SELECT a.nopendaftaran AS noid,a.nama,a.asalsekolah,a.lulus, b.tkd, b.bacaan, b.tajwid, b.hafalan, b.sholat, b.catatan, c.*, d.*
FROM calonsiswa a
LEFT JOIN nilai_tes b ON a.nopendaftaran=b.nopendaftaran
LEFT JOIN quis_santri c ON a.nopendaftaran=c.nopendaftaran
LEFT JOIN quis_ortu d ON a.nopendaftaran=d.nopendaftaran
WHERE is_konfirmasi=1 AND aktif=1
";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $date = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);

    if($row['lulus'] == '1') {
      $lulus = "<input checked type=\"checkbox\"  name=\"lulus\" data-id=\"1\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    } else {
      $lulus = "<input type=\"checkbox\"  name=\"lulus\" data-id=\"1\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    }

    if($row['lulus'] == '2') {
      $cadangan = "<input checked type=\"checkbox\"  name=\"lulus\" data-id=\"2\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    } else {
      $cadangan = "<input type=\"checkbox\"  name=\"lulus\" data-id=\"2\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    }

    if($row['lulus'] == '3') {
      $mundur = "<input checked type=\"checkbox\"  name=\"lulus\" data-id=\"3\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    } else {
      $mundur = "<input type=\"checkbox\"  name=\"lulus\" data-id=\"3\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>";
    }

    switch ($row['tkd']) {
        case '':
            $tkd = '0';
            break;
        default:
            $tkd = $row['tkd'];
            break;
    }

    $jmltkd = $tkd;
    if($jmltkd >= 60 && $jmltkd < 70) {
      $totaltkd = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$jmltkd."</div>";
    } else if($jmltkd >= 70 && $jmltkd < 80) {
      $totaltkd = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$jmltkd."</div>";
    } else if($jmltkd >= 80 && $jmltkd < 90) {
      $totaltkd = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$jmltkd."</div>";
    } else if($jmltkd >= 90) {
      $totaltkd = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$jmltkd."</div>";
    } else {
      $totaltkd = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$jmltkd."</div>";
    }

    switch ($row['bacaan']) {
        case '':
            $bacaan = '0';
            break;
        default:
            $bacaan = $row['bacaan'];
            break;
    }
    switch ($row['tajwid']) {
        case '':
            $tajwid = '0';
            break;
        default:
            $tajwid = $row['tajwid'];
            break;
    }
    switch ($row['hafalan']) {
        case '':
            $hafalan = '0';
            break;
        default:
            $hafalan = $row['hafalan'];
            break;
    }
    switch ($row['sholat']) {
        case '':
            $sholat = '0';
            break;
        default:
            $sholat = $row['sholat'];
            break;
    }

    $jmlquran = $bacaan + $tajwid + $hafalan + $sholat;
    if($jmlquran >= 60 && $jmlquran < 70) {
      $totalquran = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran >= 70 && $jmlquran < 80) {
      $totalquran = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran >= 80 && $jmlquran < 90) {
      $totalquran = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran >= 90) {
      $totalquran = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else {
      $totalquran = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    }

    $querynilaiwwc = "SELECT catatan, (q001 + q002 + q003 + q004 + q005 + q006 + q007 + q008 + q009 + q010 + q011 + q012 + q013 + q014 + q015 + q016 + q017 + q018 + q019 + q020 + q021) as jml FROM quis_santri WHERE nopendaftaran='".$row['noid']."'";
    $resultwwc = mysql_fetch_assoc(mysql_query($querynilaiwwc));
    switch ($resultwwc['jml']) {
        case '':
            $nilaiwwc = '0';
            break;
        default:
            $nilaiwwc = $resultwwc['jml'];
            break;
    }
    if($nilaiwwc >= 60 && $nilaiwwc < 70) {
      $totalnilaiwwc = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>";
    } else if($nilaiwwc >= 70 && $nilaiwwc < 80) {
      $totalnilaiwwc = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>";
    } else if($nilaiwwc >= 80 && $nilaiwwc < 90) {
      $totalnilaiwwc = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>";
    } else if($nilaiwwc >= 90) {
      $totalnilaiwwc = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>";
    } else {
      $totalnilaiwwc = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>";
    }

    $querynilai = "SELECT q019, q020, (q001 + q002 + q003 + q004 + q005 + q006 + q007 + q008 + q009 + q010 + q011 + q012 + q013 + q014 + q015 + q016 + q017 + q018) AS jml FROM quis_ortu WHERE nopendaftaran='".$row['noid']."'";
    $result = mysql_fetch_assoc(mysql_query($querynilai));
    switch ($result['jml']) {
        case '':
            $nilaiquis = '0';
            break;
        default:
            $nilaiquis = $result['jml'];
            break;
    }
    if($nilaiquis >= 60 && $nilaiquis < 70) {
      $totalnilaiquis = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>";
    } else if($nilaiquis >= 70 && $nilaiquis < 80) {
      $totalnilaiquis = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>";
    } else if($nilaiquis >= 80 && $nilaiquis < 90) {
      $totalnilaiquis = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>";
    } else if($nilaiquis >= 90) {
      $totalnilaiquis = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>";
    } else {
      $totalnilaiquis = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>";
    }

    $data.="
    <tr>
        <td>".$no."</td>
        <td>
            <div class=\"Checkbox\">
              ".$lulus."
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
              ".$cadangan."
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
              ".$mundur."
            </div>
        </td>
        <td>".$row['noid']."</td>
        <td>".ucwords(strtolower($row['nama']))."<br><strong>".$row['asalsekolah']."</strong></td>
        <td>".$totaltkd."</td>
        <td>".$totalquran."</td>
        <td>".$totalnilaiwwc."</td>
        <td>".$totalnilaiquis."</td>
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
			<th class=\"no-sort\" width=\"1\">Lulus</th>
			<th class=\"no-sort\" width=\"1\">Cadangan</th>
			<th class=\"no-sort\" width=\"1\">Mundur</th>
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>TKD</th>
			<th>QUR'AN</th>
			<th>WAWANCARA</th>
			<th>QUISIONER</th>
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>
<button class=\"button\" onclick=\"lulus()\">Lulus</button>

<div class=\"loading\">Loading</div>

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
    $('.kelulusan').addClass('active');
});
function lulus(){
    $('.loading').show();
    var checkedValues = $('input[name=lulus]:checked').map(function() {
        return this.value;
    }).get();
    var checkedData = $('input[name=lulus]:checked').map(function() {
        return $(this).data('id');
    }).get();
    var r = confirm('Yakin mereka lulus?');
    if (r == true) {
        $.post('http://localhost/psmb/api/admin/lulus.php',
        {
            id: checkedValues,
            data: checkedData
        },
        function(data){
          var obj = JSON.parse(data);
          if (!obj.error) {
              window.location.href = '?pg=kelulusan';
          } else {
              alert('Ada yang salah!');
          }
        });
    }
}
</script>
";

mysql_close($koneksi);
?>
