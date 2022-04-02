<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
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
    <link rel="stylesheet" href="assets/vendors/Swiper/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/swiperIndex.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />

    <script src="assets/vendors/Swiper/js/swiper-bundle.min.js"></script>

    <title><?php echo $nama_toko;?></title>
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
    <div class="alert">
        <div class="box__alert text-center">
            <h5>Mobile only!</h5>
            <h6>if you use desktop, you can inspect element and use mobile device</h6>
        </div>
    </div>
    <div id="floating_wa"></div>
    <form action="cari" method="get">
        <section id="nav">
            <nav class="row navbar navbar-dark nav-top-home p-0 fixed-top">
                <a class="col-2 navbar-brand" href="#">
                    <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
                </a>
                <div class="col-8 nav-search pe-0">
                    <input type="search" name="q" id="" placeholder="Cari...">
                </div>
                <div class="col-2 nav-search">
                    <button type="submit" style="width: max-content;border:none; background: transparent;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </nav>
        </section>
    </form>

    <section id="body" class="mb-5">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <a href="#" class="swiper-slide">
                    <img src="assets/img/hq720.webp">
                </a>
                <a href="#" class="swiper-slide">
                    <img src="assets/img/hqdefault (1).webp">
                </a>
                <a href="#" class="swiper-slide">
                    <img src="assets/img/hqdefault.webp">
                </a>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <script>
            const swiper = new Swiper('.swiper', {
                // Optional parameters
                direction: 'horizontal',
                loop: true,

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    dynamicBullets: 'true',
                    dynamicMainBullets: '1',
                },
                autoplay: {
                    delay: 5000,
                },

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

            });
        </script>

        <div class="container container-main-features">
            <div class="row main-features">
                <a href="#" class="col box-features text-decoration-none">
                    <div class="col-12">
                        <i class="fa fa-plus-square-o fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-12">
                        <span>Tambah</span>
                    </div>
                </a>
                <a href="#" class="col box-features text-decoration-none">
                    <div class="col-12">
                        <i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-12">
                        <span>Tambah</span>
                    </div>
                </a>
                <a href="#" class="col box-features text-decoration-none">
                    <div class="col-12">
                        <i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-12">
                        <span>Tambah</span>
                    </div>
                </a>
                <a href="#" class="col box-features text-decoration-none">
                    <div class="col-12">
                        <i class="fa fa-credit-card fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-12">
                        <span>Tambah</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="container mt-5">
            <!-- <div class="scroll-label"><span>Special</span></div> -->
            <h5 class="grey">Terlaris</h5>
            <div class="row mb-3" style="height: auto; background-color: rgb(243, 243, 243);">
                <div class="col">
                    <!-- Swiper -->
                    <div class="swiper mySwiper swiper-padding">
                        <div id="listProdukTerlaris" class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="col-12 text-decoration-none">
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
                            </div>
                            <div class="swiper-slide">
                                <div class="col-12 text-decoration-none">
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
                            </div>
                            <div class="swiper-slide">
                                <div class="col-12 text-decoration-none">
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
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <div class="row">
            <h5 class="grey fs-5-5">Mungkin kamu suka</h5>
                <nav>
                    <div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
                        <button class="nav-link active grey" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true" style="width: 50%;border-radius: 10px 10px 0 0;">Food</button>
                        <button class="nav-link grey" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false" style="width: 50%;border-radius: 10px 10px 0 0;">Drink</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="col-12 mb-3">
                            <div id="listProduk" class="row g-2 box-content-produk">
                                <!-- Loop -->
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
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="col-12 mb-3">
                            <div class="row g-2 box-content-produk">
                                <!-- loop -->
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
                                <!-- end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="nav_bawah">
        <div class="container fixed-bottom">
            <div class="row text-center nav-row border-top nav-bottom pb-2">
                <div class="col">
                    <div class="nav-a active">
                        <i class="bi bi-house-fill"></i>
                        <p class="nav-p">Home</p>
                    </div>
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

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        function myFunction(x) {
            if (x.matches) { // If media query matches
                $( ".alert" ).removeClass( "alert__active" );
            } else {
                $( ".alert" ).addClass( "alert__active" );
            }
        }

        var x = window.matchMedia("(max-width: 700px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction)
    </script>
    <script>
        $(document).ready(function () {
            $("#listProdukTerlaris").load("proses/list_produkTerlaris.php");
            $("#listProduk").load("proses/list_produk.php");
            $("#floating_wa").load("component/floating-wa.php");
        });
        // scrolled navbar
        $(function () {
            $(document).scroll(function () {
                var $nav = $(".fixed-top");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
            });
        });

    </script>
    <script>
        var mySwiper = new Swiper(".mySwiper", {
            slidesPerView: 2,
            spaceBetween: 10,
            freeMode: true,
            pagination: {
                clickable: true,
            },
        });
    </script>
    <?php
    if(isset($_GET['login'])){
        echo "
        <script>
        Swal.fire({
            title: 'Login',
            text: 'Sepertinya kamu perlu login dulu',
            confirmButtonColor: 'rgb(255, 136, 0)',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Nanti',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location = 'login';
                }
            })
        </script>
        ";
    }
    ?>
</body>

</html>