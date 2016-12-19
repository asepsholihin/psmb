<?php
session_start();
include "config.php";
$data = "";
$sql = "SELECT ujian1,ujian2,ujian3,ujian4,ujian5,ujian6,ujian7,ujian8,ujian9,ujian10,ujian11,ujian12,hportu FROM calonsiswa WHERE hportu='".$_SESSION["session_username"]."'";
$query = mysql_query($sql);
if($query) {
    $row = mysql_fetch_assoc($query);
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
        <div class="row setup-content" id="step-1">
            <div class="col-xs-12">
                <h3>Nilai Kelas 4 Semester Ganjil</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Pendidikan Agama Islam</label>
                            <input maxlength="3" type="text" name="k4pai" required class="form-control" value="'.$row['ujian1'].'" placeholder="Pendidikan Agama Islam"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Matematika</label>
                            <input maxlength="3" type="text" name="k4mtk" required class="form-control" value="'.$row['ujian2'].'" placeholder="Matematika" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Bahasa Indonesia</label>
                            <input maxlength="3" type="text" name="k4ind" required class="form-control" value="'.$row['ujian3'].'" placeholder="Bahasa Indonesia" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ilmu Pengetahuan Alam</label>
                            <input maxlength="3" type="text" name="k4ipa" required class="form-control" value="'.$row['ujian4'].'" placeholder="Ilmu Pengetahuan Alam" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-md pull-right" type="button">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <h3>Nilai Kelas 5 Semester Ganjil</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Pendidikan Agama Islam</label>
                            <input maxlength="3" type="text" name="k5pai" required class="form-control" value="'.$row['ujian5'].'" placeholder="Pendidikan Agama Islam"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Matematika</label>
                            <input maxlength="3" type="text" name="k5mtk" required class="form-control" value="'.$row['ujian6'].'" placeholder="Matematika" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Bahasa Indonesia</label>
                            <input maxlength="3" type="text" name="k5ind" required class="form-control" value="'.$row['ujian7'].'" placeholder="Bahasa Indonesia" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ilmu Pengetahuan Alam</label>
                            <input maxlength="3" type="text" name="k5ipa" required class="form-control" value="'.$row['ujian8'].'" placeholder="Ilmu Pengetahuan Aalam" />
                        </div>
                        <button class="btn btn-primary nextBtn btn-md pull-right" type="button">Lanjutkan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row setup-content" id="step-3">
            <div class="col-xs-12">
                <h3>Nilai Kelas 6 Semester Ganjil</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Pendidikan Agama Islam</label>
                            <input maxlength="3" type="text" name="k6pai" required class="form-control" value="'.$row['ujian9'].'" placeholder="Pendidikan Agama Islam"  />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Matematika</label>
                            <input maxlength="3" type="text" name="k6mtk" required class="form-control" value="'.$row['ujian10'].'" placeholder="Matematika" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Bahasa Indonesia</label>
                            <input maxlength="3" type="text" name="k6ind" required class="form-control" value="'.$row['ujian11'].'" placeholder="Bahasa Indonesia" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ilmu Pengetahuan Alam</label>
                            <input maxlength="3" type="text" name="k6ipa" required class="form-control" value="'.$row['ujian12'].'" placeholder="Ilmu Pengetahuan Alam" />
                        </div>
                    </div>
                    <button id="daftar" href="#alert" class="btn btn-primary btn-lg btn-block" type="button">Upload Nilai!</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $(".uploadnilai").addClass("active");

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
            $.post("http://api.marifatussalaam.org/nilai.php", $("#form").serialize(), function(data) {
                var obj = JSON.parse(data);
                $("html, body").animate({
                    scrollTop: $("#top").offset().top
                });
                if (!obj.error) {
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
