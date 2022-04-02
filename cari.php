<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once 'proses/keranjang.php';
$keranjang = new keranjang;

if (empty($_GET['q'])){
    header("location: ./");
}else{
    $cari = $_GET['q'];
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

    <title>Cari</title>
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
    <div class="loader">
        <img src="assets/img/loader.png" alt="">
    </div>
    <div id="floating_wa"></div>
    <form action="cari" method="get">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
        <a class="col-2 navbar-brand ps-2" href="#">
                <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
            </a>
            <div class="col-8 nav-search pe-0">
                <input type="search" name="q" id="" placeholder="Cari...">
            </div>
            <div class="col-2 fs-2">
                <button type="submit" style="width: max-content;border:none; background: transparent;">
                    <i class="fa fa-search ps-2 white" aria-hidden="true"></i>
                </button>
            </div>
        </nav>
    </section>
    </form>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="mt-2 mb-2">Hasil Pencarian Dari <b>"<?php echo $cari; ?>"</b></p>
                    <hr class="mt-1 mb-2">
                </div>
                <div class="col-12 mt-2">
                    <div id="listProduk" class="row g-2 box-content-produk">
                        <!--  -->
                        <div class="col-6 text-decoration-none">
                            <div class="card">
                            <div class="box-card-img skeleton"></div>
                                <div class="card-body">
                                    <span class="card-text">
                                        <div class="skeleton skeleton-text"></div>
                                        <div class="skeleton skeleton-text"></div>
                                    </span>
                                    <div class="row mb-1">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold color"><span class="rp">
                                                    <div class="skeleton skeleton-harga"></div>
                                                </span>
                                        </div>
                                        <div class="col-6 pe-0">
                                            <span class="text-catatan">
                                                <div class="skeleton skeleton-catatan"></div>
                                            </span>
                                        </div>
                                        <div class="col-6 ps-0">
                                            <div class="skeleton skeleton-catatan float-end"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-decoration-none">
                            <div class="card">
                            <div class="box-card-img skeleton"></div>
                                <div class="card-body">
                                    <span class="card-text">
                                        <div class="skeleton skeleton-text"></div>
                                        <div class="skeleton skeleton-text"></div>
                                    </span>
                                    <div class="row mb-1">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold color"><span class="rp">
                                                    <div class="skeleton skeleton-harga"></div>
                                                </span>
                                        </div>
                                        <div class="col-6 pe-0">
                                            <span class="text-catatan">
                                                <div class="skeleton skeleton-catatan"></div>
                                            </span>
                                        </div>
                                        <div class="col-6 ps-0">
                                            <div class="skeleton skeleton-catatan float-end"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-decoration-none">
                            <div class="card">
                            <div class="box-card-img skeleton"></div>
                                <div class="card-body">
                                    <span class="card-text">
                                        <div class="skeleton skeleton-text"></div>
                                        <div class="skeleton skeleton-text"></div>
                                    </span>
                                    <div class="row mb-1">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold color"><span class="rp">
                                                    <div class="skeleton skeleton-harga"></div>
                                                </span>
                                        </div>
                                        <div class="col-6 pe-0">
                                            <span class="text-catatan">
                                                <div class="skeleton skeleton-catatan"></div>
                                            </span>
                                        </div>
                                        <div class="col-6 ps-0">
                                            <div class="skeleton skeleton-catatan float-end"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-decoration-none">
                            <div class="card">
                            <div class="box-card-img skeleton"></div>
                                <div class="card-body">
                                    <span class="card-text">
                                        <div class="skeleton skeleton-text"></div>
                                        <div class="skeleton skeleton-text"></div>
                                    </span>
                                    <div class="row mb-1">
                                        <div class="col-12 mb-1">
                                            <span class="fw-bold color"><span class="rp">
                                                    <div class="skeleton skeleton-harga"></div>
                                                </span>
                                        </div>
                                        <div class="col-6 pe-0">
                                            <span class="text-catatan">
                                                <div class="skeleton skeleton-catatan"></div>
                                            </span>
                                        </div>
                                        <div class="col-6 ps-0">
                                            <div class="skeleton skeleton-catatan float-end"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".loader").hide();
            $("#listProduk").load("proses/list_produk.php?q=<?php echo $cari; ?>");
            $("#floating_wa").load("component/floating-wa.php");
        });
    </script>
</body>

</html>