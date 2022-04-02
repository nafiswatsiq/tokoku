<?php
require_once "kredensial/user.php";
if(empty($id_user)){
    header("location: ./?login");
}

require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once 'proses/notifikasi.php';
$notifikasi = new notifikasi;
require_once 'proses/keranjang.php';
$keranjang = new keranjang;

function nama(){
    global $id_user;
    global $conn;
    $query=mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");

    foreach($query as $nama){
        if($nama['nama'] != ""){
            echo $nama['nama'];
        }else{
            echo 'Kamu belum memasukan nama kamu';
        }
    };
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

    <title>User</title>
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
    <div id="loader" class="loader">
        <img src="assets/img/loader.png" alt="">
    </div>
    <div id="floating_wa"></div>
    <div class="notification">
        <div id="box-notif" class="box animate__animated animate__faster 500ms animate__fadeInDown">
            <div class="row ps-3 pe-3 pb-4">
                <div class="col-12">
                    <button type="button" class="btn-close" aria-label="Close"></button>
                    <div class="col-12 text-center p-2">
                        <span class="fw-bold h5">Notifikasi</span>
                    </div>
                </div>
                <?php
                $query="SELECT * FROM notifikasi ORDER BY id DESC";
                $result=mysqli_query($conn, $query);
                $jmlh_notif = mysqli_num_rows($result);
                 if($jmlh_notif != 0){
                    while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <a class="col-12 text-decoration-none">
                        <div class="default_box">
                            <div class="row">
                                <div class="col-10">
                                    <h5>'.$row['title'].'</h5>
                                </div>
                                <div class="col-2 text-end">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </div>
                                <div class="col-12">
                                    <span>'.$row['value'].'</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    ';
                    }
                }else{
                    echo 'Tidak ada notifikasi';
                }
                //$notifikasi->notifikasi(); ?>
            </div>
        </div>
    </div>

    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="svg/logo.svg" width="50px" alt="Logo" class="d-inline-block">
                    <span class="logo-text"><?php echo $nama_toko;?></span>
                </a>
                <div class="nav-cart">
                    <?php $notifikasi->jumlah_notif(); ?>
                    <i class="bi bi-bell"></i>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row border-bottom" style="padding: 10px 5px;">
                <div class="col-2">
                    <img class="img-profil" src="svg/logo.svg">
                </div>
                <div class="col-10">
                    <h3 class="profil-user"><?php nama(); ?></h3>
                </div>
            </div>
            <div class="row">
                <div id="callEmail" class="col-12 border-bottom profil-data">
                    <span>Email</span>
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div id="callPhone" class="col-12 border-bottom profil-data">
                    <span>No Hp</span>
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div id="callAlamat" class="col-12 border-bottom profil-data">
                    <span>Alamat</span>
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div id="callFavorite" class="col-12 border-bottom profil-data">
                    <span>Favorit</span>
                    <i class="bi bi-chevron-right"></i>
                </div>
                <div id="callRiwayat" class="col-12 border-bottom profil-data">
                    <span>Riwayat</span>
                    <i class="bi bi-chevron-right"></i>
                </div>
                <a href="auth/logout" class="col-12 border-bottom profil-data">
                    <span>Logout</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
                <div id="delete" class="col-12 border-bottom profil-data">
                    <span>Hapus akun</span>
                    <i class="bi bi-chevron-right"></i>
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
                    <div class="nav-a active">
                        <i class="bi bi-person-fill"></i>
                        <p class="nav-p">Profil</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="linearLayout"></div>

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script>
        $(".bi-bell").click(function () {
            $("#box-notif").removeClass("animate__fadeOutUp");
            $("#box-notif").addClass("animate__fadeInDown");
            $(".notification").fadeIn(500);
        });
        $(".btn-close").click(function () {
            $("#box-notif").removeClass("animate__fadeInDown");
            $("#box-notif").addClass("animate__fadeOutUp");
            $(".notification").fadeOut(800);
        });

        $(document).ready(function () {
            $("#floating_wa").load("component/floating-wa.php");
            $("#loader").hide();
        });
        $("#callEmail").click(function () {
            $("#loader").show();
            $("#linearLayout").load("detail/email.php");
        });
        $("#callPhone").click(function () {
            $("#loader").show();
            $("#linearLayout").load("detail/phone.php");
        });
        $("#callAlamat").click(function () {
            $("#loader").show();
            $("#linearLayout").load("detail/alamat.php");
        });
        $("#callRiwayat").click(function () {
            $("#loader").show();
            $("#linearLayout").load("detail/riwayat.php");
        });
        $("#callFavorite").click(function () {
            $("#loader").show();
            $("#linearLayout").load("detail/favorite.php");
        });
        $("#delete").click(function () {
            Swal.fire({
            title: 'Hapus akun',
            text: 'Yakin mau hapus akunmu?',
            icon: 'warning',
            confirmButtonColor: 'rgb(255, 136, 0)',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Ga jadi',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location = 'delete.php'; 
                }
            })
        });
    </script>
</body>
</html>