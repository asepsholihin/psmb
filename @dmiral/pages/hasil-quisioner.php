<?php
include "config.php";
$data = "";
$sql = "SELECT a.nopendaftaran,a.nama,a.tmplahir,a.tgllahir,a.asalsekolah,a.hportu,b.petugas FROM calonsiswa a INNER JOIN quis_ortu b ON a.nopendaftaran=b.nopendaftaran WHERE lulus=0 and aktif=1";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
    $date = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);
    $data.="
    <tr>
        <td>".$no."</td>
        <td>".$row['nopendaftaran']."</td>
        <td>".ucwords(strtolower($row['nama']))."</td>
        <td>".$row['asalsekolah']."</td>
        <td>".$row['hportu']."</td>
        <td>".date_format($date,"d-m-Y")."</td>
        <td>".$row['petugas']."</td>
        <td class=\"center\"><a target=\"_blank\" href=\"pages/detail-quisioner.php?nopendaftaran=".$row['nopendaftaran']."&nama=".ucwords(strtolower($row['nama']))."\">Cetak</a></td>
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
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>Asal Sekolah</th>
			<th class=\"no-sort\">Handphone</th>
			<th>Tanggal Daftar</th>
			<th>Petugas</th>			
			<th class=\"center\">Wawancara</th>
		</tr>
	</thead>
	<tbody>
		$data
	</tbody>
</table>

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
    $('.quisioner').addClass('active');
});
</script>
";

mysql_close($koneksi);
?>
