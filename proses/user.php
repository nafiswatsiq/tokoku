<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';

$tgl = date("d-m-Y");

$query="SELECT * FROM user WHERE id_user='$id_user'";
$result=mysqli_query($conn, $query);

class user{
    function email(){
        global $result;

        foreach($result as $email){
            if($email['email'] != ""){
                echo $email['email'];
            }else{
                echo 'Kamu belum memasukan email';
            }
        };
    }
    function noHp(){
        global $result;

        foreach($result as $noHp){
            if($noHp['noHp'] != ""){
                echo $noHp['noHp'];
            }else{
                echo 'Kamu belum memasukan nomor handphone';
            }
        };
    }
    function alamat(){
        global $result;

        foreach($result as $alamat){
            if($alamat['alamat'] != ""){
                echo $alamat['alamat'].'<br>kode POS ['.$alamat['kodePos'].']';
            }else{
                echo 'Kamu belum memasukan alamat';
            }
        };
    }
};

if(isset($_POST['noHp'])){
    $noHp = $_POST['noHp'];
    $noHpUpdate = mysqli_query($conn, "UPDATE `user` SET `noHp`='$noHp' WHERE id_user ='$id_user'");
};
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $noHpUpdate = mysqli_query($conn, "UPDATE `user` SET `email`='$email' WHERE id_user ='$id_user'");
};
?>