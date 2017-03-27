<?php
include "config.php";
$data = "";
$sql = "SELECT nopendaftaran,nama,tmplahir,tgllahir,asalsekolah,hportu,ts,is_konfirmasi,registrasi,info2,info1 FROM calonsiswa WHERE aktif=1";
$query = mysqli_query($koneksi, $sql);
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
    $date_ts = date_create($row['ts']);
    $tgllahir = date_create($row['tgllahir']);
    switch ($row['is_konfirmasi']) {
        case '1':
            $linkkwitansi = "<a target=\"_blank\" href=\"pages/faktur.php?nomor=".$row['nopendaftaran']."&nama=".$row['nama']."\">Kwitansi</a>";
            break;
        case '0':
            $linkkwitansi = '';
            break;
        default:
            # code...
            break;
    }
    if($row['info2'] == ""){
        $tgltes = "
            <div class=\"tanggal \">
            <form id=\"form".$no."\">
                <input type=\"hidden\" name=\"hportu\" value=\"".$row['hportu']."\">
                <input type=\"date\" onclick=\"ubahtanggaldirect('tanggal".$no."')\" class=\"tgltes\" name=\"info2\">
                <button class=\"button-small tanggal".$no." hidden\" type=\"button\" onclick=\"edit('".$no."')\">Simpan</button>
            </form>
            </div>
        ";
    } else {
        //$tgltes = date_format(date_create($row['info2']),"d-m-Y");
        $tgltes = "
            <div class=\"tanggal \">
            <form id=\"form".$no."\">
                <input type=\"hidden\" name=\"hportu\" value=\"".$row['hportu']."\">
                <input type=\"date\" onclick=\"ubahtanggaldirect('tanggal".$no."')\" class=\"tgltes\" name=\"info2\" value=\"".date_format(date_create($row['info2']),"Y-m-d")."\">
                <button class=\"button-small tanggal".$no." hidden\" type=\"button\" onclick=\"edit('".$no."')\">Simpan</button>
            </form>
            </div>
        ";
    }
    $tgl_daftar = date_create($row['ts']);
    $data.="
    <tr>
        <td>".$no."</td>
        <td>".$row['nopendaftaran']."</td>
        <td><a class=\"username\" href=\"pages/detail.php?id=".$row['hportu']."\" target=\"_bank\">".ucwords(strtolower($row['nama']))."</a></td>
        <td>".ucwords(strtolower($row['tmplahir'])).", ".date_format($tgllahir,"d-m-Y")."</td>
        <td>".$row['asalsekolah']."</td>
        <td>".$row['hportu']."</td>
        <td>".date_format($tgl_daftar,"d-m-Y H:i:s")."</td>
        <td>".$tgltes."</td>
        <td>".$row['info1']."</td>
        <td>".$linkkwitansi."</td>
    </tr>
    ";
    $no++;

    $date = date_create($row['tgl_konfirmasi']);
}

$content = "
$kwitansi
<link rel=\"stylesheet\" type=\"text/css\" href=\"//cdn.datatables.net/1.10.12/css/jquery.dataTables.css\">
<table id=\"table_id\" class=\"display\">
	<thead>
		<tr>
            <th class=\"no-sort\" width=\"1\">No</th>
			<th>No Pendaftaran</th>
			<th>Nama</th>
			<th>Lahir</th>
			<th>Asal Sekolah</th>
			<th class=\"no-sort\">Handphone</th>
			<th>Tgl Daftar</th>
			<th>Tgl Tes</th>
			<th>Checked by</th>
			<th class=\"no-sort\">Print</th>
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
    $('.calonsantri').addClass('active');

});
</script>
<script src=\"js/jquery.printElement.min.js\"></script>
<script>

function ubahtanggal(idclass){
    $('.tanggal').addClass( 'hidden' );
    $('.'+idclass+'').removeClass( 'hidden' );
}

function ubahtanggaldirect(idclass) {
    $('.button-small').addClass( 'hidden' );
    $('.'+idclass+'').removeClass( 'hidden' );
}

function edit(idclass){
    $('.loading').show();
    $.post('http://api.marifatussalaam.org/admin/tanggalseleksi.php', $('#form'+idclass+'').serialize(), function(data) {
        var obj = JSON.parse(data);
        if (!obj.error) {
            window.location.href = '?pg=calonsantri';
        } else {
            alert('Ada yang salah!');
        }
    });
}

function printKwitansi(replid){
	$('.wrap-kwitansi').show();
    $('.'+replid).printElement({
        overrideElementCSS:[
        'print.css',
        { href:'css/print.css',media:'print'}],
        leaveOpen:false
    });
    $('.wrap-kwitansi').hide();
}
</script>
";

mysqli_close($koneksi);
?>
