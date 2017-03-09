<?php
include "config.php";
$data = "";
$sql = "
SELECT a.nopendaftaran AS noid,a.nama,a.asalsekolah,a.lulus, b.tkd, b.bacaan, b.tajwid, b.hafalan, b.sholat, b.catatan, c.*, d.*, a.ujian1, a.ujian2, a.ujian3, a.ujian4, a.ujian5, a.ujian6, a.ujian7, a.ujian8, a.ujian9, a.ujian10, a.ujian11, a.ujian12, c.catatan as catatansantri, d.q019 as catatanortu1, d.q020 as catatanortu2
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

    if($row['lulus'] == '3') {
      $mundur = "<input checked type=\"checkbox\"  name=\"lulus\" data-id=\"3\" value=\"".$row['noid']."\" /><div class=\"Checkbox-visible\"></div>";
    } else {
      $mundur = "<input type=\"checkbox\"  name=\"lulus\" data-id=\"3\" value=\"".$row['noid']."\" /><div class=\"Checkbox-visible\"></div>";
    }

    $sum = $row['ujian1'] + $row['ujian2'] + $row['ujian3'] + $row['ujian4'] + $row['ujian5'] + $row['ujian6'] + $row['ujian7'] + $row['ujian8'] + $row['ujian9'] + $row['ujian10'] + $row['ujian11'] + $row['ujian12'];
    $avg = number_format($sum / 12, 2,",",".");

    if($avg >= 60 && $avg < 70) {
      $average = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$avg."</div>";
    } else if($avg >= 70 && $avg < 80) {
      $average = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$avg."</div>";
    } else if($avg >= 80 && $avg < 90) {
      $average = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$avg."</div>";
    } else if($avg >= 90 && $avg <= 100) {
      $average = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$avg."</div>";
    } else {
      $average = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$avg."</div>";
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
    if($jmlquran > 150 && $jmlquran <= 200) {
      $totalquran = "
      <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>
      <div class=\"wrap-dialog dialogquran".$no."\">
      <table>
        <tr style=\"background:#e6d500 !important;color:#fff\">
          <td>Bacaan</td>
          <td>Tajwid</td>
          <td>Hafalan</td>
          <td>Sholat</td>
        </tr>
        <tr>
          <td>".$bacaan."</td>
          <td>".$tajwid."</td>
          <td>".$hafalan."</td>
          <td>".$sholat."</td>
        </tr>
        <tr style=\"background:#e6d500 !important;color:#fff\">
          <td colspan=\"4\">Catatan</td>
        </tr>
        <tr>
          <td colspan=\"4\"><textarea rows=\"10\" cols=\"35\">".$row['catatan']."</textarea></td>
        </tr>
      </table>
      </div>
      ";
    } else if($jmlquran > 200 && $jmlquran <= 250) {
      $totalquran = "
      <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>
      <div class=\"wrap-dialog dialogquran".$no."\">
      <table>
        <tr style=\"background:#47b147 !important;color:#fff\">
          <td>Bacaan</td>
          <td>Tajwid</td>
          <td>Hafalan</td>
          <td>Sholat</td>
        </tr>
        <tr>
          <td>".$bacaan."</td>
          <td>".$tajwid."</td>
          <td>".$hafalan."</td>
          <td>".$sholat."</td>
        </tr>
        <tr style=\"background:#47b147 !important;color:#fff\">
          <td colspan=\"4\">Catatan</td>
        </tr>
        <tr>
          <td colspan=\"4\"><textarea rows=\"10\" cols=\"35\">".$row['catatan']."</textarea></td>
        </tr>
      </table>
      </div>
      ";
    } else if($jmlquran > 250 && $jmlquran <= 300) {
      $totalquran = "
      <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>
      <div class=\"wrap-dialog dialogquran".$no."\">
      <table>
        <tr style=\"background:#5a91e2 !important;color:#fff\">
          <td>Bacaan</td>
          <td>Tajwid</td>
          <td>Hafalan</td>
          <td>Sholat</td>
        </tr>
        <tr>
          <td>".$bacaan."</td>
          <td>".$tajwid."</td>
          <td>".$hafalan."</td>
          <td>".$sholat."</td>
        </tr>
        <tr style=\"background:#5a91e2 !important;color:#fff\">
          <td colspan=\"4\">Catatan</td>
        </tr>
        <tr>
          <td colspan=\"4\"><textarea rows=\"10\" cols=\"35\">".$row['catatan']."</textarea></td>
        </tr>
      </table>
      </div>
      ";
    } else if($jmlquran > 300) {
      $totalquran = "
      <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>
      <div class=\"wrap-dialog dialogquran".$no."\">
      <table>
        <tr style=\"background:#9d71e2 !important;color:#fff\">
          <td>Bacaan</td>
          <td>Tajwid</td>
          <td>Hafalan</td>
          <td>Sholat</td>
        </tr>
        <tr>
          <td>".$bacaan."</td>
          <td>".$tajwid."</td>
          <td>".$hafalan."</td>
          <td>".$sholat."</td>
        </tr>
        <tr style=\"background:#9d71e2 !important;color:#fff\">
          <td colspan=\"4\">Catatan</td>
        </tr>
        <tr>
          <td colspan=\"4\"><textarea rows=\"10\" cols=\"35\">".$row['catatan']."</textarea></td>
        </tr>
      </table>
      </div>
      ";
    } else {
      $totalquran = "
      <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>
      <div class=\"wrap-dialog dialogquran".$no."\">
      <table>
        <tr style=\"background:#f13b3b !important;color:#fff\">
          <td>Bacaan</td>
          <td>Tajwid</td>
          <td>Hafalan</td>
          <td>Sholat</td>
        </tr>
        <tr>
          <td>".$bacaan."</td>
          <td>".$tajwid."</td>
          <td>".$hafalan."</td>
          <td>".$sholat."</td>
        </tr>
        <tr style=\"background:#f13b3b !important;color:#fff\">
          <td colspan=\"4\">Catatan</td>
        </tr>
        <tr>
          <td colspan=\"4\"><textarea rows=\"10\" cols=\"35\">".$row['catatan']."</textarea></td>
        </tr>
      </table>
      </div>
      ";
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
      $totalnilaiwwc = "
      <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>
      <div class=\"wrap-dialog dialogwwc".$no."\">
        <table>
          <tr style=\"background:#e6d500 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"41\">".$row['catatansantri']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiwwc >= 70 && $nilaiwwc < 80) {
      $totalnilaiwwc = "
      <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>
      <div class=\"wrap-dialog dialogwwc".$no."\">
        <table>
          <tr style=\"background:#47b147 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"41\">".$row['catatansantri']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiwwc >= 80 && $nilaiwwc < 90) {
      $totalnilaiwwc = "
      <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>
      <div class=\"wrap-dialog dialogwwc".$no."\">
        <table>
          <tr style=\"background:#5a91e2 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"41\">".$row['catatansantri']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiwwc >= 90) {
      $totalnilaiwwc = "
      <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>
      <div class=\"wrap-dialog dialogwwc".$no."\">
        <table>
          <tr style=\"background:#9d71e2 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"41\">".$row['catatansantri']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else {
      $totalnilaiwwc = "
      <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$nilaiwwc."</div>
      <div class=\"wrap-dialog dialogwwc".$no."\">
        <table>
          <tr style=\"background:#f13b3b !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"41\">".$row['catatansantri']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
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
      $totalnilaiquis = "
      <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>
      <div class=\"wrap-dialog dialogquis".$no."\">
        <table>
          <tr style=\"background:#e6d500 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"39\">".$row['catatanortu1']." \n ".$row['catatanortu2']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiquis >= 70 && $nilaiquis < 80) {
      $totalnilaiquis = "
      <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>
      <div class=\"wrap-dialog dialogquis".$no."\">
        <table>
          <tr style=\"background:#47b147 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"39\">".$row['catatanortu1']." \n ".$row['catatanortu2']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiquis >= 80 && $nilaiquis < 90) {
      $totalnilaiquis = "
      <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>
      <div class=\"wrap-dialog dialogquis".$no."\">
        <table>
          <tr style=\"background:#5a91e2 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"39\">".$row['catatanortu1']." \n ".$row['catatanortu2']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else if($nilaiquis >= 90) {
      $totalnilaiquis = "
      <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>
      <div class=\"wrap-dialog dialogquis".$no."\">
        <table>
          <tr style=\"background:#9d71e2 !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"39\">".$row['catatanortu1']." \n ".$row['catatanortu2']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    } else {
      $totalnilaiquis = "
      <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$nilaiquis."</div>
      <div class=\"wrap-dialog dialogquis".$no."\">
        <table>
          <tr style=\"background:#f13b3b !important;color:#fff\">
            <td>Catatan</td>
          </tr>
          <tr>
            <td><textarea rows=\"10\" cols=\"39\">".$row['catatanortu1']." \n ".$row['catatanortu2']."</textarea></td>
          </tr>
        </table>
      </div>
      ";
    }

    $data.="
    <tr>
        <td>".$no."</td>
        <td>
            <div class=\"Checkbox\">
              ".$mundur."
            </div>
        </td>
        <td>".$row['noid']."<br>".ucwords(strtolower($row['nama']))."<br><strong>".$row['asalsekolah']."</strong></td>
        <td>".$average."</td>
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
			<th class=\"no-sort\" width=\"1\">Mundur</th>
			<th>Nama</th>
			<th class=\"center\" width=\"1\">Raport</th>
			<th class=\"center\" width=\"1\">TKD</th>
			<th class=\"center\" width=\"1\">QUR'AN</th>
			<th class=\"center\" width=\"1\">WAWANCARA</th>
			<th class=\"center\" width=\"1\">QUISIONER</th>
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>
<button class=\"button\" onclick=\"lulus()\">Simpan</button>

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

function dialogquran(val) {
  $('.'+val+'').show();
}

function removedialogquran(val) {
  $('.'+val+'').hide();
}

function dialogwwc(val) {
  $('.'+val+'').show();
}

function removedialogwwc(val) {
  $('.'+val+'').hide();
}

function dialogquis(val) {
  $('.'+val+'').show();
}

function removedialogquis(val) {
  $('.'+val+'').hide();
}

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
        $.post('http://api.marifatussalaam.org/admin/lulus.php',
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
