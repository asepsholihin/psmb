<?php
session_start();
include "config.php";
$data = "";
$sql = "SELECT * FROM calonsiswa WHERE hportu='".$_SESSION["session_username"]."'";
$query = mysql_query($sql);
if($query) {
    $row = mysql_fetch_assoc($query);
    switch ($row['kelamin']) {
        case 'l':
            $laki='checked';
            break;
        case 'p':
            $perempuan='checked';
            break;
        default:
            break;
    }
    switch ($row['warga']) {
        case 'WNI':
            $wni='checked';
            break;
        case 'WNA':
            $wna='checked';
            break;
        default:
            break;
    }
    switch ($row['almayah']) {
        case '1':
            $almayah='checked';
            break;
        default:
            break;
    }
    switch ($row['almibu']) {
        case '1':
            $almibu='checked';
            break;
        default:
            break;
    }
    $lahir = explode("-", $row['tgllahir']);
    switch ($lahir[1]) {
    case '01':
        $unblnlahir = 'Januari';
        break;
    case '02':
        $unblnlahir = 'Februari';
        break;
    case '03':
        $unblnlahir = 'Maret';
        break;
    case '04':
        $unblnlahir = 'April';
        break;
    case '05':
        $unblnlahir = 'Mei';
        break;
    case '06':
        $unblnlahir = 'Juni';
        break;
    case '07':
        $unblnlahir = 'Juli';
        break;
    case '0':
        $unblnlahir = 'Agustus';
        break;
    case '09':
        $unblnlahir = '9';
        break;
    case '10':
        $unblnlahir = 'Oktober';
        break;
    case '11':
        $unblnlahir = 'November';
        break;
    case '12':
        $unblnlahir = 'Desember';
        break;
    default:
        # code...
        break;
}
}

