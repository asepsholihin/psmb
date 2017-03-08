<?php
session_start();

include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran as 'id', a.nama, b.* from calonsiswa a LEFT JOIN nilai_tes b ON a.nopendaftaran = b.nopendaftaran WHERE a.is_konfirmasi=1  and a.nopendaftaran!='' and aktif=1";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
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
      $totaltkd = "<div style='background:#e6d500;color:#e6d500'>".$jmltkd."</div>";
    } else if($jmltkd >= 70 && $jmltkd < 80) {
      $totaltkd = "<div style='background:#47b147;color:#47b147'>".$jmltkd."</div>";
    } else if($jmltkd >= 80 && $jmltkd < 90) {
      $totaltkd = "<div style='background:#5a91e2;color:#5a91e2'>".$jmltkd."</div>";
    } else if($jmltkd >= 90 && $jmltkd <= 100) {
      $totaltkd = "<div style='background:#9d71e2;color:#9d71e2'>".$jmltkd."</div>";
    } else {
      $totaltkd = "<div style='background:#f13b3b;color:#f13b3b'>".$jmltkd."</div>";
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

    $jmlquran = $bacaan + $tajwid + $hafalan + $sholat;
    if($jmlquran > 150 && $jmlquran <= 200) {
      $totalquran = "<div style='background:#e6d500;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran > 200 && $jmlquran <= 250) {
      $totalquran = "<div style='background:#47b147;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran > 250 && $jmlquran <= 300) {
      $totalquran = "<div style='background:#5a91e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else if($jmlquran > 300) {
      $totalquran = "<div style='background:#9d71e2;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    } else {
      $totalquran = "<div style='background:#f13b3b;color:#fff;text-align:center;padding:8px;'>".$jmlquran."</div>";
    }

    $data.="
    <tr>
        <form id=\"form".$no."\">
        <input type=\"hidden\" name=\"nopendaftaran\" value=\"".$row['id']."\">
        <input type=\"hidden\" name=\"petugas\" value=\"".$_SESSION['session_name']."\">
        <td>".$no."</td>        
        <td>".$row['id']." </td>
        <td>".ucwords(strtolower($row['nama']))." </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number\" name=\"tkd\" maxlength=\"3\" value=\"".$tkd."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number\" name=\"bacaan\" maxlength=\"3\" value=\"".$bacaan."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number\" name=\"tajwid\" maxlength=\"3\" value=\"".$tajwid."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number\" name=\"hafalan\" maxlength=\"3\" value=\"".$hafalan."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number\" name=\"sholat\" maxlength=\"3\" value=\"".$sholat."\" type=\"text\">
        </td>
        <td class=\"center\">
            ".$totalquran."
        </td>
        <td class=\"center\">
            <textarea class=\"catatan cateditor".$no."\" onclick=\"editor('editor".$no."')\" name=\"catatan\">".$row['catatan']."</textarea>
        </td>
        <td>
            ".$row['petugas']."
        </td>
        <td>
            ".$row['tanggal']."
            <button class=\"editor editor".$no." button-small\" type=\"button\" onclick=\"edit('".$no."')\">Simpan</button>
        </td>
        </form>
    </tr>
    ";
    $no++;
}

$content = "
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
    <thead>
        <tr>
            <th rowspan=\"2\" class=\"no-sort\" width=\"1\">No</th>
            <th rowspan=\"2\" class=\"no-sort\" width=\"1\">No Pendaftaran</th>
            <th rowspan=\"2\">Nama</th>
            <th rowspan=\"2\" class=\"center no-sort\">TKD</th>
            <th colspan=\"5\" class=\"center no-sort\">Tes Qur'an</th>
            <th rowspan=\"2\" class=\"center no-sort\">Catatan</th>
            <th rowspan=\"2\" class=\"center no-sort\">Petugas</th>
            <th rowspan=\"2\" class=\"no-sort\">Tanggal</th>
        </tr>
        <tr>
            <th>Bacaan</th>
            <th>Tajwid</th>
            <th>Hafalan</th>
            <th>Sholat</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        $data
    </tbody>
</table>

<div class=\"loading\">Loading</div>

<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
<script type=\"text/javascript\" charset=\"utf8\" src=\"//cdn.datatables.net/1.10.12/js/jquery.dataTables.js\"></script>
<script>
$(document).ready(function(){
    $('#table_id').DataTable({
        'columnDefs': [
            {
                'targets': 'no-sort',
                'orderable': false
            }
        ],
        'lengthMenu': [[25, 50, 100, -1], [25, 50, 100, 'All']]
    });
    $('.seleksi').addClass('active');
});
function edit(idclass){
    $('.loading').show();
    $.post('http://api.marifatussalaam.org/admin/nilaiseleksi.php', $('#form'+idclass+'').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=seleksi';
        } else {
            alert('Ada yang salah!');
        }
    });
}
function editor(idclass){
    $('.catatan').css('border', 'none');
    $('.editor').hide();
    $('.cat'+idclass+'').css('border', '1px solid #aaa');
    $('.'+idclass+'').fadeIn('fast');
}
</script>
";

mysql_close($koneksi);
?>
