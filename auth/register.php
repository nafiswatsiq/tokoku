<?php
session_start();
require_once '../kredensial/koneksi.php';
require_once '../proses/randGenerate.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$noHp = $_POST['noHp'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$kodePos = $_POST['kodePos'];
$detailAlamat = $_POST['detailAlamat'];

$query_user = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$email'");
$cek = mysqli_num_rows($query_user);
if($cek > 0){
    header('location: ../register?m=1');
}else{
    $enpw = password_hash($password, PASSWORD_DEFAULT);

    $id_user = generate_string($permitted_chars, 7);

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

    $result=mysqli_query($conn, "INSERT INTO `user`(`id`, `id_user`, `nama`, `username`, `password`, `email`, `noHp`, `alamat`, `kodePos`) VALUES ('','$id_user','$nama','$username','$enpw','$email','$noHp','$alamat','$kodePos')");
                                 
    if($result){
        $_SESSION['id_user']  = $id_user;
        setcookie('TID', $id_user, strtotime('+1 year'), '/');
        header('location: ../');
    }else{
        header('location: ../register');
    }
}
?>