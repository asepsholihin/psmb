<?php

include '@dmiral/config.php';

$no_l = 1;
$no_p = 1;
$data_l = "";
$data_p = "";

$sql_l = "SELECT nopendaftaran,nama,tmplahir,tgllahir,asalsekolah FROM calonsiswa WHERE aktif=1 AND lulus=1 AND kelamin='l'";
$query_l = mysql_query($sql_l);

while($row_l = mysql_fetch_assoc($query_l)) {
  $data_l .= "
  <tr>
    <td>".$no_l."</td>
    <td>".$row_l['nopendaftaran']."</td>
    <td>".$row_l['nama']."</td>
    <td>".$row_l['asalsekolah']."</td>
  </tr>
  ";
  $no_l++;
}

$sql_p = "SELECT nopendaftaran,nama,tmplahir,tgllahir,asalsekolah FROM calonsiswa WHERE aktif=1 AND lulus=1 AND kelamin='p'";
$query_p = mysql_query($sql_p);
while($row_p = mysql_fetch_assoc($query_p)) {
  $data_p .= "
  <tr>
    <td>".$no_p."</td>
    <td>".$row_p['nopendaftaran']."</td>
    <td>".$row_p['nama']."</td>
    <td>".$row_p['asalsekolah']."</td>
  </tr>
  ";
  $no_p++;
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <meta name="description" content="Pendaftaran Online SMP Al-Qur'an Ma'rifatussalaam">
        <meta name="author" content="Asep Sholihin">
        <meta name="keywords" content="ma'rifatussalaam, Pendaftaran Online, boarding school, smp al-qur'an, smp, ma-had, tahfizh, pesantren">
        <link rel="icon" href="img/nav-logo.png">
        <title ng-bind="title">PSMB SMP Al-Qur'an Ma'rifatussalaam 2017/2018</title>
        <!-- CSS  -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.daftaronline.min.css">
        <style media="screen">
          table.lulus th {
            background: #333;
            padding: 10px;
            color: #fff;
          }
          table.lulus td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
          }
        </style>
    </head>
    <body>
        <div id="top" class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="img/ic_logo.png" alt="Logo PSMB" width="90">
                    <h3><strong>KELULUSAN</strong> PSMB Marifatussalaam</h3>
                </div>
            </div>
            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">I</a>
                        <p>Ikhwan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle">A</a>
                        <p>Akhwat</p>
                    </div>
                </div>
            </div>
            <br>
            <h3 style="text-align:center;">Daftar Peserta LULUS Tes Seleksi PSMB SMP Al-Qur'an Ma'rifatussalaam Tahun Pelajaran 2017-2018
            <sub><strong>(Berdasarkan SK Yayasan Ma'rifatussalaam Nomor: 0102.4/SK/YMS/III/2017 tentang Hasil Seleksi PSMB SMP Al-Qur'an Ma'rifatussalaam Tahun Pelajaran 2017-2018)</strong></sub></h3>
            <p>Assalaamu'alaikum wa Rahmatullaahi wa Barakaatuh.</p>
            <p>Alhamdulillahi Rabbil ‘Aalamiin. Segala puji dan syukur kita panjatkan ke hadirat Allah SWT atas segala limpahan rahmat, taufiq, barokah dan hidayah-Nya. Shalawat dan salam senantiasa terlimpahkan kepada suri tauladan, panglima para mujahid; Nabi Muhammad SAW, juga kepada keluarga, shahabat dan seluruh pengikutnya yang istiqamah hingga Hari Akhir.</p>
            <p>Jazakumullaahu khairan katsiiraan, bagi semua Ananda yang telah mengikuti tes seleksi PSMB SMP Al-Qur'an Ma'rifatussalaam untuk tahun pelajaran 2017-2018. Perjuangan ananda dalam tes seleksi ini, Masya Allah, luar biasa dan semoga Allah SWT mencatatnya sebagai amal sholeh.</p>
            <p>Ayah, Bunda, Abi, Ummi dan Ananda yang dicintai Allah, Alhamdulillah, hasil tes seleksi kami umumkan hari ini.</p>
            <p>Dengan mempertimbangkan hasil tes seleksi yang dicapai oleh Ananda dan ketersediaan asrama untuk tahun pelajaran 2017-2018, maka berikut ini adalah daftar nama Ananda yang LULUS tes seleksi PSMB SMP Al-Qur'an Ma'rifatussalaam. Barokallah.</p>

            <br>
            <form id="form">
            	<input type="hidden" name="registrasi" value="website"/>
                <div class="row setup-content" id="step-1">
                    <div class="col-xs-12">

                        <table class="lulus" width="100%">
                          <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                          </tr>
                          <?php echo $data_l; ?>
                        </table>
                    </div>

                    <div class="col-xs-12">
                        <br><br>
                        <p>Kami umumkan juga daftar CADANGAN, dimana ketentuannya :</p>
                        <p>1. Cadangan akan dipanggil melalui telepon/sms/whatsapp berdasarkan urutan, jika ada peserta LULUS yang mengundurkan diri.</p>
                        <p>2. Cadangan yang dipanggil wajib melakukan daftar ulang sesuai ketentuan.</p>
                        <h3 style="text-align:center;">Cadangan</h3>

                        <table class="lulus" width="100%">
                          <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td>201730039</td>
                            <td>Syahid Izzuddin Rahman</td>
                            <td>SDI Al-Aziz</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>201730169</td>
                            <td>Ahmad Deedad Al Razi</td>
                            <td>SDIT Permata Hati</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>201730039</td>
                            <td>Rahman Diaz Ramadhani</td>
                            <td>SDIT Cordova</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>201730078</td>
                            <td>Muhammad Azzam Fathurrahman</td>
                            <td>SDIT Insan Aulia</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>201730050</td>
                            <td>Faqih Azhar Ghifari</td>
                            <td>SDIT Lampu Iman Karawang</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>201730004</td>
                            <td>Naufal Raid Hakim</td>
                            <td>SDIT Lampu Iman</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>201730163</td>
                            <td>Rijalul Kahfi Robbani</td>
                            <td>SD PUI Haurgeulis</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>201730013</td>
                            <td>Nur Wahid Fikran Kamil</td>
                            <td>SDIT Al-Manar Pondok Kelapa Jaktim</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>201730093</td>
                            <td>Arsyad Taufiqurrahman</td>
                            <td>SDIT Harapan Ummah</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>201730146</td>
                            <td>Muhammad Fauzan Azmi Syaputra</td>
                            <td>SDIT Al-Muhajirin</td>
                          </tr>
                          <tr>
                            <td>11</td>
                            <td>201730114</td>
                            <td>Muhammad Ridlo Al-Mudhaffar</td>
                            <td>SDIT Global Insani Islamic School</td>
                          </tr>
                        </table>
                    </div>
                </div>

                <div class="row setup-content" id="step-2">
                    <div class="col-xs-12">
                        <table class="lulus" width="100%">
                          <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                          </tr>
                          <?php echo $data_p; ?>
                        </table>
                    </div>

                    <div class="col-xs-12">
                        <br><br>
                        <p>Kami umumkan juga daftar CADANGAN, dimana ketentuannya :</p>
                        <p>1. Cadangan akan dipanggil melalui telepon/sms/whatsapp berdasarkan urutan, jika ada peserta LULUS yang mengundurkan diri.</p>
                        <p>2. Cadangan yang dipanggil wajib melakukan daftar ulang sesuai ketentuan.</p>
                        <h3 style="text-align:center;">Cadangan</h3>

                        <table class="lulus" width="100%">
                          <tr>
                            <th>No</th>
                            <th>No Pendaftaran</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td>201731132</td>
                            <td>Meuthia Puspita Azzahra</td>
                            <td>MI Al-Falah Cakung Jaktim</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>201731162</td>
                            <td>Raden Ayu Dinda Hilwasyahidah</td>
                            <td>MI Ruhul Ulum</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>201730055</td>
                            <td>Shakila Kalya Kurniawan</td>
                            <td>SDIT Al-Bina Purwakarta</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>201731194</td>
                            <td>Naura Zahrani Fatin</td>
                            <td>SD Islam Al Husna</td>
                          </tr>
                          <tr>
                            <td>5</td>
                            <td>201731152</td>
                            <td>Rulla Nurmala Maharani Wangsaatmaja</td>
                            <td>SD Alhikmah Indonesia</td>
                          </tr>
                          <tr>
                            <td>6</td>
                            <td>201731164</td>
                            <td>Denis Fatimah Maqdis</td>
                            <td>SDN Rosela indah</td>
                          </tr>
                          <tr>
                            <td>7</td>
                            <td>201730071</td>
                            <td>Gisheila Hana Lysa</td>
                            <td>SDN Cipinang Muara 05 Pagi</td>
                          </tr>
                          <tr>
                            <td>8</td>
                            <td>201731046</td>
                            <td>Nazmi Nurfaizah Mumtaz</td>
                            <td>SDIT Alamy</td>
                          </tr>
                          <tr>
                            <td>9</td>
                            <td>201731069</td>
                            <td>Syifa Nurul Fajri</td>
                            <td>SDN Kahuripan</td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>201730122</td>
                            <td>Adzkiya Nasywa Putri</td>
                            <td>SDIT Miftahul Ulum</td>
                          </tr>
                          <tr>
                            <td>11</td>
                            <td>201731138</td>
                            <td>Nailah Ishmah Azzahra</td>
                            <td>SDIT DAQTA</td>
                          </tr>
                          <tr>
                            <td>12</td>
                            <td>201731136</td>
                            <td>Zilfa Khoirunnisa</td>
                            <td>SDN Sejahtera 4</td>
                          </tr>
                          <tr>
                            <td>13</td>
                            <td>201731144</td>
                            <td>Putri Nabila Dheviyanti</td>
                            <td>SD Negeri Margajaya 4</td>
                          </tr>
                          <tr>
                            <td>14</td>
                            <td>201731104</td>
                            <td>Safa Alifiah Sagita</td>
                            <td>SDIT Al Fatih</td>
                          </tr>
                          <tr>
                            <td>15</td>
                            <td>201731070</td>
                            <td>Ghefira Lutfiah Muslim</td>
                            <td>SDIT Islamiyah</td>
                          </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>
        $(document).ready(function () {

            var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn'),
                    submitBtn = $('#daftar');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                        $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function(){
                $('.alert-success').hide();
                $('.alert-danger').hide();

                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                        //alert(i);
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
        </script>
    </body>
</html>
