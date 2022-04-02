<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/user.php';

$deleteUser = mysqli_query($conn, "DELETE FROM `user` WHERE id_user='$id_user'");
$deleteFavorite = mysqli_query($conn, "DELETE FROM `favorite` WHERE id_user='$id_user'");
$deletekeranjang = mysqli_query($conn, "DELETE FROM `keranjang` WHERE id_user='$id_user'");
if($deleteUser){
    session_start();
    session_unset();
    session_destroy();

    setcookie('TID', '', strtotime(''), '/');
    header('location: register');
}else{
    header('location: ../');
}
?>