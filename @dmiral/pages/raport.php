<?php
session_start();

include "config.php";
$data = "";
$sql = "SELECT nopendaftaran, nama, ujian1, ujian2, ujian3, ujian4, ujian5, ujian6, ujian7, ujian8, ujian9, ujian10, ujian11, ujian12 from calonsiswa";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{

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

    $data.="
    <tr>
        <form id=\"form".$no."\">
        <input type=\"hidden\" name=\"nopendaftaran\" value=\"".$row['nopendaftaran']."\">
        <input type=\"hidden\" name=\"petugas\" value=\"".$_SESSION['session_name']."\">
        <td>".$no."</td>
        <td>".$row['nopendaftaran']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"4mtk\" maxlength=\"3\" value=\"".$row['ujian1']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"4ind\" maxlength=\"3\" value=\"".$row['ujian2']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"4ipa\" maxlength=\"3\" value=\"".$row['ujian3']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"4ing\" maxlength=\"3\" value=\"".$row['ujian4']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"5mtk\" maxlength=\"3\" value=\"".$row['ujian5']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"5ind\" maxlength=\"3\" value=\"".$row['ujian6']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"5ipa\" maxlength=\"3\" value=\"".$row['ujian7']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"5ing\" maxlength=\"3\" value=\"".$row['ujian8']."\" type=\"text\">
        </td>

        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"6mtk\" maxlength=\"3\" value=\"".$row['ujian9']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"6ind\" maxlength=\"3\" value=\"".$row['ujian10']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"6ipa\" maxlength=\"3\" value=\"".$row['ujian11']."\" type=\"text\">
        </td>
        <td class=\"center\">
            <input onclick=\"editor('editor".$no."')\" class=\"number editor".$no."\" name=\"6ing\" maxlength=\"3\" value=\"".$row['ujian12']."\" type=\"text\">
        </td>
        <td class=\"center\">
            ".$average."
        </td>
        <td>
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
            <th rowspan=\"2\">No. Pendaftaran</th>
            <th rowspan=\"2\">Nama</th>
            <th colspan=\"4\" class=\"center no-sort\">Kelas 4</th>
            <th colspan=\"4\" class=\"center no-sort\">Kelas 5</th>
            <th colspan=\"4\" class=\"center no-sort\">Kelas 6</th>
            <th rowspan=\"2\" class=\"no-sort\">Avg</th>
            <th rowspan=\"2\" class=\"no-sort\"></th>
        </tr>
        <tr>
            <th class=\"center no-sort\">MTK</th>
            <th class=\"center no-sort\">IND</th>
            <th class=\"center no-sort\">IPA</th>
            <th class=\"center no-sort\">ING</th>
            <th class=\"center no-sort\">MTK</th>
            <th class=\"center no-sort\">IND</th>
            <th class=\"center no-sort\">IPA</th>
            <th class=\"center no-sort\">ING</th>
            <th class=\"center no-sort\">MTK</th>
            <th class=\"center no-sort\">IND</th>
            <th class=\"center no-sort\">IPA</th>
            <th class=\"center no-sort\">ING</th>
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
    $('.raport').addClass('active');
});
function edit(idclass){
    $('.loading').show();
    $.post('http://localhost/psmb/api/admin/nilairaport.php', $('#form'+idclass+'').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=raport';
        } else {
            alert('Ada yang salah!');
        }
    });
}
function editor(idclass){
    $('.number').css('border', 'none');
    $('.editor').hide();
    $('.'+idclass+'').css('border', '1px solid #aaa');
    $('.'+idclass+'').fadeIn('fast');
    console.log('.'+idclass+'');
}
</script>
";

mysql_close($koneksi);
?>
