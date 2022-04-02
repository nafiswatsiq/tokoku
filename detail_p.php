<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once "kredensial/user.php";
require_once "proses/detail_p.php";
if(empty($id_user)){
    header("location: ./?login");
}

if(empty($_GET['i'])){
    header('location: ./');
}else{
    $inv = $_GET['i'];
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

    <title>Detail Pesanan</title>
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

<body style="background-color: #f8f8f8;">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="col-1">
                    <i class="bi bi-arrow-left nav-btn-back"></i>
                </div>
                <div class="col-11 nav_fragment">
                    <h5>Detail Pesanan</h5>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="box-checkout">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 lh-base">Status</h6>
                </div>
                <?php
                if(getDetail()['status'] == 'Selesai'){
                    echo '
                    <div class="col-6 text-end">
                        <div class="box-informasi finish">
                            <span class="fw-500">'.getDetail()['status'].'</span>
                        </div>
                    </div>
                    ';
                }else{
                    echo '
                    <div class="col-6 text-end">
                        <div class="box-informasi">
                            <span class="fw-500">'.getDetail()['status'].'</span>
                        </div>
                    </div>
                    ';
                }
                ?>
                <div class="col-8">
                    <span class="invoice">#INV/<?= getDetail()['tanggal']; ?>/<?= $inv ?></span>
                </div>
                <div class="col-4 text-end">
                    <a href="struk/cetak-struk.php?inv=<?= $inv ?>" class="fw-500 color fs-7" target="_blank" rel="noopener noreferrer">Lihat Struk</a>
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row">
                <div class="col-12">
                    <h6 class="m-0 lh-base">Produk</h6>
                </div>
                <div class="col-12">
                    <!-- loop -->
                    <?php
                    $id_produk = getDetail()['id_produk'];
                    $explode_idproduk = explode(",", $id_produk);
                    foreach($explode_idproduk as $row_idProduk){
                        $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$row_idProduk");
                        while($row_produk = mysqli_fetch_assoc($query_produk)){
                            $nama = $row_produk['nama'];
                            $getGambar = $row_produk['gambar'];
                            $arr_gambar = explode (",",$getGambar);
                            $gambar = $arr_gambar[0];
                        
                            echo '
                            <div class="box-pesanan default_box">
                                <div class="row">
                                    <div class="col-2 pe-0">
                                        <div class="wrap_img_pesanan skeleton">
                                            <img loading="lazy"
                                                src="img_produk/'.$gambar.'" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 box-title-keranjang ps-3">
                                        <span class="card-text">'.$nama.'</span>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }
                    ?>
                    <!--  -->
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row m-1">
                <div class="col-12 p-0">
                    <span class="rincian">Rincian</span>
                </div>
                <div class="col-12 p-0">
                <?php
                $id_produk = getDetail()['id_produk'];
                $jumlah = getDetail()['jumlah'];
                $harga = getDetail()['harga'];

                $explode_idproduk = explode(",", $id_produk);
                $explode_jumlah = explode(",", $jumlah);
                $explode_harga = explode(",", $harga);

                $arr_produk = array_combine($explode_idproduk,$explode_jumlah);
                $i= 0;
                foreach($arr_produk as $row_idProduk => $row_jumlah){
                    $Qty = $row_jumlah;
                    $format_harga = number_format($explode_harga[$i],0,',','.');
                    $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$row_idProduk");
                    while($row_produk = mysqli_fetch_assoc($query_produk)){
                        $nama = $row_produk['nama'];
                        $getGambar = $row_produk['gambar'];
                        $arr_gambar = explode (",",$getGambar);
                        $gambar = $arr_gambar[0];
                        
                        echo '
                        <div class="row">
                            <div class="col-8">
                                <span class="pesanan">'.$nama.'</span>
                            </div>
                            <div class="col-3">
                                <span class="harga">'.$format_harga.'</span>
                            </div>
                            <div class="col-1 p-0">
                                <span class="harga">x'.$Qty.'</span>
                            </div>
                        </div>
                        ';
                    }
                    $i++;
                }
                    ?>
                </div>
                <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-8 p-0">
                            <span class="pesanan">Diskon</span>
                        </div>
                        <div class="col-4 ps-3">
                            <span class="harga">0%</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-1">
                    <div class="row border-top">
                        <div class="col-8 p-0">
                            <span class="total">Total</span>
                        </div>
                        <div class="col-4 ps-3">
                            <span class="harga"><?= getDetail()['total_harga']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row">
                <div class="col-12">
                    <span class="rincian">Pengiriman</span>
                    <hr class="mt-1 mb-1">
                </div>
                <div class="row">
                    <div class="col-4">
                        <span class="fw-500 fs-7">Pembayaran</span>
                    </div>
                    <div class="col-8">
                        <span class="fs-7">: <?= getDetail()['pembayaran']; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <span class="fw-500 fs-7">Kurir</span>
                    </div>
                    <div class="col-10">
                        <span class="fs-7">: <?= getDetail()['kurir']; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        <span class="fw-500 fs-7">alamat</span>
                    </div>
                    <div class="col-10">
                        <span class="fs-7">: <?= getDetail()['alamat']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section id="nav_bawah">
        <div class="container fixed-bottom">
            <div class="row text-center nav-row-lihat border-top">
                <div class="col-12 p-0">
                    <button type="button" class="lihat-btn-gojek">
                        <span class="harga-checkout"><span class="rp-checkout">Rp</span>10.000</span>
                    </button>
                </div>
            </div>
        </div>
    </section> -->

    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/select.js"></script>
    <script>
        $(".bi-arrow-left").click(function () {
            if (document.referrer == "") {
                window.close()
            } else {
                window.history.go(-1);
            }
        });
    </script>
</body>

</html>