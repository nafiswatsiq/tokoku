<?php
require_once 'kredensial/koneksi.php';

$query="SELECT * FROM notifikasi ORDER BY id DESC";
$result=mysqli_query($conn, $query);
$jmlh_notif = mysqli_num_rows($result);
class notifikasi{
    // function notifikasi(){
    //     global $result;
    //     global $jmlh_notif;

    //     if($jmlh_notif != 0){
    //         while($row = mysqli_fetch_assoc($result)){
    //         echo '
    //         <a class="col-12 text-decoration-none">
    //             <div class="default_box">
    //                 <div class="row">
    //                     <div class="col-10">
    //                         <h5>'.$row['title'].'</h5>
    //                     </div>
    //                     <div class="col-2 text-end">
    //                         <i class="fa fa-info-circle" aria-hidden="true"></i>
    //                     </div>
    //                     <div class="col-12">
    //                         <span>'.$row['value'].'</span>
    //                     </div>
    //                 </div>
    //             </div>
    //         </a>
    //         ';
    //         }
    //     }else{
    //         echo 'Tidak ada notifikasi';
    //     }
    // }
    function jumlah_notif(){
        global $jmlh_notif;
        if($jmlh_notif > 9){
            echo '
            <div class="nav-cart-badge animate__animated animate__bounceIn animate__delay-05s fw-bold">
            9+
            </div>
            ';
        }else{
            echo '
            <div class="nav-cart-badge animate__animated animate__bounceIn animate__delay-05s fw-bold">'.$jmlh_notif.'</div>
            ';
        }
    }
}
?>