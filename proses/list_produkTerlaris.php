<?php
require_once '../kredensial/koneksi.php';
require_once 'singkat_angka.php';

$query="SELECT * FROM produk ORDER BY terjual DESC LIMIT 10";
$result=mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){
    $terjual = $row['terjual'];
    $getGambar = $row['gambar'];
    $arr_gambar = explode (",",$getGambar);
    $gambar = $arr_gambar[0];
    $harga = $row['harga'];
    $diskon = $row['diskon'];
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
    <div class="swiper-slide">
        <a href="lihat?p=<?= $row['id_produk'] ?>" class="col-12 text-decoration-none">
            <div class="card">
                <div class="box-card-img">
                    <img src="img_produk/<?= $gambar ?>"
                        loading="lazy" class="card-img-top card-img skeleton" alt="<?= $row['nama'] ?>">
                </div>
                <div class="card-body">
                    <span class="card-text"><?= $row['nama'] ?></span>
                    <div class="row mb-1">
                        <div class="col-12 mb-1">
                            <?php if($diskon != 0){
                                echo '<h6 class="fw-300 discount"><span>'.$diskon.'%</span><s>Rp'.$format_harga_asli.'</s></h6>';
                            }?>
                            <span class="fw-bold color">
                                <span class="rp">Rp</span><?= $format_harga ?>-,
                            </span>
                        </div>
                        <div class="col-6 pe-0">
                            <span class="text-catatan"><?= singkat_angka($terjual); ?> terjual</span>
                        </div>
                        <div class="col-6 ps-0">
                            <div class="rating float-end">
                                <i class="bi bi-star-fill bintang"></i>
                                <span><?= $row['rating'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php
};
?>