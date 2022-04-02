<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';

$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$kodePos = $_POST['kodePos'];
$detailAlamat = $_POST['detailAlamat'];

    function get_alamat($param1, $param2){
        $json = file_get_contents("../API-indonesia/api/$param1/$param2.json");
        $arr = json_decode($json, TRUE);
        return $arr['name'];
    }

    $provinsi = get_alamat('province', $provinsi);
    $kabupaten = get_alamat('regency', $kabupaten);
    $kecamatan = get_alamat('district', $kecamatan);
    $kelurahan = get_alamat('village', $kelurahan);
    
    $alamat = "$detailAlamat, $kelurahan, $kecamatan, $kabupaten - $provinsi";

    $updateAlamat = mysqli_query($conn, "UPDATE `user` SET `alamat`='$alamat',`kodePos`='$kodePos' WHERE id_user ='$id_user'");
     
?>