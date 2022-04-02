<?php
require_once '../kredensial/koneksi.php';

if(isset($_GET['id'])){
    $id_keranjang = $_GET['id'];
    $deleteKeranjang = mysqli_query($conn, "DELETE FROM `keranjang` WHERE id=$id_keranjang");
}else{
    header('location: ../');
}
?>