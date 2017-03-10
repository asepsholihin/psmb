<?php
error_reporting(0);

if($_GET['lulus'] == 'l'){
  $filename = "cadangan-ikhwan";
} else {
  $filename = "cadangan-akhwat";
}


header("Content-type: application/ms-excel");
header("Content-Disposition: attachment; filename=".$filename.".xls");
header("Pragma: no-cache");
header("Expires: 0");

include "../config.php";

$data = "";

$sql = "
SELECT a.nopendaftaran AS noid,a.nama,a.asalsekolah,a.lulus, b.tkd, b.bacaan, b.tajwid, b.hafalan, b.sholat, b.catatan, c.*, d.*, a.ujian1, a.ujian2, a.ujian3, a.ujian4, a.ujian5, a.ujian6, a.ujian7, a.ujian8, a.ujian9, a.ujian10, a.ujian11, a.ujian12, c.catatan as catatansantri, d.q019 as catatanortu1, d.q020 as catatanortu2
FROM calonsiswa a
LEFT JOIN nilai_tes b ON a.nopendaftaran=b.nopendaftaran
LEFT JOIN quis_santri c ON a.nopendaftaran=c.nopendaftaran
LEFT JOIN quis_ortu d ON a.nopendaftaran=d.nopendaftaran
WHERE is_konfirmasi=1 AND aktif=1 AND kelamin='".$_GET['lulus']."' AND lulus=2 ORDER BY a.nopendaftaran ASC
";
$query = mysql_query($sql);