$content = '
<link rel="stylesheet" href="css/style.daftaronline.min.css">
<div id="top" class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disable" >2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disable">3</a>
                <p>Step 3</p>
            </div>
        </div>
    </div>

    <div class="alert alert-danger alert-dismissible" role="alert" hidden />
    </div>
    <div class="alert alert-success alert-dismissible" role="alert" hidden />
    </div>

    <form id="form">
        <input type="hidden" name="username" value="'.$row['hportu'].'">
        <input type="hidden" name="registrasi" value="website"/>
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <h3>Data Calon Santri</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">NISN</label>
                            <input maxlength="100" type="text" name="nisn" class="form-control" value="'.$row['nisn'].'" placeholder="NISN (dari Sekolah/Kemdikbud)"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">NIK</label>
                            <input maxlength="100" type="text" name="nik" class="form-control" value="'.$row['nik'].'" placeholder="NIK (dari Kartu Keluarga)" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nomor UN</label>
                            <input maxlength="100" type="text" name="noun" class="form-control" value="'.$row['noun'].'" placeholder="No Ujian Nasional" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nama Lengkap</label>
                            <input maxlength="100" type="text" name="nama" required class="form-control" value="'.$row['nama'].'" placeholder="Nama Lengkap" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nama Panggilan</label>
                            <input maxlength="100" type="text" name="panggilan" required class="form-control" value="'.$row['panggilan'].'" placeholder="Nama Panggilan" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jenis Kelamin</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="kelamin" id="inlineRadio1" value="Laki-laki" '.$laki.'> Laki-laki
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="kelamin" id="inlineRadio2" value="Perempuan" '.$perempuan.'> Perempuan
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tempat Lahir</label>
                            <input maxlength="100" type="text" name="tmplahir" required class="form-control" value="'.$row['tmplahir'].'" placeholder="Tempat Lahir" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <div class="row">
                              <div class="col-xs-3">
                                  <select class="form-control" id="tgllahir" name="tgllahir">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">10</option>
                                    <option value="22">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                  </select>
                              </div>
                              <div class="col-xs-5">
                                  <select class="form-control" id="blnlahir" name="blnlahir">
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                  </select>
                              </div>
                              <div class="col-xs-4">
                                  <select class="form-control" id="thnlahir" name="thnlahir">
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                  </select>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Suku</label>
                            <select class="form-control" id="suku" name="suku">
                              <option value="Jawa">Jawa</option>
                              <option value="Sunda">Sunda</option>
                              <option value="Minang">Minang</option>
                              <option value="Betawi">Betawi</option>
                              <option value="Madura">Madura</option>
                              <option value="Aceh">Aceh</option>
                              <option value="Bugis">Bugis</option>
                              <option value="Batak">Batak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" id="status" name="status">
                              <option value="Reguler">Reguler</option>
                              <option value="Mutasi">Mutasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kondisi</label>
                            <select class="form-control" id="kondisi" name="kondisi">
                              <option value="Berkecukupan">Berkecukupan</option>
                              <option value="Kurang Mampu">Kurang Mampu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kewarganegaraan</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="warga" id="inlineRadio1" value="Warga Negara Indonesia" '.$wni.'> Warga Negara Indonesia
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="warga" id="inlineRadio2" value="Warga Negara Asing" '.$wna.'> Warga Negara Asing
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Anak ke</label>
                            <input maxlength="100" type="text" name="anakke" required class="form-control" value="'.$row['anakke'].'" placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status Anak</label>
                            <select class="form-control" id="statusanak" name="statusanak">
                              <option value="Anak Kandung">Anak Kandung</option>
                              <option value="Anak Angkat">Anak Angkat</option>
                              <option value="Anak Tiri">Anak Tiri</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jumlah Saudara Kandung</label>
                            <input maxlength="100" type="text" name="jmlsodara" required class="form-control" value="'.$row['jsaudara'].'" placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jumlah Saudara Tiri</label>
                            <input maxlength="100" type="text" name="jmltiri" class="form-control" value="'.$row['jtiri'].'" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Bahasa</label>
                            <input maxlength="100" type="text" name="bahasa" required class="form-control" value="'.$row['bahasa'].'" placeholder="contoh: Indonesia" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Alamat</label>
                            <textarea class="form-control" name="alamatsiswa" required rows="1">'.$row['alamatsiswa'].'</textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kode Pos</label>
                            <input maxlength="100" type="text" name="kodepossiswa" class="form-control" value="'.$row['kodepossiswa'].'" placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Jarak ke Sekolah (Km)</label>
                            <div class="input-group">
                              <input type="text" name="jaraksekolah" class="form-control" id="exampleInputAmount" value="'.$row['jarak'].'" placeholder="0">
                              <div class="input-group-addon">Km</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Telpon</label>
                            <input maxlength="100" type="text" name="telponsiswa" class="form-control" value="'.$row['telponsiswa'].'" placeholder="0" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Handphone</label>
                            <input maxlength="100" type="text" name="hpsiswa" class="form-control" value="'.$row['hpsiswa'].'" placeholder="(Jika anak sudak punya)" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input maxlength="100" type="text" name="emailsiswa" class="form-control" value="'.$row['emailsiswa'].'" placeholder="(Jika anak sudak punya)" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-md pull-right" type="button">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-6">
                    <h3>Riwayat Kesehatan Calon Santri</h3>
                    <div class="form-group">
                        <label class="control-label">Golongan Darah</label>
                        <select class="form-control" id="darah" name="darah">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="0">O</option>
                            <option value="">Belum mengetahui</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Berat</label>
                        <div class="input-group">
                          <input maxlength="3" type="text" name="berat" required class="form-control" id="exampleInputAmount" value="'.$row['berat'].'" placeholder="0">
                          <div class="input-group-addon">Kg</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tinggi</label>
                        <div class="input-group">
                          <input maxlength="3" type="text" name="tinggi" required class="form-control" id="exampleInputAmount" value="'.$row['tinggi'].'" placeholder="0">
                          <div class="input-group-addon">Cm</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Riwayat Penyakit</label>
                        <input maxlength="100" type="text" name="penyakit" class="form-control" value="'.$row['kesehatan'].'"  placeholder="Penyakit yang pernah/sedang diderita" />
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Data Sekolah Calon Santri</h3>
                    <div class="form-group">
                        <label class="control-label">Asal Sekolah</label>
                        <input maxlength="100" type="text" name="asalsekolah" required class="form-control" value="'.$row['asalsekolah'].'" placeholder="Asal Sekolah" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">No Seri Ijazah</label>
                        <input maxlength="100" type="text" name="noijasah" class="form-control" value="'.$row['noijasah'].'" placeholder="Nomor Seri Ijazah" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Ijazah</label>
                        <input maxlength="100" type="text" name="tglijasah" class="form-control" value="'.$row['tglijasah'].'" placeholder="Tanggal Ijazah" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat Sekolah</label>
                        <input maxlength="100" type="text" name="alamatsekolah" required class="form-control" value="'.$row['ketsekolah'].'" placeholder="Alamat Sekolah" />
                    </div>
                    <button class="btn btn-primary nextBtn btn-md pull-right" type="button" >Lanjutkan</button>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Data Orangtua Calon Santri (Ayah)</h3>
                        <div class="form-group">
                            <label class="control-label">Nama Ayah</label>
                            <input maxlength="100" type="text" name="namaayah" required class="form-control" value="'.$row['namaayah'].'" placeholder="Nama Ayah" />
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="1" name="almayah" '.$almayah.'>
                                Almarhum
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status Orangtua</label>
                            <select class="form-control" id="statusayah" name="statusayah">
                              <option value="Orangtua Kandung">Orangtua Kandung</option>
                              <option value="Orangtua Angkat">Orangtua Angkat</option>
                              <option value="Orangtua Tiri">Orangtua Tiri</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tempat Lahir</label>
                            <input maxlength="100" type="text" name="tmplahirayah" required class="form-control" value="'.$row['tmplahirayah'].'" placeholder="Tempat Lahir" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <input maxlength="100" type="text" name="tgllahirayah" required class="form-control" value="'.$row['tgllahirayah'].'" placeholder="Contoh: 20-03-1985" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pendidikan Ayah</label>
                            <select class="form-control" id="pendidikanayah" name="pendidikanayah">
                              <option value="SD">SD</option>
                              <option value="SMP">SMP</option>
                              <option value="SMA">SMA</option>
                              <option value="SMK">SMK</option>
                              <option value="D1">D1</option>
                              <option value="D2">D2</option>
                              <option value="D3">D3</option>
                              <option value="S1">S1</option>
                              <option value="S2">S2</option>
                              <option value="S3">S3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pekerjaan Ayah</label>
                            <select class="form-control" id="pekerjaanayah" name="pekerjaanayah">
                              <option value="PNS">PNS</option>
                              <option value="TNI/Polri">TNI/Polri</option>
                              <option value="Pegawai Swasta">Pegawai Swasta</option>
                              <option value="Wiraswasta">Wiraswasta</option>
                              <option value="Petani/Peternak/Nelayan">Petani/Peternak/Nelayan</option>
                              <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                              <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Penghasilan Ayah</label>
                            <input maxlength="100" type="text" name="penghasilanayah" class="form-control" value="'.$row['penghasilanayah'].'" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>Data Orangtua Calon Santri (Ibu)</h3>
                        <div class="form-group">
                            <label class="control-label">Nama Ibu</label>
                            <input maxlength="100" type="text" name="namaibu" required class="form-control" value="'.$row['namaibu'].'" placeholder="Nama Ibu" />
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" value="1" name="almibu" '.$almibu.'>
                                Almarhumah
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status Orangtua</label>
                            <select class="form-control" id="statusibu" name="statusibu">
                                <option value="Orangtua Kandung">Orangtua Kandung</option>
                                <option value="Orangtua Angkat">Orangtua Angkat</option>
                                <option value="Orangtua Tiri">Orangtua Tiri</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tempat Lahir</label>
                            <input maxlength="100" type="text" name="tmplahiribu" required class="form-control" value="'.$row['tmplahiribu'].'" placeholder="Tempat Lahir" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tanggal Lahir</label>
                            <input maxlength="100" type="text" name="tgllahiribu" required class="form-control" value="'.$row['tgllahiribu'].'" placeholder="Contoh: 20-03-1985" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pendidikan Ibu</label>
                            <select class="form-control" id="pendidikanibu" name="pendidikanibu">
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="SMK">SMK</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pekerjaan Ibu</label>
                            <select class="form-control" id="pekerjaanibu" name="pekerjaanibu">
                                <option value="PNS">PNS</option>
                                <option value="TNI/Polri">TNI/Polri</option>
                                <option value="Pegawai Swasta">Pegawai Swasta</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Petani/Peternak/Nelayan">Petani/Peternak/Nelayan</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Penghasilan Ibu</label>
                            <input maxlength="100" type="text" name="penghasilanibu" class="form-control" value="'.$row['penghasilanibu'].'" placeholder="0" />
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Email Ayah/Ibu</label>
                            <input maxlength="100" type="text" name="emailayah" required class="form-control" value="'.$row['emailayah'].'" placeholder="Email Ayah/Ibu" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Wali</label>
                            <input maxlength="100" type="text" name="wali" required class="form-control" value="'.$row['wali'].'" placeholder="Nama Wali" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Alamat Orangtua/Wali</label>
                            <input maxlength="100" type="text" name="alamatortu" required class="form-control" value="'.$row['alamatortu'].'" placeholder="Alamat Orangtua/Wali" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Telpon</label>
                            <input maxlength="100" type="text" name="telponortu" class="form-control" value="'.$row['telponortu'].'" placeholder="Telpon" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Hanphone (tidak dapat diubah)</label>
                            <input maxlength="100" type="text" name="hportu" disabled class="form-control" value="'.$row['hportu'].'" placeholder="Nomor Handphone Orangtua/Wali" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pilih Tanggal Seleksi</label>
                            <select id="seleksi" class="form-control" name="seleksi">
                                <option value="15-01-2017">15 Januari 2017</option>
                                <option value="29-01-2017">29 Januari 2017</option>
                                <option value="12-02-2017">12 Februari 2017</option>
                                <option value="26-02-2017">26 Februari 2017</option>
                            </select>
                        </div>
                        <button id="daftar" href="#alert" class="btn btn-primary btn-lg btn-block" type="button">Ubah Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $(".ubahdata").addClass("active");

    $("#tgllahir").val('.$lahir[2].');
    $("#blnlahir").val("'.$unblnlahir.'");
    $("#thnlahir").val('.$lahir[0].');
    $("#suku").val("'.$row['suku'].'");
    $("#status").val("'.$row['status'].'");
    $("#kondisi").val("'.$row['kondisi'].'");
    $("#suku").val("'.$row['suku'].'");
    $("#statusayah").val("'.$row['statusayah'].'");
    $("#pendidikanayah").val("'.$row['pendidikanayah'].'");
    $("#pekerjaanayah").val("'.$row['pekerjaanayah'].'");
    $("#statusibu").val("'.$row['statusibu'].'");
    $("#pendidikanibu").val("'.$row['pendidikanibu'].'");
    $("#pekerjaanibu").val("'.$row['pekerjaanibu'].'");
    $("#seleksi").val("'.$row['info2'].'");

    var navListItems = $("div.setup-panel div a"),
            allWells = $(".setup-content"),
            allNextBtn = $(".nextBtn"),
            submitBtn = $("#daftar");

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr("href")),
                $item = $(this);

        if (!$item.hasClass("disabled")) {
            navListItems.removeClass("btn-primary").addClass("btn-default");
            $item.addClass("btn-primary");
            allWells.hide();
            $target.show();
            $target.find("input:eq(0)").focus();
        }
    });

    allNextBtn.click(function(){
        $(".alert-success").hide();
        $(".alert-danger").hide();

        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $("div.setup-panel div a[href=\'#" + curStepBtn + "\']").parent().next().children("a"),
            curInputs = curStep.find("input[type=\'text\'],input[type=\'url\']"),
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
            nextStepWizard.removeAttr("disabled").trigger("click");
    });

    submitBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $("div.setup-panel div a[href=\'#" + curStepBtn + "\']").parent().next().children("a"),
            curInputs = curStep.find("input[type=\'text\'],input[type=\'url\']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
                //alert(i);
            }
        }
        if (isValid) {
            $("html, body").animate({
                scrollTop: $("#top").offset().top
            });
            $(".alert-success").show();
            $(".alert-success").html("Loading...");
            $.post("http://api.marifatussalaam.org/siswa.php", $("#form").serialize(), function(data) {
                var obj = JSON.parse(data);
                $("html, body").animate({
                    scrollTop: $("#top").offset().top
                });
                if (obj.success) {
                    $(".alert-danger").hide();
                    $(".alert-success").show();
                    $(".alert-success").html(obj.message);
                } else {
                    $(".alert-success").hide();
                    $(".alert-danger").show();
                    $(".alert-danger").html(obj.message);
                }
            });
        }

    });

    $("div.setup-panel div a.btn-primary").trigger("click");
});
</script>
';

?>
