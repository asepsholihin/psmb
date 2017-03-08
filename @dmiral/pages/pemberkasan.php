<?php
include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran as 'id', a.nama, b.* from calonsiswa a LEFT JOIN berkas b ON a.nopendaftaran = b.nopendaftaran WHERE a.nopendaftaran!='' AND aktif=1";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    switch ($row['nisn']) {
        case '1':
            $nisn = 'checked';
            break;
        case '0':
            $nisn = '';
            break;
        default:
            $nisn = '';
            break;
    }
    switch ($row['akta_kelahiran']) {
        case '1':
            $akta = 'checked';
            break;
        case '0':
            $akta = '';
            break;
        default:
            $akta = '';
            break;
    }
    switch ($row['ktp']) {
        case '1':
            $ktp = 'checked';
            break;
        case '0':
            $ktp = '';
            break;
        default:
            $ktp = '';
            break;
    }
    switch ($row['kartu_keluarga']) {
        case '1':
            $kk = 'checked';
            break;
        case '0':
            $kk = '';
            break;
        default:
            $kk = '';
            break;
    }
    switch ($row['sertifikat']) {
        case '1':
            $sertifikat = 'checked';
            break;
        case '0':
            $sertifikat = '';
            break;
        default:
            $sertifikat = '';
            break;
    }
    switch ($row['raport']) {
        case '1':
            $raport = 'checked';
            break;
        case '0':
            $raport = '';
            break;
        default:
            $raport = '';
            break;
    }
    switch ($row['foto']) {
        case '1':
            $foto = 'checked';
            break;
        case '0':
            $foto = '';
            break;
        default:
            $foto = '';
            break;
    }

    $data.="
    <tr>
        <form id=\"form".$no."\">
        <input type=\"hidden\" name=\"nopendaftaran\" value=\"".$row['id']."\">
        <td>".$no."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"nisn\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$nisn." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"akta_kelahiran\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$akta." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"ktp\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$ktp." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"kartu_keluarga\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$kk." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"sertifikat\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$sertifikat." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input name=\"raport\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$raport." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td> 
            <div class=\"Checkbox\">
                <input name=\"foto\" onclick=\"editor('editor".$no."')\" type=\"checkbox\" ".$foto." value=\"1\"/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <textarea class=\"catatan cateditor".$no."\" onclick=\"editor('editor".$no."')\" name=\"catatan\">".$row['catatan']."</textarea>
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
            <th class=\"center no-sort\">NISN</th>
            <th class=\"center no-sort\">Akta</th>
            <th class=\"center no-sort\">KTP</th>
            <th class=\"center no-sort\">KK</th>
            <th class=\"center no-sort\">Sertifikat</th>
            <th class=\"center no-sort\">Raport</th>
            <th class=\"center no-sort\">Foto</th>
            <th class=\"no-sort\">Catatan</th>
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
    $('.pemberkasan').addClass('active');
});
function edit(idclass){
    $('.loading').show();
    $.post('http://api.marifatussalaam.org/admin/berkas.php', $('#form'+idclass+'').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=pemberkasan';
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
