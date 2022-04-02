<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once "kredensial/user.php";
if(empty($id_user)){
    header("location: ./?login");
}
require_once 'proses/keranjang.php';
$keranjang = new keranjang;
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

    <title>Pesanan</title>
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
    <div id="floating_wa"></div>
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
    <section id="body" class="top-lihat">
        <div class="container" id="listPesanan">
            <!-- Loop -->
            <div class="row">
                <div class="col-12">
                    <div class="box-pesanan default_box">
                        <div class="row">
                            <div class="col-6">
                                <div class="skeleton skeleton-harga"></div>
                            </div>
                            <div class="col-6">
                                <div class="skeleton skeleton-harga float-end"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr style="margin-block-start: 0;margin-block-end: 0; margin: 5px 0;">
                            </div>
                            <div class="col-2 pe-0">
                                <div class="wrap_img_pesanan skeleton">
                                </div>
                            </div>
                            <div class="col-10 box-title-keranjang ps-3">
                                <div class="skeleton skeleton-text"></div>
                                <div class="skeleton skeleton-text"></div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="skeleton skeleton-catatan"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="skeleton skeleton-harga"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->
        </div>
    </section>
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
                    <a href="./keranjang" class="nav-a">
                        <?= $keranjang->jmlh_keranjang() ?>
                        <i class="bi bi-bag-check"></i>
                        <p class="nav-p">Keranjang</p>
                    </a>
                </div>
                <div class="col">
                    <div class="nav-a active">
                        <i class="bi bi-bookmark-check-fill"></i>
                        <p class="nav-p">Pesanan</p>
                    </div>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#listPesanan").load("proses/list_pesanan.php");
            $("#floating_wa").load("component/floating-wa.php");
        });
    </script>
</body>

</html>