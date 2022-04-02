<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';
$tgl = date("d-m-Y");

if(isset($_POST['idprod'])){
    $id_produk = $_POST['idprod'];

    $query_favorite=mysqli_query($conn, "SELECT * FROM `favorite` WHERE id_user='$id_user' AND id_produk=$id_produk");
    $cek_favorite = mysqli_num_rows($query_favorite);
    if($cek_favorite == 0){
        $addFavorite = "INSERT INTO `favorite`(`id`, `id_user`, `id_produk`) VALUES ('','$id_user','$id_produk')";
    }else{
        $addFavorite = "DELETE FROM `favorite` WHERE id_user='$id_user' AND id_produk=$id_produk";
    }
    $favorite=mysqli_query($conn, $addFavorite);
    if($favorite){
        echo "berhasil";
    }else{
        echo "gagal";
    }
}else{
    header('location: ../');
}
?>