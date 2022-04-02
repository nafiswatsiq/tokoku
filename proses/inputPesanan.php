<?php
require_once '../kredensial/koneksi.php';
require_once '../kredensial/user.php';

$tgl = date("d/m/Y");


$query="SELECT * FROM user WHERE id_user='$id_user'";
$result=mysqli_query($conn, $query);
foreach($result as $row_alamat){
    if($row_alamat['alamat'] != ""){
        $alamat = $row_alamat['alamat'].'<br>kode POS ['.$row_alamat['kodePos'].']';
    }else{
        $alamat = 'Kamu belum memasukan alamat';
    }
};

if(isset($_POST['idProduk'])){
    $id_keranjang = $_POST['idKeranjang'];
    $id_produk = $_POST['idProduk'];
    $jumlah = $_POST['jumlahBarang'];
    $hargaAsli = $_POST['hargaAsli'];
    $totalHarga = $_POST['jumlahTotal'];
    $pembayaran = $_POST['pembayaran'];
    $kurir = $_POST['kurir'];
    $invoice = $_POST['invoice'];

    $arr_idProduk = explode(",", $id_produk);
    $arr_jumlah = explode(",", $jumlah);
    $arr_harga_asli = explode(",", $hargaAsli);
    $arr_produk = array_combine($arr_idProduk,$arr_jumlah);
    $i = 0;
    foreach($arr_produk as $row_idProduk => $row_jumlah){
        $harga_asli = $arr_harga_asli[$i];
        $getProduk = mysqli_query($conn, "SELECT * FROM `produk` WHERE id_produk=$row_idProduk");
        while($row_produk = mysqli_fetch_assoc($getProduk)){
            if($row_produk['stok'] != 0){
                $getStok = $row_produk['stok'];
                $getTerjual = $row_produk['terjual'];
                $updateStok = $getStok - $row_jumlah;
                $updateTerjual = $getTerjual + $row_jumlah;

                $harga = $row_produk['harga'];
                $diskon = $row_produk['diskon'];
                // hitung diskon
                if($diskon != 0){
                    $jumlah_diskon = $diskon / 100 * $harga;
                    $result_harga = $harga - $jumlah_diskon;
                }else{
                    $result_harga = $harga;
                }
                $harga_jadi = $result_harga * $row_jumlah;

                // $inputPesanan = mysqli_query($conn, "INSERT INTO `list_pesanan`(`id`, `invoice`, `id_user`, `id_produk`, `jumlah`, `totalHarga`, `pembayaran`, `kurir`, `status`, `tgl`, `alamat`) VALUES ('','$invoice','$id_user','$row_idProduk','$row_jumlah','$harga_jadi','$pembayaran','$kurir','Packing','$tgl','$alamat')");
                $inputPesanan = mysqli_query($conn, "INSERT INTO `list_pesanan`(`id`, `invoice`, `id_user`, `id_produk`, `jumlah`, `harga_asli`, `totalHarga`, `pembayaran`, `kurir`, `status`, `tgl`, `alamat`) VALUES ('','$invoice','$id_user','$row_idProduk','$row_jumlah','$harga_asli','$harga_jadi','$pembayaran','$kurir','Disiapkan','$tgl','$alamat')");
            }else{
                echo 'habis';
            }
        }
        $i++;
    }
    if($inputPesanan){
        echo "berhasil";

        $updateStok = mysqli_query($conn, "UPDATE `produk` SET `stok`='$updateStok',`terjual`='$updateTerjual' WHERE id_produk=$row_idProduk");
        if($id_keranjang != ""){
            $arr_idKeranjang = explode(",", $id_keranjang);
                foreach($arr_idKeranjang as $row_idKeranjang){
                    $query_keranjang=mysqli_query($conn, "SELECT * FROM keranjang WHERE id=$row_idKeranjang");
                    while($row_keranjang = mysqli_fetch_assoc($query_keranjang)){
                        $id = $row_keranjang['id'];
                        $delete = mysqli_query($conn, "DELETE FROM `keranjang` WHERE id=$id");
                    };
                }
        }
    }else{
        echo "gagal";
    }
}
?>
