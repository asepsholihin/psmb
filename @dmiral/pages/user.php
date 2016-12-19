<?php
include "config.php";
$data = "";
$sql = "SELECT nama,username,role_pendaftaran,role_kelulusan,role_user FROM users";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    switch ($row['role_pendaftaran']) {
        case '1':
            $pendaftaran = 'checked';
            break;
        case '0':
            $pendaftaran = '';
            break;
        default:
            # code...
            break;
    }
    switch ($row['role_kelulusan']) {
        case '1':
            $kelulusan = 'checked';
            break;
        case '0':
            $kelulusan = '';
            break;
        default:
            # code...
            break;
    }
    switch ($row['role_user']) {
        case '1':
            $user = 'checked';
            break;
        case '0':
            $user = '';
            break;
        default:
            # code...
            break;
    }

    $data.="
    <tr>
        <td>".$no."</td>
        <td>".$row['nama']."</td>
        <td>".$row['username']."</td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"pendaftaran\" ".$pendaftaran." value=\"1\" disabled/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"kelulusan\" ".$kelulusan." value=\"1\" disabled/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"user\" ".$user." value=\"1\" disabled/><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td class=\"center\"><a onclick=\"editor('editor".$no."')\" href=\"#\"><img class=\"ic_action\" src=\"css/edit.png\"></a>  <a href=\"\"><img class=\"ic_action\" src=\"css/reset.png\"></a>  <a href=\"\"><img class=\"ic_action\" src=\"css/hapus.png\"></a></td>
    </tr>
    <tr class=\"editor editor".$no."\">
        <form id=\"form".$no."\">
        <input type=\"hidden\" name=\"type\" value=\"edit\">
        <td>".$no."</td>
        <td><input class=\"form-config\" type=\"text\" name=\"nama\" value=\"".$row['nama']."\"></td>
        <td><input class=\"form-config\" type=\"text\" name=\"username\" value=\"".$row['username']."\"></td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"pendaftaran\" ".$pendaftaran." value=\"1\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"kelulusan\" ".$kelulusan." value=\"1\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"user\" ".$user." value=\"1\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td class=\"center\"><button class=\"button-small\" type=\"button\" onclick=\"edit('".$no."')\">Simpan</button></td>
        </form>
    </tr>
    ";
    $no++;
}
$form = "
<tr class=\"editor tambah\">
    <form id=\"form-tambah\">
    <input type=\"hidden\" name=\"type\" value=\"tambah\">
    <td></td>
    <td><input class=\"form-config\" type=\"text\" name=\"nama\" placeholder=\"Nama Lengkap\"></td>
    <td><input class=\"form-config\" type=\"text\" name=\"username\" placeholder=\"Username\"><input class=\"form-config\" type=\"password\" name=\"password\"  placeholder=\"Password\"></td>
    <td>
        <div class=\"Checkbox\">
            <input type=\"checkbox\"  name=\"pendaftaran\" value=\"1\" /><div class=\"Checkbox-visible\"></div>
        </div>
    </td>
    <td>
        <div class=\"Checkbox\">
            <input type=\"checkbox\"  name=\"kelulusan\" value=\"1\" /><div class=\"Checkbox-visible\"></div>
        </div>
    </td>
    <td>
        <div class=\"Checkbox\">
            <input type=\"checkbox\"  name=\"user\" value=\"1\" /><div class=\"Checkbox-visible\"></div>
        </div>
    </td>
    <td class=\"center\"><a class=\"button-small\" onclick=\"tambah()\">Simpan</a></td>
    </form>
</tr>";

$content = "
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
	<thead>
		<tr>
            <th class=\"no-sort\" width=\"1\">No</th>
			<th>Nama</th>
			<th>Username</th>
			<th class=\"no-sort\">Pendaftaran</th>
			<th class=\"no-sort\">Kelulusan</th>
			<th class=\"no-sort\">User</th>
			<th class=\"no-sort center\" width=\"80\"><a href=\"#\" onclick=\"tambahin()\"><img src=\"css/user.png\"></a></th>
		</tr>
	</thead>
	<tbody>
        $form
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
    $('.user').addClass('active');
});
function edit(idclass){
    $('.loading').show();
    $.post('http://api.marifatussalaam.org/admin/user.php', $('#form'+idclass+'').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=user';
        } else {
            alert('Ada yang salah!');
        }
    });
}
function editor(idclass){
    $('.editor').hide();
    $('.'+idclass+'').show( 'slow' );
}
function tambah(){
    $('.loading').show();
    $.post('http://api.marifatussalaam.org/admin/user.php', $('#form-tambah').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=user';
            //console.log('data');
        } else {
            alert('Ada yang salah!');
        }
    });
}
function tambahin(){
    $('.editor').hide();
    $('.tambah').show( 'slow' );
}
</script>
";

mysql_close($koneksi);
?>
