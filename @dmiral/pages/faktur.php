<style>
@font-face {
  font-family: 'aller';
  src: url('../fonts/Aller_Std_Rg.ttf');
}

body {
    font-family: 'aller';
}
.kwitansi {
    width: 336.377952756px;
    height: 755.905511811px;
    font-size: 0.9em;
    color: #555;
    margin: auto 0;
    background: #fff url(../img/invoice.png) no-repeat center;
    background-size: cover;
}
.body-kwitansi {
    text-align: right;
    padding-right: 16px;
    padding-top: 141px;
    text-transform: uppercase;
}
.kwitansi-nama {	
    font-size: 1.5em;
    font-weight: bold;
    letter-spacing: 3px;
}
.kwitansi-nomor {
    padding-top: 26px;
    font-size: 2em;
    letter-spacing: 3px;
}
</style>

<?php 

$nama = explode (' ',$_GET['nama']);
$nama = $nama[0]." ".$nama[1]." ".mb_strimwidth($nama[2],0,2,'.')." ".mb_strimwidth($nama[3],0,2,'.');

?>

<div class="kwitansi">
	<div class="body-kwitansi">
		<div class="kwitansi-nama"><?php echo $nama; ?></div>
		<div class="kwitansi-nomor"><?php echo $_GET['nomor']; ?></div>
	</div>
</div>