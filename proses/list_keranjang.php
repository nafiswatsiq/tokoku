<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';

$query=mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user='$id_user' ORDER BY id DESC");
$cek = mysqli_num_rows($query);
if($cek != 0){
    while($row_produk = mysqli_fetch_assoc($query)){
        $id_keranjang = $row_produk['id'];
        $id_produk = $row_produk['id_produk'];
        $jumlah = $row_produk['jumlah'];
        $query_produk=mysqli_query($conn, "SELECT * FROM produk WHERE id_produk=$id_produk");

        while($row = mysqli_fetch_assoc($query_produk)){
            $getGambar = $row['gambar'];
            $arr_gambar = explode (",",$getGambar);
            $gambar = $arr_gambar[0];
            // var_dump ($arr_gambar); untuk array semua gambar
            // hitung diskon
            $harga = $row['harga'];
            $diskon = $row['diskon'];
            // hitung diskon
            if($diskon != 0){
                $jumlah_diskon = $diskon / 100 * $harga;
                $result_harga = $harga - $jumlah_diskon;
            }else{
                $result_harga = $harga;
            }
            $harga_jadi = $result_harga * $jumlah;
            $format_harga = number_format($harga_jadi,0,',','.');
            ?>
            <div id="boxKeranjang_<?= $id_keranjang?>" class="row border border-radius-keranjang mb-2 animate__animated ">
                <a href="#" id="idProd_<?= $id_keranjang?>" class="col-11 text-decoration-none pe-1 box-produk-keranjang">
                    <div class="row">
                        <div class="col-3 p-0 box-img-keranjang skeleton">
                            <img src="img_produk/<?= $gambar ?>"
                                loading="lazy">
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-12 box-title-keranjang">
                                    <div class="row">
                                        <div class="col-10 pe-0">
                                            <span class="card-text"><?= $row['nama'] ?></span>
                                        </div>
                                        <div class="col-2 p-0 checkbox_keranjang">
                                            <input type="checkbox" name="id[]" class="checkboxes" value="<?= $id_keranjang?>" id="select">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <span class="fw-bold color"><span class="rp">Rp</span><?= $format_harga; ?>-,</span>
                                </div>
                                <div class="col-2 ps-1">
                                    <span class="x-beli-keranjang-page">x<?= $jumlah ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="delete-keranjang">
                    <form action="" method="get" id="delete_<?= $id_keranjang?>">
                        <input type="hidden" name="id" value="<?= $id_keranjang?>">
                        <button id="btnDel_<?= $id_keranjang?>" type="button">Hapus</button>
                    </form>
                </div>
                <div class="col-1 ps-1 pe-0 btn-right-keranjang">
                    <i class="bi bi-chevron-double-right" onclick="openDel('<?= $id_keranjang?>')"></i>
                </div>
            </div>
            <?php
        }
    }
}else{
    echo '
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
<script>
    // count Click
    var countChecked = function () {
        $(".keranjang-checkout").show();
        var n = $("#select:checked").length;
        $(".keranjang-checkout button").text(n + (n === 1 ? " " : " ") + " Checkout!");
        if (n == 0) {
            $(".keranjang-checkout").hide()
        }
    };
    countChecked();

    $("input[type=checkbox]").on("click", countChecked);
</script>