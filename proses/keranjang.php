<?php
require_once 'kredensial/koneksi.php';
require_once 'kredensial/user.php';
class keranjang{
    public function jmlh_keranjang(){
        global $conn;
        global $id_user;
        $query=mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user='$id_user'");
        $jmlh_keranjang = mysqli_num_rows($query);

        if($jmlh_keranjang > 9){
            echo '
            <div class="badge-keranjang animate__animated animate__bounceIn">
                            <span>9+</span></div>
            ';
        }elseif($jmlh_keranjang == 0){

        }else{
            echo '
            <div class="badge-keranjang animate__animated animate__bounceIn">
                            <span>'.$jmlh_keranjang.'</span></div>
            ';
        }

    }

    public function jmlh_keranjang_top(){
        global $conn;
        global $id_user;
        $query=mysqli_query($conn, "SELECT * FROM keranjang WHERE id_user='$id_user'");
        $jmlh_keranjang = mysqli_num_rows($query);

        if($jmlh_keranjang > 9){
            echo '
            <div class="badge-keranjang-top animate__animated animate__bounceIn text-center">
                <span>9+</span>
            </div>
            ';
        }elseif($jmlh_keranjang == 0){

        }else{
            echo '
            <div class="badge-keranjang-top animate__animated animate__bounceIn text-center">
                <span>'.$jmlh_keranjang.'</span>
            </div>
            ';
        }
    }
};
?>