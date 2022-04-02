<?php
require_once '../proses/user.php';
require_once '../kredensial/koneksi.php';
$user = new user;
?>
<div class="linearLayout animate__animated animate__fadeInUp">
    <section id="nav">
        <nav class="navbar navbar-dark nav-top p-0">
            <div class="container-fluid mt-2 mb-2">
                <div class="col-1">
                    <div id="btnClose" class="text-decoration-none"><i class="bi bi-arrow-left nav-btn-back"></i></div>
                </div>
                <div class="col-11 nav_fragment">
                    <h5>Favorite</h5>
                </div>
            </div>
        </nav>
    </section>
    <section id="body" class="top-lihat">
        <div class="container">
            <div class="row">
            <?php
                $query_favorite=mysqli_query($conn, "SELECT * FROM `favorite` WHERE id_user='$id_user'");
                $cek_favorite = mysqli_num_rows($query_favorite);
                if($cek_favorite != 0){
                    foreach($query_favorite as $row_favorite){
                        $id_produk = $row_favorite['id_produk'];
                        $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");
                        foreach($query_produk as $row){
                        $nama = $row['nama'];
                        $getGambar = $row['gambar'];
                        $arr_gambar = explode (",",$getGambar);
                        $gambar = $arr_gambar[0];
                        echo '
                        <a href="lihat?p='.$id_produk.'" class="text-decoration-none">
                        <div class="box-pesanan default_box">
                            <div class="row">
                                <div class="col-2 pe-0">
                                    <div class="wrap_img_pesanan skeleton">
                                        <img loading="lazy"
                                            src="img_produk/'.$gambar.'" alt="">
                                    </div>
                                </div>
                                <div class="col-8 box-title-keranjang ps-3">
                                    <span class="card-text">'.$nama.'</span>
                                </div>
                                <div class="col-2 favorite">
                                    <i class="fa fa-heart fs-2 lh-lg" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        </a>
                        ';
                        }
                    }
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

    $( "#form" ).submit(function( event ) {
            $(".loader").show();
            var data = $('#form').serialize();
            $.ajax({
            type: 'POST',
            url: "proses/user.php",
            data: data,

            cache: false,
            success: function (data) {
                $(".loader").hide();
            }
        });
    });
</script>