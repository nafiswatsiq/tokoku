<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/toko.php';
require_once 'kredensial/user.php';

function details(){
    global $id_user;
    global $conn;
    $query="SELECT * FROM user WHERE id_user='$id_user'";
    $result=mysqli_query($conn, $query);

    foreach($result as $detail){
        $nama = $detail['nama'];
        $noHp = $detail['noHp'];
        $alamat = $detail['alamat'];
        $kodePos = $detail['kodePos'];
        // if($alamat['alamat'] != ""){
        //     echo $alamat['alamat'].'<br>kode POS ['.$alamat['kodePos'].']';
        // }else{
        //     echo 'Kamu belum memasukan alamat';
        // }
    };
    return array(
        'nama' => $nama,
        'noHp' => $noHp,
        'alamat' => $alamat,
        'kodePos' => $kodePos,
    );
}
function invoice(){
    $permitted_chars = '01111111123456789';
    function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }
    $invoice = generate_string($permitted_chars, 10);
    return $invoice;
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

    <title>Checkout</title>
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
    <div id="loader" class="loader">
        <img src="assets/img/loader.png" alt="">
    </div>
<form action="" method="get" id="form">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="text-decoration-none"><i class="bi bi-arrow-left nav-btn-back"></i></div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="box-checkout">
            <div class="row">
                <div class="col-12">
                    <span class="alamat-pengiriman"><i class="bi bi-geo-alt"></i> Alamat Pengiriman</span>
                </div>
                <div class="col-12">
                    <span class="fs-6 fw-600"><?= details()['nama']; ?></span>
                </div>
                <div class="col-12">
                    <span class="fs-7"><?= details()['noHp']; ?></span>
                </div>
                <div class="col-12">
                    <span class="alamat"><?= details()['alamat']; ?><br>Kode Pos [<?= details()['kodePos']; ?>]</span>
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row m-1">
                <div class="col-12 p-0">
                    <span class="rincian"><i class="bi bi-cash"></i> Rincian</span>
                </div>
                <?php
                if(isset($_POST['jumlah'])){
                    $id_produk = $_POST['p'];
                    $jumlah = $_POST['jumlah'];
                    $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");
                    while($row_produk = mysqli_fetch_assoc($query_produk)){
                        $nama = $row_produk['nama'];
                        $harga = $row_produk['harga'];
                        $diskon = $row_produk['diskon'];
                        // hitung diskon
                        if($diskon != 0){
                            $jumlah_diskon = $diskon / 100 * $harga;
                            $result_harga = $harga - $jumlah_diskon;
                        }else{
                            $result_harga = $harga;
                        }
                        $format_list_harga = number_format($result_harga,0,',','.');

                        $harga_jadi = $result_harga * $jumlah;
                        $format_harga = number_format($harga_jadi,0,',','.');
                        $format_total = $format_harga;
        
                        echo '
                        <div class="col-12 p-0">
                            <div class="row">
                                <div class="col-8">
                                    <span class="pesanan">'.$nama.'</span>
                                </div>
                                <div class="col-3">
                                    <span class="harga">'.$format_list_harga.'</span>
                                </div>
                                <div class="col-1 p-0">
                                    <span class="harga">x'.$jumlah.'</span>
                                </div>
                            </div>
                        </div>
                        ';
                    };
                    $jumlahBarang = $jumlah;
                    $idProduk = $id_produk;
                    $totalHarga = $harga_jadi;
                    $harga_asli = $result_harga;
                    $id_keranjang = '';
                }else{
                $idKeranjang = $_POST['id'];
                $id_keranjang = implode(",", $idKeranjang);
                $arr_idKeranjang = explode(",", $id_keranjang);
                foreach($arr_idKeranjang as $row_keranjang){
                    $query_keranjang=mysqli_query($conn, "SELECT * FROM keranjang WHERE id=$row_keranjang");
                    while($row_ = mysqli_fetch_assoc($query_keranjang)){
                        $id_user = $row_['id_user'];
                        $id_produk = $row_['id_produk'];
                        $jumlah = $row_['jumlah'];
                        $tgl = $row_['tgl'];

                        $arr_idProduk[] = $id_produk;
                        $arr_jumlah[] = $jumlah;
            
                        $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");
                        while($row_produk = mysqli_fetch_assoc($query_produk)){
                            $nama = $row_produk['nama'];
                            $harga = $row_produk['harga'];
                            $diskon = $row_produk['diskon'];
                            // hitung diskon
                            if($diskon != 0){
                                $jumlah_diskon = $diskon / 100 * $harga;
                                $result_harga = $harga - $jumlah_diskon;
                            }else{
                                $result_harga = $harga;
                            }
                            $format_list_harga = number_format($result_harga,0,',','.');
                            $list_harga_asli[] = $result_harga;

                            $harga_jadi = $result_harga * $jumlah;
                            $format_harga = number_format($harga_jadi,0,',','.');
                            $jumlahTotal[] = $harga_jadi;
            
                            echo '
                            <div class="col-12 p-0">
                                <div class="row">
                                    <div class="col-8">
                                        <span class="pesanan">'.$nama.'</span>
                                    </div>
                                    <div class="col-3">
                                        <span class="harga">'.$format_list_harga.'</span>
                                    </div>
                                    <div class="col-1 p-0">
                                        <span class="harga">x'.$jumlah.'</span>
                                    </div>
                                </div>
                            </div>
                            ';
                        };
                    };  
                };
                $totalHarga = array_sum($jumlahTotal);
                $format_total = number_format($totalHarga,0,',','.');

                $harga_asli = implode(",", $list_harga_asli);
                $idProduk = implode(",", $arr_idProduk);
                $jumlahBarang = implode(",", $arr_jumlah);
                }
                ?>
                <!-- <div class="col-12 mt-1">
                    <div class="row">
                        <div class="col-8 p-0">
                            <span class="pesanan">Diskon</span>
                        </div>
                        <div class="col-4 ps-3">
                            <span class="harga">0%</span>
                        </div>
                    </div>
                </div> -->
                <div class="col-12 mt-1">
                    <div class="row border-top">
                        <div class="col-8 p-0">
                            <span class="total">Total</span>
                        </div>
                        <div class="col-4 ps-3">
                            <span class="harga"><?= $format_total ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row">
                <div class="col-12">
                    <span class="rincian">pembayaran</span>
                </div>
                <div class="col-12">
                    <div class="custom-select">
                        <select name="pembayaran" required>
                          <option selected="selected" disabled="disabled" value="">Pilih pembayaran</option>
                          <option value="COD">Bayar di tempat (COD)</option>
                        </select>
                      </div>
                </div>
            </div>
        </div>
        <div class="box-checkout">
            <div class="row">
                <div class="col-12">
                    <span class="rincian">Jasa kirim</span>
                </div>
                <div class="col-12">
                    <div class="custom-select">
                        <select name="kurir" required>
                          <option selected="selected" disabled="disabled" value="">Pilih Jasa kirim</option>
                          <option value="Anterin">Anterin</option>
                          <option value="Buat abangnya">Buat abangnya</option>
                          <option value="Ambil sendiri">Ambil sendiri</option>
                        </select>
                      </div>
                </div>
            </div>
        </div>
    </section>
    <section id="nav_bawah">
        <div class="container fixed-bottom">
            <div class="row text-center nav-row-lihat border-top">
                <div class="col-7 p-0">
                    <button type="button" class="lihat-btn-gojek">
                        <span class="harga-checkout"><span class="rp-checkout">Rp</span><?= $format_total ?></span>
                    </button>
                </div>
                <div class="col-5 p-0">
                    <input type="hidden" name="idKeranjang" value="<?= $id_keranjang ?>">
                    <input type="hidden" name="idProduk" value="<?= $idProduk ?>">
                    <input type="hidden" name="jumlahBarang" value="<?= $jumlahBarang ?>">
                    <input type="hidden" name="hargaAsli" value="<?= $harga_asli ?>">
                    <input type="hidden" name="jumlahTotal" value="<?= $totalHarga ?>">
                    <input type="hidden" id="inv" name="invoice" value="<?php echo invoice(); ?>">
                    <button type="submit" class="btn-checkout">Pesan sekarang</button>
                </div>
            </div>
        </div>
    </section>
