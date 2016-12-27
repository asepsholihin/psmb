<?php
session_start();

include "config.php";
$data = "";
$sql = "SELECT quis, type, kiri, kanan FROM ref_quis_santri";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_assoc($query))
{
	switch ($row['type']) {
        case '1':
            $type = "
            <div class=\"radio-toolbar\">

            	".$row['kiri']."
   
			    <input type=\"radio\" id=\"radio1".$no."\" name=\"quis".$no."\" value=\"5\">
			    <label for=\"radio1".$no."\">5</label>

			    <input type=\"radio\" id=\"radio2".$no."\" name=\"quis".$no."\" value=\"4\">
			    <label for=\"radio2".$no."\">4</label>

			    <input type=\"radio\" id=\"radio3".$no."\" name=\"quis".$no."\" value=\"3\">
			    <label for=\"radio3".$no."\">3</label> 

			    <input type=\"radio\" id=\"radio4".$no."\" name=\"quis".$no."\" value=\"2\">
			    <label for=\"radio4".$no."\">1</label> 

			    <input type=\"radio\" id=\"radio5".$no."\" name=\"quis".$no."\" value=\"1\">
			    <label for=\"radio5".$no."\">1</label> 

			    ".$row['kanan']."

			</div>
            ";
            break;
        case '0':
            $type = "
            <div class=\"radio-toolbar\">

            	".$row['kiri']."
			
			    <input type=\"radio\" id=\"radio1".$no."\" name=\"quis".$no."\" value=\"1\">
			    <label for=\"radio1".$no."\">1</label>

			    <input type=\"radio\" id=\"radio2".$no."\" name=\"quis".$no."\" value=\"2\">
			    <label for=\"radio2".$no."\">2</label>

			    <input type=\"radio\" id=\"radio3".$no."\" name=\"quis".$no."\" value=\"3\">
			    <label for=\"radio3".$no."\">3</label> 

			    <input type=\"radio\" id=\"radio4".$no."\" name=\"quis".$no."\" value=\"4\">
			    <label for=\"radio4".$no."\">4</label> 

			    <input type=\"radio\" id=\"radio5".$no."\" name=\"quis".$no."\" value=\"5\">
			    <label for=\"radio5".$no."\">5</label> 

				".$row['kanan']."

			</div>
            ";
            break;
        default:
            # code...
            break;
    }

    $data.="
    <tr>
    	<td width=\"1\">".$no."</td>
        <td colspan=\"6\">".stripslashes($row['quis'])."</td>
    </tr>
    <tr>
    	<td></td>
    	<td>".$type."</td>
    </tr>
    ";
    $no++;
}

$content = "

<form id=\"form\">
<div class=\"search\">
<input class=\"input-search\" onkeyup=\"searching(this)\" type=\"text\" placeholder=\"cari nama...\">
<input class=\"nopendaftaran\" type=\"hidden\" name=\"nopendaftaran\">
<input type=\"hidden\" name=\"petugas\" value=\"".$_SESSION['session_name']."\">
<input type=\"hidden\" name=\"evaluasi\" value=\"pendaftaran\">

<ul id=\"searching\">
	
</ul>
</div>

<table>
".$data."
</table>
<textarea class=\"quis\" row=\"5\" name=\"catatan\" placeholder=\"Catatan...\"></textarea>
<button class=\"button-small\" type=\"button\" onclick=\"simpan()\">Simpan</button>
</form>


<div class=\"loading\">Loading</div>

<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>
<script>
$(document).ready(function(){
    $('.wawancara').addClass('active');
});

function searching(e) {
	console.log(e.value);
	$.post('../api/admin/searching.php',
	{
		search : e.value
	},
	function(data) {
		$('#searching').show();		
        $('#searching').html(data);
    });
}

function setsearch(nama,id) {
	$('.input-search').val(nama);
	$('.nopendaftaran').val(id);
	$('#searching').hide();
}

function simpan(){
    $('.loading').show();
    $('.loading').html('Loading');

    if($('.nopendaftaran').val() != '' ) {
    	$.post('../api/admin/wawancara.php', $('#form').serialize(), function(data) {
	        var obj = JSON.parse(data);
	        if (!obj.error) {
	            alert(obj.message);
            	window.location.href = '?pg=quisioner';
	        } else {
	            alert(obj.message);
	        }
	    });
    } else {
    	$('.loading').html('Isi dulu namanya atuh!');
    }
}
</script>
";

mysql_close($koneksi);
?>
