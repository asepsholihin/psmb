<?php
session_start();

include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran as 'id', a.nama, b.* from calonsiswa a LEFT JOIN nilai_tes b ON a.nopendaftaran = b.nopendaftaran WHERE a.nopendaftaran!=''";
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

    $data.="
    <tr>
        <form id=\"form".$no."\">
        <input type=\"hidden\" name=\"nopendaftaran\" value=\"".$row['id']."\">
        <input type=\"hidden\" name=\"petugas\" value=\"".$_SESSION['session_name']."\">
        <td>".$no."</td>
        <td>".ucwords(strtolower($row['nama']))."</td> 
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
            <th class=\"no-sort\" width=\"1\">No</th>
            <th>Nama</th>
            <th class=\"center no-sort\">TKD</th>
            <th class=\"center no-sort\">Bacaan</th>
            <th class=\"center no-sort\">Tajwid</th>
            <th class=\"center no-sort\">Hafalan</th>
            <th class=\"center no-sort\">Sholat</th>
            <th class=\"center no-sort\">Catatan</th>
            <th class=\"center no-sort\">Petugas</th>
            <th class=\"no-sort\">Tanggal</th>
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
    $.post('../api/admin/nilaiseleksi.php', $('#form'+idclass+'').serialize(), function(data) {
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
