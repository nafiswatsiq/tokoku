<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once 'kredensial/user.php';
require_once 'proses/singkat_angka.php';
require_once 'proses/keranjang.php';
$keranjang = new keranjang;

$thisUrl = "https://".$_SERVER['HTTP_HOST'];

if (empty($_GET['p'])){
    header("location: ./");
}else{
    $id_produk = $_GET['p'];
}
    $query="SELECT * FROM produk WHERE id_produk=$id_produk";
    $result=mysqli_query($conn, $query);
    $cek = mysqli_num_rows($result);

    if($cek != 0){
        foreach($result as $row){
            $idProduk = $row['id_produk'];
            $nama = $row['nama'];
            $harga = $row['harga'];
            $deskripsi = $row['deskripsi'];
            $gambar = $row['gambar'];
            $diskon = $row['diskon'];
            $stok = $row['stok'];
            $terjual = $row['terjual'];
        }
    }else{
        header("location: ./");
    };

    $arr_gambar = explode (",",$gambar);
    // echo var_dump ($arr_gambar); untuk array semua gambar
    $main_gambar = $arr_gambar[0];
    
    // hitung diskon
    if($diskon != 0){
        $jumlah_diskon = $diskon / 100 * $harga;
        $result_harga = $harga - $jumlah_diskon;
    }else{
        $result_harga = $harga;
    }
    $format_harga = number_format($result_harga,0,',','.');
    $format_harga_asli = number_format($harga,0,',','.');
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
    <link rel="stylesheet" href="assets/vendors/Swiper/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/swiper.css" />
    <link rel="stylesheet" href="assets/css/style.css" />

    <title><?php echo $nama;?></title>
    <!-- Untuk Chrome & Opera -->
    <meta name="theme-color" content="#ff8800"/>
    <!-- Untuk Safari iOS -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#ff8800"/>
    <!-- Untuk Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#ff8800"/>
    <!-- OG Tags Start -->
    <link rel="icon" type="image/png" href="<?php echo $icon;?>">
    <meta property="og:url" content="<?php echo $thisUrl;?>" />
    <meta property="og:title" content="<?php echo $nama;?>" />
    <meta property="og:image" content="img_produk/<?php echo $main_gambar;?>" />
    <meta property="og:description" content='<?php echo $deskripsi;?>'>
    <meta name="description" content='<?php echo $deskripsi;?>'>
    <!-- OG Tags end -->
</head>

