<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/toko.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$noHp = $_POST['noHp'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="../assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/vendors/animate-animated-css/animate.min.css" />
    <link rel="stylesheet" href="../assets/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="../assets/vendors/vue-js/vue.min.js" defer></script>
    <script src="../API-indonesia/js/app.js" defer></script>

    <title>Tambah Alamat</title>
    <!-- OG Tags Start -->
    <link rel="icon" type="image/png" href="<?php echo $icon;?>">
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:title" content="<?php echo $title;?>" />
    <meta property="og:image" content="<?php echo $icon;?>" />
    <meta property="og:description" content='<?php echo $description;?>'>
    <meta name="description" content='<?php echo $description;?>'>
    <!-- OG Tags end -->
</head>

<body>
    <!-- <div id="floating_wa"></div>
    <div id="floating_back"></div> -->
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
                    <span class="logo-text">Toko</span>
                </a>
            </div>
        </nav>
    </section>
    <form action="../auth/register" method="POST">
        <section id="body" class="top-lihat mt-3">
            <div class="container">
                <div class="row p-2">
                    <div class="box-alamat default_box">
                        <div id="for-call">
                            <div class="col-12">
                                <span><i class="bi bi-geo-alt"></i> Tambah Alamat</span>
                            </div>
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
                            <div class="col-md-12 d-none unhide-on-mounted mt-3" id="kabupaten" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kab/Kota</label>
                                    <select name="kabupaten" class="form-control" required id="listKabupaten">
                                        <option selected="selected" disabled="disabled" value="">Kab/Kota</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 d-none unhide-on-mounted mt-3" id="kecamatan" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kecamatan</label>
                                    <select name="kecamatan" class="form-control" required id="listKecamatan">
                                        <option selected="selected" disabled="disabled" value="">Kecamatan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 d-none unhide-on-mounted mt-3" id="kelurahan" style="display: none;">
                                <div class="form-group mb-0">
                                    <label for="">Pilih Kelurahan</label>
                                    <select name="kelurahan" class="form-control" required id="listKelurahan">
                                        <option selected="selected" disabled="disabled" value="">Kelurahan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 d-none unhide-on-mounted mt-3" id="kodePos" style="display: none;">
                                <label for="">Kode POS</label>
                                    <input type="tel" name="kodePos" class="form-control" style="width: 30%;">
                                </div>
                            </div>

                            <div class="col-md-12 d-none unhide-on-mounted mt-3" id="jalan" style="display: none;">
                                <label for="">Nama Jalan, Rt/Rw</label>
                                <textarea class="form-control" name="detailAlamat" id="" cols="30" rows="2"
                                    required></textarea>
                            </div>
                            <input type="hidden" name="nama" value="<?= $nama ?>">
                            <input type="hidden" name="username" value="<?= $username ?>">
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="hidden" name="password" value="<?= $password ?>">
                            <input type="hidden" name="noHp" value="<?= $noHp ?>">
                            <div class="row justify-content-center ps-3 pe-3 pb-3 mt-3">
                                <button type="submit">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </form>

    <script src="../assets/vendors/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="../assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/select.js"></script>
    <script>
        $(document).ready(function () {
            $( "#floating_back" ).load( "../component/floating-back.php" );
            $( "#floating_wa" ).load( "../component/floating-wa.php" );
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
</body>

</html>