</form>
    <script src="assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/select.js"></script>
    <script>
        $(document).ready(function () {
            $("#loader").hide();
        });

        $(".bi-arrow-left").click(function () {
            if (document.referrer == "") {
                window.close()
            } else {
                window.history.go(-1);
            }
        });
    
        $( "#form" ).submit(function( event ) {
            $("#loader").show();
            let inv = $("#inv").val();
            var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "proses/inputPesanan.php",
                data: data,

                cache: false,
                success: function (data) {
                    if(data == "berhasil"){
                        $("#loader").hide();
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil menambahkan pesanan',
                        allowOutsideClick: 'false',
                        confirmButtonText: 'Lihat struk',
                        confirmButtonColor: 'rgb(255, 136, 0)',
                        }).then(function() {
                            window.location = 'struk/cetak-struk?inv='+inv;
                        });
                    }else if(data == "gagal"){
                        $("#loader").hide();
                        Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menambahkan pesanan',
                        allowOutsideClick: 'false',
                        confirmButtonText: 'Oke deh :)',
                        confirmButtonColor: 'rgb(255, 136, 0)',
                        });
                    }else{
                        $("#loader").hide();
                        Swal.fire({
                        icon: 'error',
                        title: 'Habis',
                        text: 'Stok telah terjual habis'+ data,
                        allowOutsideClick: 'false',
                        confirmButtonText: 'Oke deh :)',
                        confirmButtonColor: 'rgb(255, 136, 0)',
                        });
                    }
                }
            });
            return false;
        });
    </script>
</body>

</html>