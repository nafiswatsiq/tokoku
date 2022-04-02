<?php
require_once '../proses/user.php';
$user = new user;
?>
<div class="linearLayout animate__animated animate__fadeInUp">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="col-1">
                    <div id="btnClose" class="text-decoration-none"><i class="bi bi-arrow-left nav-btn-back"></i></div>
                </div>
                <div class="col-11 nav_fragment">
                    <h5>Nomor Handphone</h5>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="default_box box-email">
                        <h6><i class="bi bi-phone"></i> Nomor kamu</h6>
                        <span class="color"><?php $user->noHp() ?></span>
                    </div>
                </div>
                <div class="col-12 mt-1">
                    <div class="default_box box-email">
                        <h6>Mau ubah nomor?</h6>
                        <span id="Toggle" class="color">Ubah Nomor</span>
                        <form action="" id="form" method="post">
                            <hr>
                            <div class="col-12 mt-4">
                                <input type="tel" name="noHp" id="" placeholder="Masukan Nomor">
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $("#btnClose").click(function () {
        $("#loader").hide();
        $(".linearLayout").removeClass("animate__fadeInUp").addClass("animate__fadeOutDown hide");
        $(".linearLayout").fadeOut(600);
    });
    $("#Toggle").click(function () {
        $("#form").slideToggle(200);
    });

    $( "#form" ).submit(function( event ) {
            $(".loader").show();
            var data = $('#form').serialize();
            $.ajax({
            type: 'POST',
            url: "proses/user.php",
            data: data,

            cache: false,
            success: function (data) {
                $(".loader").hide();
            }
        });
    });
</script>