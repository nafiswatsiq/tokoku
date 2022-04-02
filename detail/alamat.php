<?php
require_once '../proses/user.php';
$user = new user;
?>
<script src="assets/vendors/vue-js/vue.min.js" defer></script>
<script src="API-indonesia/js/app.js" defer></script>
<div class="linearLayout animate__animated animate__fadeInUp">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="col-1">
                    <div id="btnClose" class="text-decoration-none"><i class="bi bi-arrow-left nav-btn-back"></i></div>
                </div>
                <div class="col-11 nav_fragment">
                    <h5>Alamat</h5>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="default_box box-email">
                        <h6><i class="bi bi-geo-alt"> </i>Alamat kamu</h6>
                        <span class="color fs-7"><?php $user->alamat() ?></span>
                    </div>
                </div>
                <div class="col-12 mt-1">
                    <div class="default_box box-email" style="margin-bottom: 70px; overflow-y:scroll;">
                        <h6>Mau ubah Alamat?</h6>
                        <span href="detail/tambah_alamat" id="Toggle" class="color">Ubah Alamat</span>
                        <form action="" id="form" method="post">
                            <hr>
                            <!-- PROVINSI -->
                            <div class="col-12 mt-3">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Provinsi</label>
                                    <select name="provinsi" class="form-control" required id="listProvinsi">
                                        <option selected="selected" disabled="disabled" value="">Provinsi</option>
                                    </select>
                                </div>
                            </div>
                            <!-- KAB/KOTA -->
                            <div class="col-md-12  unhide-on-mounted mt-3" id="kabupaten" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kab/Kota</label>
                                    <select name="kabupaten" class="form-control" required id="listKabupaten">
                                        <option selected="selected" disabled="disabled" value="">Kab/Kota</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12  unhide-on-mounted mt-3" id="kecamatan" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kecamatan</label>
                                    <select name="kecamatan" class="form-control" required id="listKecamatan">
                                        <option selected="selected" disabled="disabled" value="">Kecamatan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12  unhide-on-mounted mt-3" id="kelurahan" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kelurahan</label>
                                    <select name="kelurahan" class="form-control" required id="listKelurahan">
                                        <option selected="selected" disabled="disabled" value="">Kelurahan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12  unhide-on-mounted mt-3" id="kodePos" style="display: none;">
                                <label for="">Kode POS</label>
                                    <input type="tel" name="kodePos" class="form-control" style="width: 30%;">
                            </div>

                            <div class="col-md-12  unhide-on-mounted mt-3" id="jalan" style="display: none;">
                                <label for="">Nama Jalan, Rt/Rw</label>
                                <textarea class="form-control" name="detailAlamat" id="" cols="30" rows="2"
                                    required></textarea>
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
    $("#Toggle").click(function () {
        $("#form").slideToggle(200);
    });
    $("#btnClose").click(function () {
        $("#loader").hide();
        $(".linearLayout").removeClass("animate__fadeInUp").addClass("animate__fadeOutDown hide");
        $(".linearLayout").fadeOut(600);
    });
    $( "#form" ).submit(function( event ) {
            $(".loader").show();
            var data = $('#form').serialize();
            $.ajax({
            type: 'POST',
            url: "proses/updateAlamat.php",
            data: data,

            cache: false,
            success: function (data) {
                $(".loader").hide();
            }
        });
    });
</script>
<script>
$.ajax({
    url: 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
    type: 'GET',
    dataType: 'json',
    success: prov => {
        var html = '<option value="" selected disabled>Provinsi</option>';
        $.each(prov, function(index, val) {
            html += `<option value="${val.id}" id="${val.id}">${val.name}</option>`;
        });
        $('#listProvinsi').html(html);
    },
    error: err => console.log(err),
})
$('#listProvinsi').change(function() {
    $('#kabupaten').show();
    var valProv = $('#listProvinsi').val();
    $.ajax({
        url: `http://www.emsifa.com/api-wilayah-indonesia/api/regencies/${valProv}.json`,
        type: 'GET',
        dataType: 'JSON',
        success: kab => {
            var html = '<option value="" selected disabled>Kab/Kota</option>';
            $.each(kab, function(index, val) {
                html += `<option value="${val.id}" id="${val.id}">${val.name}</option>`;
            });
            $('#listKabupaten').html(html);
        },
    error: err => console.log(err),
    });
});
$('#listKabupaten').change(function() {
    $('#kecamatan').show();
    var valKab = $('#listKabupaten').val();
    $.ajax({
        url: `http://www.emsifa.com/api-wilayah-indonesia/api/districts/${valKab}.json`,
        type: 'GET',
        dataType: 'JSON',
        success: kec => {
            var html = '<option value="" selected disabled>Kecamatan</option>';
            $.each(kec, function(index, val) {
                html += `<option value="${val.id}" id="${val.id}">${val.name}</option>`;
            });
            $('#listKecamatan').html(html);
        },
    error: err => console.log(err),
    });
});
$('#listKecamatan').change(function() {
    $('#kelurahan').show();
    var valKec = $('#listKecamatan').val();
    $.ajax({
        url: `http://www.emsifa.com/api-wilayah-indonesia/api/villages/${valKec}.json`,
        type: 'GET',
        dataType: 'JSON',
        success: kec => {
            var html = '<option value="" selected disabled>Kelurahan</option>';
            $.each(kec, function(index, val) {
                html += `<option value="${val.id}" id="${val.id}">${val.name}</option>`;
            });
            $('#listKelurahan').html(html);
        },
    error: err => console.log(err),
    });
});
$('#listKelurahan').change(function(){
    $('#kodePos').show();
    $('#jalan').show();
})
</script>