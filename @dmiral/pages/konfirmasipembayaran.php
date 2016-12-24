<?php
session_start();

include "config.php";
$data = "";
$sql = "SELECT nama,tmplahir,tgllahir,asalsekolah,hportu,konfirmasi_biaya,bukti_transfer FROM calonsiswa WHERE is_konfirmasi=0 AND aktif=1";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    switch ($row['konfirmasi_biaya']) {
        case '1':
            $buktitransfer = '<img src="'.$row['bukti_transfer'].'" height="20">';
            break;
        case '0':
            $buktitransfer = '';
            break;
        default:
            # code...
            break;
    }
    $data.="
    <tr>
        <td>".$no."</td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\" onclick=\"konfirmasi('".$row['hportu']."', '".$_SESSION["session_name"]."', 'tunai')\" name=\"tunai\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\" onclick=\"konfirmasi('".$row['hportu']."', '".$_SESSION["session_name"]."', 'transfer')\" name=\"transfer\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>
            <div class=\"Checkbox\">
                <input type=\"checkbox\" onclick=\"konfirmasi('".$row['hportu']."', '".$_SESSION["session_name"]."', 'free')\" name=\"free\" /><div class=\"Checkbox-visible\"></div>
            </div>
        </td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".ucwords(strtolower($row['tmplahir']))."</td>
        <td>".$row['tgllahir']."</td>
        <td>".$row['asalsekolah']."</td>
        <td>".$row['hportu']."</td>
        <td>".$buktitransfer."</td>
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
			<th class=\"no-sort\" width=\"1\">Tunai</th>
			<th class=\"no-sort\" width=\"1\">Transfer</th>
			<th class=\"no-sort\" width=\"1\">Free</th>
			<th>Nama</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Asal Sekolah</th>
			<th class=\"no-sort\">Handphone</th>
			<th class=\"no-sort\">Bukti Transfer</th>
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
                'orderable': false,
            }
        ]
    });
    $('.konfirmasipembayaran').addClass('active');

});
function konfirmasi(id,petugas,type){
    $('.loading').show();
    var r = confirm('Yakin dia udah bayar?');
    if (r == true) {
        $.post('../api/admin/konfirmasi.php',
        {
            id:id,
            petugas:petugas,
            type:type
        },
        function(data,status){
            window.location.href = '?pg=konfirmasipembayaran';
        });
    }
}
</script>
";

mysql_close($koneksi);
?>
