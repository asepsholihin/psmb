<?php
error_reporting(0);
$response = array();

$link = mysqli_connect("localhost", "marifatu_dbapsmb", "mtms1zz@t1", "marifatu_psmb");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$nopendaftaran = $_POST['id'];
$data = $_POST['data'];

$arrlength = count($_POST['data']);
for($x = 0; $x < $arrlength; $x++) {
    $sql .= "UPDATE calonsiswa SET lulus='".$data[$x]."' WHERE nopendaftaran='".$nopendaftaran[$x]."';";
}

if (mysqli_multi_query($link, $sql)) {
  $response["error"] = false;
} else {
  $response["error"] = true;
}

echo json_encode($response);

/* close connection */
mysqli_close($link);

// $sqlcek = "SELECT replid,nopendaftaran,nama,emailayah,kelamin FROM calonsiswa WHERE nopendaftaran in (".$id.")";
// $querycek = mysql_query( $sqlcek );
// while($datacek = mysql_fetch_assoc($querycek)){
//     $name=$datacek['nama'];
//     $email=$datacek['emailayah'];
//     $blind_email = "psb.mtms@gmail.com";
//     $subject='Kelulusan PSMB SMP Al-Qur\'an Ma\'rifatussalaam';
//
//     $message="
//     <div>
//           Assalaamu 'alaikum wa Rahmatullaahi wa Barakaatuh.<br><br>
//
//           Alhamdulillahi Rabbil 'Aalamiin. Segala puji dan syukur kita panjatkan ke hadirat Allah SWT atas segala limpahan rahmat, taufiq, barokah dan hidayah-Nya. Shalawat dan salam senantiasa terlimpahkan kepada suri tauladan, panglima para mujahid, Nabi Muhammad SAW, juga kepada keluarga, shahabat dan seluruh pengikutnya yang istiqamah.<br><br>
//
//           Dari hasil ananda mengikuti tes seleksi PSMB Ma'rifatussalaam dan dari nilai yang dicapai memenuhi syarat kelulusan, maka dengan ini diputuskan :<br><br>
//
//           <table>
//             <tr>
//               <td>Nama Calon Santri</td>
//               <td>:</td>
//               <td>".strtoupper($datacek['nama'])."</td>
//             </tr>
//             <tr>
//               <td>No. Pendaftaran</td>
//               <td>:</td>
//               <td>".$datacek['nopendaftaran']."</td>
//             </tr>
//           </table>
//           <br>
//
//           <strong>Dinyatakan : LULUS dan Diterima sebagai santri SMP Al-Qur'an Ma'rifatussalaam - Tahun Pelajaran 2017-2018.</strong><br><br>
//
//           Untuk selanjutnya dapat mendaftar ulang, dengan ketentuan : <br><br>
//           1. Pelaksanaan daftar ulang hingga 31 Maret 2017 <br><br>
//           2. Melunasi investasi pendidikan sebesar : <br>
//           <ul>
//               <li>Ikhwan/Putra : <strong>Rp 16.300.000,- </strong>atau dicicil, tahap 1 minimal 50% =<strong> Rp 8.150.000,-</strong></li>
//               <li>Akhwat/Putri : <strong>Rp 16.400.000,- </strong>atau dicicil, tahap 1 minimal 50% =<strong> Rp 8.200.000,-</strong></li>
//           </ul>
//       </div>
//
//       <div>
//           &nbsp; &nbsp; dengan ditransfer ke rekening atas nama <strong>Yayasan Ma'rifatussalaam</strong> :<br>
//       </div>
//
//       <div>
//           <ul>
//               <li><strong>BRI Syariah</strong> KCP Subang No. Rekening <strong>1015 981 403</strong></li>
//               <li><strong>BSM</strong> KCP Subang No. Rekening <strong>7099 777 669</strong></li>
//           </ul>
//           &nbsp;&nbsp;&nbsp;&nbsp; atau secara tunai, datang langsung ke Kantor Yayasan Ma'rifatussalaam, pada hari kerja : <b>Senin - Sabtu, pukul : 09.00 - 15.00 WIB </b><br>
//       </div>
//       <br>
//
//       <div>
//         3. Konfirmasi pembayaran dapat dilakukan dengan cara (salah satu) :
//         <div style=\"margin-left:23px\">
//           a. Melampirkan bukti transfer via email : <a href=\"mailto:keuangan.mtms@gmail.com\" target=\"_blank\">keuangan.mtms@gmail.com</a>
//         </div>
//         <div style=\"margin-left:23px\">
//           b. Meneruskan (forward) SMS banking atau mengirimkan foto bukti transfer via WhatsApp ke salah satu No. HP keuangan :
//         </div>
//         <ul>
//             <li>Bunda Evi Siti Soviani - <strong>0896 7605 1475</strong></li>
//             <li>SMS Center - <strong>0857 2005 1808</strong></li>
//         </ul>
//         <div style=\"margin-left:23px\">
//           Jangan lupa untuk menuliskan data No. Pendaftaran dan Nama Santri.<br><br>
//         </div>
//
//         4. <strong>Bagi yang lulus, namun hingga batas akhir daftar ulang belum membayar investasi pendidikan, maka dianggap mengundurkan diri.</strong><br><br>
//
//         5. Pelunasan investasi pendidikan paling lambat 10 Juni 2017.<br><br>
//
//         6. Pembayaran <strong>uang bulanan (Rp 1.300.000)</strong> dimulai bulan Juli 2017, paling lambat tanggal 10 setiap bulannya.<br><br>
//
//         7. Berkas persyaratan administrasi dikumpulkan saat masuk asrama : <strong>9 Juli 2017</strong><br><br>
//
//         8. Informasi acara masuk asrama, perlengkapan yang harus dibawa ke asrama dan tugas-tugas untuk masa oriantasi dan i'dad, insya Allah akan diumumkan pada awal Mei 2017.<br><br>
//
//         Demikian kabar ini kami sampaikan, selamat bergabung dalam keluarga besar Ma'rifatussalaam School of Tahfizh.<br><br>
//         Wassalaamu 'alaikum wa Rahmatullaahi wa Barakaatuh.<br><br><br>
//
//         <table align=\"right\">
//           <tr>
//             <td>Ditetapkan di</td>
//             <td>:</td>
//             <td>Subang</td>
//           </tr>
//           <tr>
//             <td>Pada tanggal</td>
//             <td>:</td>
//             <td>15 Maret 2017</td>
//           </tr>
//           <tr>
//             <td colspan=\"3\"><strong>Yayasan Ma'rifatussalaam</strong><br><br><br><br></td>
//           </tr>
//           <tr>
//             <td colspan=\"3\"><strong><u>M. Arief Chabarullah L.B</u> <br> Ketua Harian</strong></td>
//           </tr>
//         </table>
//       </div>
//
//
//     ";
//
//     $to=$email;
//
//     $message=$message;
//
//     $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .="bcc: $blind_email\n";
//     $headers .= "X-Priority: 1 (Highest)\n";
//     $headers .= "X-MSMail-Priority: High\n";
//     $headers .= "Importance: High\n";
//     $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
//
//     // More headers
//     $headers .= 'From: Panitia PSMB Ma\'rifatussalaam <noreply@marifatussalaam.org>'."\r\n";
//     @mail($to,$subject,$message,$headers);
// }

?>