$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $date = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);

    if($row['lulus'] == '1') {
      $lulus = "Lulus";
    } else {
      $lulus = "Cadangan";
    }

    // $sum = $row['ujian1'] + $row['ujian2'] + $row['ujian3'] + $row['ujian4'] + $row['ujian5'] + $row['ujian6'] + $row['ujian7'] + $row['ujian8'] + $row['ujian9'] + $row['ujian10'] + $row['ujian11'] + $row['ujian12'];
    // $avg = number_format($sum / 12, 0,",",".");
    //
    // if($avg >= 60 && $avg < 70) {
    //   $average = "<div style='padding:8px;'>".$avg."</div>";
    // } else if($avg >= 70 && $avg < 80) {
    //   $average = "<div style='padding:8px;'>".$avg."</div>";
    // } else if($avg >= 80 && $avg < 90) {
    //   $average = "<div style='padding:8px;'>".$avg."</div>";
    // } else if($avg >= 90 && $avg <= 100) {
    //   $average = "<div style='padding:8px;'>".$avg."</div>";
    // } else {
    //   $average = "<div style='padding:8px;'>".$avg."</div>";
    // }
    //
    // switch ($row['tkd']) {
    //     case '':
    //         $tkd = '0';
    //         break;
    //     default:
    //         $tkd = $row['tkd'];
    //         break;
    // }
    //
    // $jmltkd = $tkd;
    // if($jmltkd >= 60 && $jmltkd < 70) {
    //   $totaltkd = "<div style='padding:8px;'>".$jmltkd."</div>";
    // } else if($jmltkd >= 70 && $jmltkd < 80) {
    //   $totaltkd = "<div style='padding:8px;'>".$jmltkd."</div>";
    // } else if($jmltkd >= 80 && $jmltkd < 90) {
    //   $totaltkd = "<div style='padding:8px;'>".$jmltkd."</div>";
    // } else if($jmltkd >= 90) {
    //   $totaltkd = "<div style='padding:8px;'>".$jmltkd."</div>";
    // } else {
    //   $totaltkd = "<div style='padding:8px;'>".$jmltkd."</div>";
    // }
    //
    // $raporttkd = $avg + $jmltkd;
    // $totalraporttkd    = number_format($raporttkd / 2, 0,",",".");
    //
    // if($totalraporttkd >= 60 && $totalraporttkd < 70) {
    //   $avgtkd = "<div style='padding:8px;'>".$totalraporttkd."</div>";
    // } else if($totalraporttkd >= 70 && $totalraporttkd < 80) {
    //   $avgtkd = "<div style='padding:8px;'>".$totalraporttkd."</div>";
    // } else if($totalraporttkd >= 80 && $totalraporttkd < 90) {
    //   $avgtkd = "<div style='padding:8px;'>".$totalraporttkd."</div>";
    // } else if($totalraporttkd >= 90 && $totalraporttkd <= 100) {
    //   $avgtkd = "<div style='padding:8px;'>".$totalraporttkd."</div>";
    // } else {
    //   $avgtkd = "<div style='padding:8px;'>".$totalraporttkd."</div>";
    // }
    //
    // switch ($row['bacaan']) {
    //     case '':
    //         $bacaan = '0';
    //         break;
    //     default:
    //         $bacaan = $row['bacaan'];
    //         break;
    // }
    // switch ($row['tajwid']) {
    //     case '':
    //         $tajwid = '0';
    //         break;
    //     default:
    //         $tajwid = $row['tajwid'];
    //         break;
    // }
    // switch ($row['hafalan']) {
    //     case '':
    //         $hafalan = '0';
    //         break;
    //     default:
    //         $hafalan = $row['hafalan'];
    //         break;
    // }
    // switch ($row['sholat']) {
    //     case '':
    //         $sholat = '0';
    //         break;
    //     default:
    //         $sholat = $row['sholat'];
    //         break;
    // }
    //
    // $jmlquran = $bacaan + $hafalan;
    // if($jmlquran > 10 && $jmlquran <= 100) {
    //   $totalquran = "
    //   <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='padding:8px;'>".$jmlquran."</div>
    //   ";
    // } else if($jmlquran > 100 && $jmlquran <= 130) {
    //   $totalquran = "
    //   <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='padding:8px;'>".$jmlquran."</div>
    //   ";
    // } else if($jmlquran > 130 && $jmlquran <= 160) {
    //   $totalquran = "
    //   <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='padding:8px;'>".$jmlquran."</div>
    //   ";
    // } else if($jmlquran > 160) {
    //   $totalquran = "
    //   <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='padding:8px;'>".$jmlquran."</div>
    //   ";
    // } else {
    //   $totalquran = "
    //   <div onmouseover=\"dialogquran('dialogquran".$no."')\" onmouseout=\"removedialogquran('dialogquran".$no."')\" style='padding:8px;'>".$jmlquran."</div>
    //   ";
    // }
    //
    // $querynilaiwwc = "SELECT catatan, (q001 + q002 + q003 + q004 + q005 + q006 + q007 + q008 + q009 + q010 + q011 + q012 + q013 + q014 + q015 + q016 + q017 + q018 + q019 + q020 + q021) as jml FROM quis_santri WHERE nopendaftaran='".$row['noid']."'";
    // $resultwwc = mysql_fetch_assoc(mysql_query($querynilaiwwc));
    // switch ($resultwwc['jml']) {
    //     case '':
    //         $nilaiwwc = '0';
    //         break;
    //     default:
    //         $nilaiwwc = $resultwwc['jml'];
    //         break;
    // }
    // if($nilaiwwc >= 60 && $nilaiwwc < 70) {
    //   $totalnilaiwwc = "
    //   <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='padding:8px;'>".$nilaiwwc."</div>
    //   ";
    // } else if($nilaiwwc >= 70 && $nilaiwwc < 80) {
    //   $totalnilaiwwc = "
    //   <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='padding:8px;'>".$nilaiwwc."</div>
    //   ";
    // } else if($nilaiwwc >= 80 && $nilaiwwc < 90) {
    //   $totalnilaiwwc = "
    //   <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='padding:8px;'>".$nilaiwwc."</div>
    //   ";
    // } else if($nilaiwwc >= 90) {
    //   $totalnilaiwwc = "
    //   <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='padding:8px;'>".$nilaiwwc."</div>
    //   ";
    // } else {
    //   $totalnilaiwwc = "
    //   <div onmouseover=\"dialogwwc('dialogwwc".$no."')\" onmouseout=\"removedialogwwc('dialogwwc".$no."')\"  style='padding:8px;'>".$nilaiwwc."</div>
    //   ";
    // }
    //
    // $querynilai = "SELECT q019, q020, (q001 + q002 + q003 + q004 + q005 + q006 + q007 + q008 + q009 + q010 + q011 + q012 + q013 + q014 + q015 + q016 + q017 + q018) AS jml FROM quis_ortu WHERE nopendaftaran='".$row['noid']."'";
    // $result = mysql_fetch_assoc(mysql_query($querynilai));
    // switch ($result['jml']) {
    //     case '':
    //         $nilaiquis = '0';
    //         break;
    //     default:
    //         $nilaiquis = $result['jml'];
    //         break;
    // }
    // if($nilaiquis >= 60 && $nilaiquis < 70) {
    //   $totalnilaiquis = "
    //   <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='padding:8px;'>".$nilaiquis."</div>
    //   ";
    // } else if($nilaiquis >= 70 && $nilaiquis < 80) {
    //   $totalnilaiquis = "
    //   <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='padding:8px;'>".$nilaiquis."</div>
    //   ";
    // } else if($nilaiquis >= 80 && $nilaiquis < 90) {
    //   $totalnilaiquis = "
    //   <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='padding:8px;'>".$nilaiquis."</div>
    //   ";
    // } else if($nilaiquis >= 90) {
    //   $totalnilaiquis = "
    //   <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='padding:8px;'>".$nilaiquis."</div>
    //   ";
    // } else {
    //   $totalnilaiquis = "
    //   <div onmouseover=\"dialogquis('dialogquis".$no."')\" onmouseout=\"removedialogquis('dialogquis".$no."')\" style='padding:8px;'>".$nilaiquis."</div>
    //   ";
    // }
    //
    // $wwcquis      = $nilaiquis + $nilaiwwc;
    // $totalwwcquis = number_format($wwcquis / 2, 0,",",".");
    //
    // if($totalwwcquis >= 60 && $totalwwcquis < 70) {
    //   $avgwwcquis = "<div style='padding:8px;'>".$totalwwcquis."</div>";
    // } else if($totalwwcquis >= 70 && $totalwwcquis < 80) {
    //   $avgwwcquis = "<div style='padding:8px;'>".$totalwwcquis."</div>";
    // } else if($totalwwcquis >= 80 && $totalwwcquis < 90) {
    //   $avgwwcquis = "<div style='padding:8px;'>".$totalwwcquis."</div>";
    // } else if($totalwwcquis >= 90 && $totalwwcquis <= 100) {
    //   $avgwwcquis = "<div style='padding:8px;'>".$totalwwcquis."</div>";
    // } else {
    //   $avgwwcquis = "<div style='padding:8px;'>".$totalwwcquis."</div>";
    // }
    //
    // $score = ($totalwwcquis*35/100) + ($jmlquran*40/100) + ($totalraporttkd*25/100);
    //
    // if($score <= 75) {
    //   $totalscore = "<div style='padding:8px;'>".$score."</div>";
    // } else if($score > 75 && $score <= 93) {
    //   $totalscore = "<div style='padding:8px;'>".$score."</div>";
    // } else if($score > 93 && $score <= 111) {
    //   $totalscore = "<div style='padding:8px;'>".$score."</div>";
    // } else if($score > 111) {
    //   $totalscore = "<div style='padding:8px;'>".$score."</div>";
    // }

    $data.="
    <tr>
        <td>".$no."</td>
        <td>".$lulus."</td>
        <td>".$row['noid']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".$row['asalsekolah']."</td>
        <!--<td>".$average."</td>
        <td>".$totaltkd."</td>
        <td>".$avgtkd."</td>
        <td>".$totalquran."</td>
        <td>".$totalnilaiwwc."</td>
        <td>".$totalnilaiquis."</td>
        <td>".$avgwwcquis."</td>
        <td>".$totalscore."</td>-->
    </tr>
    ";
    $no++;
}

$content = "

<table border width=\"100%\">
	<thead>
		<tr>
      <th>No</th>
			<th>Status</th>
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>Asal Sekolah</th>
      <!--<th>RAPORT</th>
			<th>TKD</th>
			<th>AVG TKD</th>
			<th>QUR'AN</th>
			<th>WAWANCARA</th>
			<th>QUISIONER</th>
			<th>AVG WAWANCARA</th>
			<th>SCORE</th>-->
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>
";

echo $content;

mysql_close($koneksi);
?>
