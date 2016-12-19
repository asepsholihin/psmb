<?php
session_start();
include "config.php";
$sql = "SELECT konfirmasi_biaya FROM calonsiswa WHERE hportu='".$_SESSION["session_username"]."'";
$row = mysql_fetch_assoc(mysql_query($sql));
if($row['konfirmasi_biaya'] == 0) {
    $upload = "
    <div id=\"top\" class=\"row\">
        <div class=\"col-md-6 col-md-offset-3 text-center\">
            <div class='alert alert-danger alert-dismissible' role='alert' hidden />
            </div>
            <div class='alert alert-success alert-dismissible' role='alert' hidden />
            </div>

            <form id=\"form\" enctype=\"multipart/form-data\">
            <div id=\"image-preview\">
              <label for=\"image-upload\" id=\"image-label\">Ambil Foto</label>
              <input type=\"hidden\" name=\"username\" value=\"".$_SESSION["session_username"]."\">
              <input type=\"file\" name=\"file\" id=\"image-upload\" />
            </div>
            <input id=\"upload\" class=\"active btn\" type=\"button\" name=\"upload\" value=\"Upload\" />
            </form>
        </div>
    </div>
    ";
} else {
    $upload = "
    <div id=\"top\" class=\"row\">
        <div class=\"col-md-6 col-md-offset-3 text-center\">
            <p>Terimakasih, tunggu sampai kami konfirmasi kembali</p>
        </div>
    </div>
    ";
}

$content = "
<style type=\"text/css\">
#image-preview {
  height: 400px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
  margin-bottom: 20px;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: rgba(155, 111, 226, 0.64);
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
</style>

".$upload."

<div class=\"loading\">Loading</div>
<script type=\"text/javascript\" src=\"js/jquery.uploadPreview.min.js\"></script>
<script>
$(document).ready(function() {
    $.uploadPreview({
        input_field: '#image-upload',
        preview_box: '#image-preview',
        label_field: '#image-label'
    });

    $('.konfirmasipembayaran').addClass('active');

    $('#upload').click(function (){
        $('html, body').animate({
            scrollTop: $('#top').offset().top
        });
        $('.alert-success').show();
        $('.alert-success').html('Loading...');
        var form = new FormData(document.getElementById('form'));
        $.ajax({
            url: 'http://api.marifatussalaam.org/konfirmasi.php',
            type: 'POST',
            data: form,
            processData: false,
            contentType: false
        }).done(function( data ) {
            var obj = JSON.parse(data);
            if (obj.success) {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success').html(obj.message);
            } else {
                $('.alert-success').hide();
                $('.alert-danger').show();
                $('.alert-danger').html(obj.message);
            }
            setTimeout(function(){
                location = '?pg=konfirmasipembayaran';
            },2000);
        });
    });
});
</script>
";

mysql_close($koneksi);
?>
