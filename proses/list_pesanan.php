<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';

$query_pesanan=mysqli_query($conn, "SELECT * FROM list_pesanan WHERE id_user='$id_user' ORDER BY id DESC");
$cek = mysqli_num_rows($query_pesanan);
if($cek != 0){
    while($row_pesanan = mysqli_fetch_assoc($query_pesanan)){
        $id = $row_pesanan['id'];
        $inv = $row_pesanan['invoice'];
        $id_produk = $row_pesanan['id_produk'];
        $jumlah = $row_pesanan['jumlah'];
        $status = $row_pesanan['status'];
        $tanggal = $row_pesanan['tgl'];
        $harga = $row_pesanan['totalHarga'];
        $format_harga = number_format($harga,0,',','.');

        $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");
        while($row_produk = mysqli_fetch_assoc($query_produk)){
            $getGambar = $row_produk['gambar'];
            $arr_gambar = explode (",",$getGambar);
            $gambar = $arr_gambar[0];
            $nama = $row_produk['nama'];
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="box-pesanan default_box">
                        <div class="row">
                            <div class="col-6">
                                <span class="text"><i class="bi bi-bag-check-fill"></i> Pesananmu</span>
                                <span class="tgl"><?= $tanggal ?></span>
                            </div>
                            <div class="col-6">
                                <?php
                                if($status == 'Selesai'){
                                    echo '
                                    <div class="box-informasi finish">
                                        <span>Selesai</span>
                                    </div>
                                    ';
                                }else{
                                    echo'
                                    <div class="box-informasi">
                                        <span>'.$status.'</span>
                                    </div>
                                    ';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr style="margin-block-start: 0;margin-block-end: 0; margin: 5px 0;">
                            </div>
                            <a href="detail_p?i=<?= $inv ?>" class="row text-decoration-none">
                                <div class="col-2 pe-0">
                                    <div class="wrap_img_pesanan skeleton">
                                        <img loading="lazy"
                                            src="img_produk/<?= $gambar ?>"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col-10 box-title-keranjang ps-3">
                                    <span class="card-text"><?= $nama ?></span>
                                </div>
                            </a>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="jumlah">Jumlah <?= $jumlah ?></span>
                                    </div>
                                    <div class="col-12">
                                        <span class="harga">Rp <?= $format_harga ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="box-selesai">
                                    <span class="fw-500">Diterima</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}else{
    echo'
    <div class="bg-assets-kosong">
        <div class="row justify-content-center">
            <div class="col-8">
                <img src="assets/img/logo2.png" alt="">
            </div>
            <div class="col-8 mt-4">
                <span>Belum ada pesanan, ayo keluarkan uangmu</span>
            </div>
        </div>
    </div>
    ';
}
?>