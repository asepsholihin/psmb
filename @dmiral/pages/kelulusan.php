<?php
include "config.php";
$data = "";
$sql = "SELECT nopendaftaran,nama,tmplahir,tgllahir,asalsekolah,hportu,lulus FROM calonsiswa WHERE nopendaftaran!='' and aktif=1";
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
        <td>".$row['nopendaftaran']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".ucwords(strtolower($row['tmplahir']))."</td>
        <td>".date_format($tgllahir,"d-m-Y")."</td>
        <td>".$row['asalsekolah']."</td>
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
			<th class=\"no-sort\" width=\"1\">Cadangan</th>
			<th class=\"no-sort\" width=\"1\">Mundur</th>
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Asal Sekolah</th>
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
    var checkedData = $('input[name=lulus]:checked').map(function() {
        return $(this).data('id');
    }).get();
    var r = confirm('Yakin mereka lulus?');
    if (r == true) {
        $.post('../api/admin/lulus.php',
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
