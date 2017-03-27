<?php
session_start();
error_reporting(0);
include "../config.php";
$data = "";


$sqlresult = "SELECT b.nama, a.* FROM quis_ortu a INNER JOIN calonsiswa b ON a.nopendaftaran=b.nopendaftaran WHERE a.nopendaftaran='".$_GET['nopendaftaran']."'";
$queryresult = mysqli_query($koneksi, $sqlresult);
$result = mysqli_fetch_assoc($queryresult);



$sql = "SELECT kode, quis, type FROM ref_quis_ortu";
$query = mysqli_query($koneksi, $sql);
$no = 1;
while($row = mysqli_fetch_assoc($query))
{
	switch ($row['type']) {
        case '1':
            $type = "<textarea class=\"quis\" row=\"5\" name=\"quis".$no."\">".$result[$row['kode']]."</textarea>";
            break;
        case '0':
            if($result[$row['kode']] == "1") {
                $radio1 = "<input type=\"radio\" id=\"radio1".$no."\" name=\"quis".$no."\" value=\"1\" checked>
                <label for=\"radio1".$no."\">1</label>";
            } else {
                $radio1 = "<input type=\"radio\" id=\"radio1".$no."\" name=\"quis".$no."\" value=\"1\">
                <label for=\"radio1".$no."\">1</label>";
            }
            if($result[$row['kode']] == "2") {
                $radio2 = "<input type=\"radio\" id=\"radio2".$no."\" name=\"quis".$no."\" value=\"2\" checked>
                <label for=\"radio2".$no."\">2</label>";
            } else {
                $radio2 = "<input type=\"radio\" id=\"radio2".$no."\" name=\"quis".$no."\" value=\"2\">
                <label for=\"radio2".$no."\">2</label>";
            }
            if($result[$row['kode']] == "3") {
                $radio3 = "<input type=\"radio\" id=\"radio3".$no."\" name=\"quis".$no."\" value=\"3\" checked>
                <label for=\"radio3".$no."\">3</label>";
            } else {
                $radio3 = "<input type=\"radio\" id=\"radio3".$no."\" name=\"quis".$no."\" value=\"3\">
                <label for=\"radio3".$no."\">3</label>";
            }
            if($result[$row['kode']] == "4") {
                $radio4 = "<input type=\"radio\" id=\"radio4".$no."\" name=\"quis".$no."\" value=\"4\" checked>
                <label for=\"radio4".$no."\">4</label>";
            } else {
                $radio4 = "<input type=\"radio\" id=\"radio4".$no."\" name=\"quis".$no."\" value=\"4\">
                <label for=\"radio4".$no."\">4</label>";
            }
            if($result[$row['kode']] == "5") {
                $radio5 = "<input type=\"radio\" id=\"radio5".$no."\" name=\"quis".$no."\" value=\"5\" checked>
                <label for=\"radio5".$no."\">5</label>";
            } else {
                $radio5 = "<input type=\"radio\" id=\"radio5".$no."\" name=\"quis".$no."\" value=\"5\">
                <label for=\"radio5".$no."\">5</label>";
            }
            $type = "
            <div class=\"radio-toolbar\">

            	".$row['kiri']."
                ".$radio1."
                ".$radio2."
                ".$radio3."
                ".$radio4."
                ".$radio5."
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
    	<td valign=\"top\" width=\"1\">".$no.".</td>
        <td colspan=\"6\">".stripslashes($row['quis'])."</td>
    </tr>
    <tr>
    	<td></td>
    	<td>".$type."</td>
    </tr>
    ";
    $no++;
}

mysqli_close($koneksi);
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<style>

body {
	font-family: arial;
	padding: 0px 0;
}

.active {
    background-color: #9d71e2;
    color: #fff !important;
}

.radio-toolbar input[type="radio"] {
    display:none;
}

.radio-toolbar label {
    display:inline-block;
    background-color:#fff;
    border-radius: 64px;
    border: 1px solid #ccc;
    padding: 6px 10px;
    margin: 0 8px;
    font-family:Arial;
    font-size:16px;
    line-height: 16px;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color:#9d71e2;
    color: #fff;
}

.quis {
    width: 100%;
    height: 100px;
    font-family: sans-serif;
}

td {
	padding: 7px;
}

h2 {
	font-weight: 100;
	text-align: center;
}

h2 span {
	font-weight: bold;
}

</style>

<h2>Hasil Quisioner Orangtua <span><?php echo $_GET['nama']?></span></h2>

<table>
<?php echo $data; ?>

</table>

<script>
$(document).ready(function(){
    $('.wawancara').addClass('active');
    //window.print();
});
</script>