<body>
    <div id="floating_wa"></div>
    <form action="cari" method="get">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top-home p-0 fixed-top none">
                <div class="row justify-content-between">
                    <a class="col-2 navbar-brand" href="#">
                        <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block ps-2">
                    </a>
                    <div class="col nav-search pe-0">
                        <input type="search" name="q" id="" placeholder="Cari...">
                    </div>
                    <div class="col-auto nav-search pe-1">
                        <button type="submit" style="width: max-content;border:none; background: transparent;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="col-auto nav-search ps-0 pe-3" style="position: relative;">
                        <a href="./keranjang" type="submit" style="width: max-content;border:none; background: transparent;">
                            <?= $keranjang->jmlh_keranjang_top() ?>
                            <i class="bi bi-bag-check" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
        </nav>
    </section>
    </form>
    <form action="checkout" method="POST" id="form">
        <section id="body" class="top-lihat">
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    <?php
                    foreach($arr_gambar as $getGambar){
                        echo '<div class="swiper-slide">
                                <img src="img_produk/'.$getGambar.'" />
                             </div>';
                    }; ?>
                </div>
                <div class="swiper-button-next next-lihat"></div>
                <div class="swiper-button-prev prev-lihat"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach($arr_gambar as $getGambar){
                        echo '<div class="swiper-slide">
                                <img src="img_produk/'.$getGambar.'" />
                             </div>';
                    }; ?>
                </div>
            </div>

            <div class="container">
                <div class="row mb-2 mt-2">
                    <div class="col-10">
                        <p class="grey title-produk"><?php echo $nama; ?></p>
                    </div>
                    <div class="col-2 text-center favorite">
                        <i class="fa fa-heart-o fs-2 animate__animated " aria-hidden="true"></i>
                        <i class="fa fa-heart fs-2 animate__animated " aria-hidden="true" style="display: none;"></i>
                    </div>
                </div>

                <div class="row">
                    <?php
                    if($diskon != 0){
                        echo '<div class="col-12">
                                <h6 class="fw-300 discount"><span>'.$diskon.'% OFF</span><s>Rp'.$format_harga_asli.'</s></h6>
                              </div>';
                    } ?>
                    <div class="col-6">
                        <p class="fw-bold color h5"><span class="rp">Rp</span><?php echo $format_harga; ?>-,</p>
                    </div>
                    <div class="col-1">
                        Jumlah
                    </div>
                    <div class="col-5">
                        <div class="jumlah">
                            <li onclick="tambah()" class="btn-jumlah tambah"><i class="bi bi-plus-lg"></i></li>
                            <li class="input-value"><input id="value" name="jumlah" value="1" readonly></li>
                            <li onclick="kurang()" class="btn-jumlah kurang"><i class="bi bi-dash-lg"></i></li>
                            <input type="hidden" name="p" value="<?= $id_produk; ?>" readonly>
                            <input type="hidden" name="id_user" value="<?= $id_user;?>">
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-3 border-end">
                        <span class="fs-7 color">Tersedia <?= singkat_angka($stok) ?></span>
                    </div>
                    <div class="col-3">
                        <span class="fs-7 color">Terjual <?= singkat_angka($terjual) ?></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="separator"><span>Deskripsi</span></div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <?php echo $deskripsi; ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <span class="fw-bold">Produk Lainya</span>
                    </div>
                    <div class="col-12 mt-3">
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
        <div class="row justify-content-center">
            <div class="col-2">
                <div class="bounce_cart animate__animated none"><i class="bi bi-cart-plus"></i><span id="bounceJmlh"></span></div>
            </div>
        </div>
        <section id="nav_bawah">
            <div class="container fixed-bottom">
                <div class="row text-center nav-row-lihat border-top">
                    <div class="col-3 p-0">
                        <button type="button" class="lihat-btn-gojek"><img src="svg/gojek.svg" alt=""></button>
                    </div>
                    <div class="col-3 p-0">
                        <?php 
                         if(isset($id_user)){
                            echo'<button type="button" id="addCart" class="lihat-btn-keranjang"><i id="icon-cart" class="bi bi-cart-plus"></i></button>';
                         }else{
                            echo '<button type="button" class="lihat-btn-keranjang" id="Login"><i class="bi bi-cart-plus"></i></button>';
                         }
                        ?>
                    </div>
                    <div class="col-6 p-0">
                    <?php 
                         if($stok == 0){
                            echo'<button type="button" id="Beli" class="lihat-btn-beli">Beli</button>';
                         }elseif(isset($id_user)){
                            echo'<button type="submit" class="lihat-btn-beli">Beli</button>';
                         }else{
                            echo '<button type="button" id="Login2" class="lihat-btn-beli">Beli</button>';
                         }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/vendors/Swiper/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $( "#addCart" ).click(function( event ) {
        var stok = <?= $stok ?>;
            if(stok == 0){
                Swal.fire({
                title: 'Maaf Produk Habis',
                text: 'Kamu bisa memilih menu lainya',
                confirmButtonColor: 'rgb(255, 136, 0)',
                })
            }else{
                $( "#addCart" ).prop( "disabled", true );
                let jumlah = $("#value").val();
                $("#bounceJmlh").html('+'+jumlah);
                $("#icon-cart").removeClass("bi bi-cart-plus").addClass("fa fa-spinner");
                $(".bounce_cart").removeClass("animate__zoomOutUp").addClass("none");
                var data = $('#form').serialize();
                $.ajax({
                    type: 'POST',
                    url: "proses/inputKeranjang.php",
                    data: data,

                    cache: false,
                    success: function (data) {
                        if(data == 'berhasil'){
                        $( "#addCart" ).prop( "disabled", false );
                        $("#icon-cart").removeClass("fa fa-spinner").addClass("bi bi-cart-plus");
                        $(".bounce_cart").removeClass("none").addClass("animate__zoomOutUp");
                        }
                    }
                });
            }
        });

        $("#Beli").click(function () {
            Swal.fire({
            title: 'Maaf Produk Habis',
            text: 'Kamu bisa memilih menu lainya',
            confirmButtonColor: 'rgb(255, 136, 0)',
            })
        });
        $("#Login").click(function () {
            Swal.fire({
            title: 'Login',
            text: 'Eits.. kamu perlu login dulu',
            icon: 'warning',
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
        });
        $("#Login2").click(function () {
            Swal.fire({
            title: 'Login',
            text: 'Eits.. kamu perlu login dulu',
            icon: 'warning',
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
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#listProduk").load("proses/list_produk.php");
            $( "#floating_wa" ).load( "component/floating-wa.php" );
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
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 3,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 0,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
    <script>
        function kurang() {
            var value = document.getElementById('value').value;
            if (value <= 1) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Jangan Kosong dong'
                })
            } else {
                hasil = parseInt(value) - 1;
                document.getElementById('value').value = hasil;
            }
        };

        function tambah() {
            var value = document.getElementById('value').value;
            if(value >= <?= $stok ?>){
                Swal.fire({
                title: 'Stok Tinggal <?= $stok ?>',
                text: 'silahkan beli seadanya ya...',
                confirmButtonColor: 'rgb(255, 136, 0)',
                })
            }else{
                if (value >= 50) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'warning',
                        title: 'Jangan Banyak-banyak'
                    })
                } else {
                    hasil = parseInt(value) + 1;
                    document.getElementById('value').value = hasil;
                }
            }
        };
    </script>
    <script>
        // add Favorite
        <?php
            $query_favorite=mysqli_query($conn, "SELECT * FROM `favorite` WHERE id_user='$id_user' AND id_produk=$idProduk");
            $cek_favorite = mysqli_num_rows($query_favorite);
        ?>
        $(document).ready(function () {
           var favorite = "<?= $cek_favorite; ?>";
           if(favorite != 0){
                $( ".favorite i" ).toggle();
           }
        });
        $(".favorite i").click(function () {
            var idProduk = <?= $idProduk ?>;
            $( ".favorite i" ).toggle();

            $.post( "proses/addFavorite.php", { "idprod": idProduk})
            .done(function( data ) {
                if(data == "berhasil"){
                    $(".favorite i").addClass("animate__rubberBand");
                }else{
                    $( ".favorite i" ).toggle();
                }
            });
        });
    </script>
</body>

</html>