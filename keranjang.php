<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once "kredensial/user.php";
if(empty($id_user)){
    header("location: ./?login");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/animate-animated-css/animate.min.css" />
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <title>Keranjang</title>
    <!-- Untuk Chrome & Opera -->
    <meta name="theme-color" content="#ff8800"/>
    <!-- Untuk Safari iOS -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#ff8800"/>
    <!-- Untuk Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#ff8800"/>
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
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
                    <span class="logo-text"><?php echo $nama_toko;?></span>
                </a>
            </div>
        </nav>
    </section>
    <form action="./checkout" method="POST" id="form">
        <section id="body" class="top-lihat">
            <div class="container pe-3">
                <div class="row mt-2 mb-2">
                    <div class="col-12 checkbox_keranjang">
                        <input type="checkbox" id="checkAll" name="checkAll" class="checkAll">
                        <label for="checkAll" class="fw-500 ">Pilih Semua</label>
                    </div>
                </div>
                <div id="listKeranjang">
                    <!-- skeleton -->
                    <div class="row border border-radius-keranjang mb-2">
                        <a href="#" class="col-11 text-decoration-none pe-1 box-produk-keranjang idProd3">
                            <div class="row">
                                <div class="col-3 p-0 box-img-keranjang skeleton">
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12 box-title-keranjang">
                                            <span class="card-text">
                                                <div class="skeleton skeleton-text"></div>
                                                <div class="skeleton skeleton-text"></div>
                                            </span>
                                        </div>
                                        <div class="col-9">
                                            <span class="fw-bold color">
                                                <div class="skeleton skeleton-harga"></div>
                                            </span>
                                        </div>
                                        <div class="col-3">
                                            <span class="float-end x-beli-keranjang-page">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="row border border-radius-keranjang mb-2">
                        <a href="#" class="col-11 text-decoration-none pe-1 box-produk-keranjang idProd3">
                            <div class="row">
                                <div class="col-3 p-0 box-img-keranjang skeleton">
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12 box-title-keranjang">
                                            <span class="card-text">
                                                <div class="skeleton skeleton-text"></div>
                                                <div class="skeleton skeleton-text"></div>
                                            </span>
                                        </div>
                                        <div class="col-9">
                                            <span class="fw-bold color">
                                                <div class="skeleton skeleton-harga"></div>
                                            </span>
                                        </div>
                                        <div class="col-3">
                                            <span class="float-end x-beli-keranjang-page">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--  -->
                </div>
            </div>
        </section>
        <section>
            <div class="keranjang-checkout">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <button></button>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <section id="nav_bawah">
        <div class="container fixed-bottom">
            <div class="row text-center nav-row border-top nav-bottom pb-2">
                <div class="col">
                    <a href="./" class="nav-a">
                        <i class="bi bi-house"></i>
                        <p class="nav-p">Home</p>
                    </a>
                </div>
                <div class="col">
                    <div class="nav-a active">
                        <i class="bi bi-bag-check-fill"></i>
                        <p class="nav-p">Keranjang</p>
                    </div>
                </div>
                <div class="col">
                    <a href="./pesanan" class="nav-a">
                        <i class="bi bi-bookmark-check"></i>
                        <p class="nav-p">Pesanan</p>
                    </a>
                </div>
                <div class="col">
                    <a href="./user" class="nav-a">
                        <i class="bi bi-person"></i>
                        <p class="nav-p">Profil</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#listKeranjang").load("proses/list_keranjang.php");
        });
    </script>
    <script>
        // delete button
        function openDel(idValue) {
            var id = idValue;
            let idProd = document.querySelector("#idProd_" + id);
            idProd.classList.toggle("delete-open");

            $( "#btnDel_"+id ).click(function( event ) {
                var data = $('#delete_'+id).serialize();
                $.ajax({
                    type: 'GET',
                    url: "proses/deleteKeranjang.php",
                    data: data,

                    cache: false,
                    success: function (data) {
                        $('#boxKeranjang_'+id).addClass('animate__fadeOutRight animate__faster 500ms');
                        // $('#boxKeranjang_'+id).remove();
                        $( '#boxKeranjang_'+id).slideUp( 600, function() {
                            $('#boxKeranjang_'+id).remove()
                        });
                    }
                });
            });
        }

        // click all
        $(function () {
            $('.checkAll').click(function () {
                if (this.checked) {
                    $(".keranjang-checkout").show();
                    $(" label.fw-500").addClass("color");

                    $(".checkboxes").prop("checked", true);

                    var n = $("#select:checked").length;
                    $(".keranjang-checkout button").text(n + (n === 1 ? " " : " ") + " Checkout!");
                } else {
                    $(".keranjang-checkout").hide()
                    $(" label.fw-500").removeClass("color");
                    $(".checkboxes").prop("checked", false);
                }
            });

            $(".checkboxes").click(function () {
                var numberOfCheckboxes = $(".checkboxes").length;
                var numberOfCheckboxesChecked = $('.checkboxes:checked').length;
                if (numberOfCheckboxes == numberOfCheckboxesChecked) {
                    $(" label.fw-500").addClass("color");
                    $(".checkAll").prop("checked", true);
                } else {
                    $(" label.fw-500").removeClass("color");
                    $(".checkAll").prop("checked", false);
                }
            });
        });
    </script>
</body>

</html>