<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';
$tgl = date("d-m-Y");

if(isset($_POST['p'])){
    $id_produk = $_POST['p'];
    $jumlah = $_POST['jumlah'];

    $query_keranjang=mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user='$id_user' AND id_produk=$id_produk");
    $cek_keranjang = mysqli_num_rows($query_keranjang);
    if($cek_keranjang == 0){
        $cartUpdate = "INSERT INTO `keranjang`(`id`, `id_user`, `id_produk`, `jumlah`, `tgl`) VALUES ('','$id_user','$id_produk','$jumlah','$tgl')";
    }else{
        foreach($query_keranjang as $dt){
            $jumlah_sebelumnya = $dt['jumlah'];
        }
        $jumlah_keranjang = $jumlah_sebelumnya + $jumlah;
        $cartUpdate = "UPDATE `keranjang` SET `jumlah`='$jumlah_keranjang' WHERE id_user='$id_user' AND id_produk=$id_produk";
    }
    $cartInsert=mysqli_query($conn, $cartUpdate);
    if($cartInsert){
        echo "berhasil";
    }else{
        echo "gagal";
    }
}else{
    header('location: ../');
}
?>