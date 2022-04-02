<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';
if(empty($_GET['inv'])){
    header('location: ../');
}else{
    $invoice = $_GET['inv'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icon/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/responsive.css" />

    <title>Struk</title>

</head>

<body class="struk-belanja" style="background-color: rgb(255, 211, 161);">
    <div class="bg-struk"></div>
        <div class="container">
            <div class="box-struk mt-3 mb-3">
                <div class="row">
                    <div class="col-1">
                        <i class="bi bi-arrow-left nav-btn-back"></i>
                    </div>
                    <div class="col-11">
                        <span class="white fw-400" style="line-height: 2.2!important;">Bukti Pesanan</span>
                    </div>
                </div>
                <div class="body-struk p-3">
                    <div class="row justify-content-center">
                        <div class="col-2 logo-struk">
                            <img class="" src="../svg/logo.svg" alt="">
                        </div>
                    </div>
                    <div class="row mt-3 mb-1 ps-3 pe-3">
                        <div class="col-12 invoice mb-2 p-0 text-end">
                            <span>INVOICE #<?= $invoice ?></span>
                        </div>
                        <hr style="opacity: 0.2;">
                        <div class="col-8 p-0 fw-600 grey-black">
                            <span>Produk</span>
                        </div>
                        <div class="col-3 p-0 fw-600 grey-black">
                            <span>Harga</span>
                        </div>
                        <div class="col-1 p-0 fw-600 grey-black">
                            <span>Qty</span>
                        </div>
                    </div>
                    <div class="row ps-3 pe-3 grey-black">
                        <?php
                        $query_pesanan=mysqli_query($conn, "SELECT * FROM list_pesanan WHERE invoice=$invoice");
                        $cek = mysqli_num_rows($query_pesanan);
                        if($cek != 0){
                            while($row_pesanan = mysqli_fetch_assoc($query_pesanan)){
                                $id_produk = $row_pesanan['id_produk'];
                                $jumlah = $row_pesanan['jumlah'];
                                $tanggal = $row_pesanan['tgl'];
                                $pembayaran = $row_pesanan['pembayaran'];
                                $harga_asli = $row_pesanan['harga_asli'];
                                $harga = $row_pesanan['totalHarga'];
                                $jumlahTotal[] = $harga;
                                $format_harga_asli = number_format($harga_asli,0,',','.');
                                $format_harga = number_format($harga,0,',','.');

                                $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");
                                while($row_produk = mysqli_fetch_assoc($query_produk)){
                                    $nama = $row_produk['nama'];

                                    echo '
                                    <div class="col-8 p-0 fw-300">
                                        <span>'.$nama.'</span>
                                    </div>
                                    <div class="col-3 p-0 fw-300 struk-harga">
                                        <span>'.$format_harga_asli.'</span>
                                    </div>
                                    <div class="col-1 p-0 fw-300 struk-qty">
                                        <span>'.$jumlah.'</span>
                                    </div>
                                    ';
                                }
                            }
                            $totalHarga = array_sum($jumlahTotal);
                            $format_harga = number_format($totalHarga,0,',','.');
                        }else{
                            header('location: ../');
                        }
                        ?>
                    </div>
                    <hr style="opacity: 0.2; margin-top: 8px;">
                    <div class="row ps-3 pe-3 ">
                        <div class="col-8 fw-600 p-0">
                            <span>Pembayaran</span>
                        </div>
                        <div class="col-4 fw-600 p-0 struk-harga">
                            <span><?= $pembayaran ?></span>
                        </div>
                    </div>
                    <div class="row ps-3 pe-3 ">
                        <div class="col-8 fw-600 p-0">
                            <span>Ongkir</span>
                        </div>
                        <div class="col-4 fw-600 p-0 struk-harga">
                            <span>30.000</span>
                        </div>
                    </div>
                    <div class="row mt-3 ps-3 pe-3">
                        <div class="col-12 struk-total">
                            <span>TOTAL BAYAR <?= $format_harga ?></span>
                        </div>
                    </div>
                </div>
                <div class="container-stamp">
                </div>
            </div>
            <a href="#" id="download">Download <i class="fa fa-download" aria-hidden="true"></i></a>
        </div>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/vendors/screen-capture/html2canvas.min.js"></script>
    <script src="../assets/vendors/screen-capture/canvas2image.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://superal.github.io/canvas2image/canvas2image.js"></script> -->

    <script>
        document.querySelector('#download').addEventListener('click', function() {
        html2canvas(document.querySelector('body'), {
            onrendered: function(canvas) {
                // document.body.appendChild(canvas);
              return Canvas2Image.saveAsJPEG(canvas);
            }
        });
    });
    </script>
    <script>
        $(".bi-arrow-left").click(function () {
            if (document.referrer == "") {
                window.close()
            } else {
                window.history.go(-3);
            }
        });
    </script>
</body>

</html>