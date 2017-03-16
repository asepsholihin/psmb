<style>
body {
    font-family: sans-serif;
}
.wrapper{
    position: absolute;
    width: 548px;
    height: 775px;
    background: url(bg.png) no-repeat;
    background-size: cover;
}
.caption {
    position: absolute;
    top: 40px;
    right: 10px;
}
.invoice {
    letter-spacing: 3px;
    font-size: 2em;
    font-weight: bold;
}
.invoice-for table td {
    font-size: 0.8em !important;
}
.logo img {
    position: absolute;
    top: 50px;
    left: 50px;
    width: 105px;
}
.content {
    position: absolute;
    top: 170px;
    width: 100%;
}
.content table {
    font-size: 0.8em;
    width: 100%;
}
.content table th {
    padding: 8px 10px;
    background: #8784b1;
    color: #fff;
    text-transform: uppercase;
    font-weight: normal;
}
.left {
    text-align: left;
}
.content table td {
    padding: 15px 10px;
    border-bottom: 2px solid #fff;
    background: rgba(243, 243, 243, 0.84);
}
table.total {
    position: absolute;
    right: 0;
    width: 50%;
}
table.total th {
    text-align: center;
    text-transform: none;
    font-weight: bold;
}
table.total td {
    text-align: left;
    padding: 8px 10px;
    background: #8784b1;
    color: #fff;
    font-weight: bold;
    border: none;
}
.footer {
    position: absolute;
    width: 90%;
    right: 30px;
    bottom: 35px;
}
.footer table {
    font-size: 0.8em;
}
</style>

<?php
error_reporting(0);
require_once 'db_connect.php';
$db = new DB_CONNECT();

$sql = "SELECT * FROM log_transaksi WHERE nopendaftaran='".$_GET['nopendaftaran']."' AND tanggal='".$_GET['tanggal']."'";
$query = mysql_query($sql);
$no = 1;
while($row = mysql_fetch_array($query)){
    if($row['jenis'] == 'Iuran Bulanan/SPP') {
        $jenis = "
        ".$row['jenis']."<br>
        <small>".$row['keterangan']."</small>
        ";
    } else if($row['jenis'] == 'Lain-lain') {
        $jenis = "
        ".$row['jenis']."<br>
        <small>".$row['catatan']."</small>
        ";
    } else {
        $jenis = $row['jenis'];
    }
    $data .= "
    <tr>
        <td align=\"center\">".$no."</td>
        <td>".$jenis."</td>
        <td>Rp. ".number_format($row['jumlah'],2,",",".")."</td>
    </tr>
    ";
    $no++;
}
$idsql = "SELECT SUM(a.jumlah) as total, a.nopendaftaran, b.nama, a.tanggal, a.transfer FROM log_transaksi a INNER JOIN calonsiswa b ON a.nopendaftaran=b.nopendaftaran WHERE a.nopendaftaran='".$_GET['nopendaftaran']."' AND a.tanggal='".$_GET['tanggal']."'";
$id = mysql_fetch_array(mysql_query($idsql));
$tanggal = date_format(date_create($id['tanggal']),"d-m-Y");

if($id['transfer'] == 1) {
  $transaksi = "Transfer";
} else {
  $transaksi = "Tunai";
}
?>
<!-- <script>window.print();</script> -->
<div class="wrapper">
    <div class="logo"><img src="logo-ms.png"></div>

    <div class="caption">
        <div class="invoice">INVOICE</div>
        <div class="invoice-for">
            <table>
                <tr>
                    <td>No. Pendaftaran<td>
                    <td>:<td>
                    <td><?php echo $id['nopendaftaran'];?><td>
                </tr>
                <tr>
                    <td>Nama<td>
                    <td>:<td>
                    <td><?php echo $id['nama'];?><td>
                </tr>
                <tr>
                    <td>Tanggal<td>
                    <td>:<td>
                    <td><?php echo $tanggal;?><td>
                </tr>
                <tr>
                    <td>Transaksi<td>
                    <td>:<td>
                    <td><?php echo "PSMB | ".$transaksi;?><td>
                </tr>
            </table>
        </div>
    </div>

    <div class="content">
        <table cellspacing="0">
            <tr>
                <th width="1">No</th>
                <th class="left">Deskripsi Pembayaran</th>
                <th class="left" width="25%">Jumlah</th>
            </tr>
            <?php echo $data;?>
        </table>
        <table class="total" cellspacing="0">
            <tr>
                <th class="center">TOTAL</th>
                <td width="50%">Rp. <?php echo number_format($id['total'],2,",","."); ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <table width="100%">
            <tr>
                <td valign="top"><strong><?php echo $id['nama']; ?></strong><br><small>Yang menyerahkan</small></td>
                <td align="right"><strong>Evi Siti Soviani</strong><br><small>Bendahara</small></td>
            </tr>

        </table>
    </div>
</div>
