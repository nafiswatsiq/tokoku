<?php
session_start();
require_once '../kredensial/koneksi.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query_login = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$username'");
    $cek = mysqli_num_rows($query_login);

    if($cek > 0){
        foreach ($query_login as $dt) :
            $id_user= $dt['id_user'];
            $nama   = $dt['nama'];
            $enpw   = $dt['password'];
        endforeach;
        if (password_verify($password, $enpw)) {
            $_SESSION['id_user']  = $id_user;
            setcookie('TID', $id_user, strtotime('+1 year'), '/');

            header('location: ../');
        } else {
            header('location: ../login?err=1');
        }
    } else{
        header('location: ../login?err=2');
    }
} else{
    header('location: ../login?err=3');
}
?>