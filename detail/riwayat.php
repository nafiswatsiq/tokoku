<div class="linearLayout animate__animated animate__fadeInUp">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="col-1">
                    <div id="btnClose" class="text-decoration-none"><i class="bi bi-arrow-left nav-btn-back"></i></div>
                </div>
                <div class="col-11 nav_fragment">
                    <h5>Riwayat</h5>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row">
                <?php
                require_once '../kredensial/koneksi.php';
                require_once '../kredensial/user.php';
                
                $query_pesanan=mysqli_query($conn, "SELECT * FROM list_pesanan WHERE id_user='$id_user' AND status='Selesai' ORDER BY id DESC");
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
                <div class="col-12">
                    <div class="box-pesanan default_box">
                        <div class="row">
                            <div class="col-6">
                                <span class="text"><i class="bi bi-bag-check-fill"></i> Pesananmu</span>
                                <span class="tgl"><?=  $tanggal ?></span>
                            </div>
                            <div class="col-6">
                                <div class="box-informasi finish">
                                    <span>Selesai</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr style="margin-block-start: 0;margin-block-end: 0; margin: 5px 0;">
                            </div>
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
                                    <form action="detail_p" method="get">
                                    <input type="hidden" name="i" value="<?= $inv ?>">
                                    <button type="submit" class="fw-500">Detail</button>
                                    </form>
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
                                <span>Belum ada Riwayat, ayo keluarkan uangmu</span>
                            </div>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>
</div>
<script>
    $("#btnClose").click(function () {
        $("#loader").hide();
        $(".linearLayout").removeClass("animate__fadeInUp").addClass("animate__fadeOutDown hide");
        $(".linearLayout").fadeOut(600);
    });
    $("#Toggle").click(function () {
        $("#form").slideToggle(200);
    });
</script>