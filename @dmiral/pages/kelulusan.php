<?php
include "config.php";
$data = "";
$sql = "SELECT nopendaftaran,nama,tmplahir,tgllahir,asalsekolah,hportu FROM calonsiswa WHERE lulus=0";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $date = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);
    $data.="
    <tr>
        <td>".$no."</td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\"  name=\"lulus\" value=\"".$row['nopendaftaran']."\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>".$row['nopendaftaran']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".ucwords(strtolower($row['tmplahir']))."</td>
        <td>".date_format($tgllahir,"d-m-Y")."</td>
        <td>".$row['asalsekolah']."</td>
        <td>".$row['hportu']."</td>
        <td>".date_format($date,"d-m-Y")."</td>
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
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Asal Sekolah</th>
			<th class=\"no-sort\">Handphone</th>
			<th>Tanggal Daftar</th>
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
    var r = confirm('Yakin mereka lulus?');
    if (r == true) {
        $.post('http://api.marifatussalaam.org/admin/lulus.php',
        {
            id: checkedValues
        },
        function(data,status){
            window.location.href = '?pg=kelulusan';
        });
    }
}
</script>
";

mysql_close($koneksi);
?>
