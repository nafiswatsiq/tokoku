<?php
require_once 'kredensial/koneksi.php';
require_once "kredensial/user.php";

function getDetail(){
    global $inv;
    global $conn;
    $query_pesanan=mysqli_query($conn, "SELECT * FROM list_pesanan WHERE invoice=$inv");
    $cek = mysqli_num_rows($query_pesanan);
    if($cek != 0){
        while($row_pesanan = mysqli_fetch_assoc($query_pesanan)){
            $id_produk = $row_pesanan['id_produk'];
            $invoice = $row_pesanan['invoice'];
            $jumlah = $row_pesanan['jumlah'];
            $tanggal = $row_pesanan['tgl'];
            $kurir = $row_pesanan['kurir'];
            $pembayaran = $row_pesanan['pembayaran'];
            $alamat = $row_pesanan['alamat'];
            $status = $row_pesanan['status'];
            $harga_asli = $row_pesanan['harga_asli'];
            $harga = $row_pesanan['totalHarga'];

            $arr_idProduk[] = $id_produk;
            $arr_jumlah[] = $jumlah;
            $arr_harga[] = $harga_asli;
            $arr_harga_total[] = $harga;
        }
    }else{
        header('location: ../');
    }

    $getIdProduk = implode(",", $arr_idProduk);
    $getjumlah = implode(",", $arr_jumlah);
    $getharga = implode(",", $arr_harga);

    $totalHarga = array_sum($arr_harga_total);
    $format_harga = number_format($totalHarga,0,',','.');
    return array(
        'id_produk' => $getIdProduk,
        'jumlah' => $getjumlah,
        'harga' => $getharga,
        'total_harga' => $format_harga,
        'kurir' => $kurir,
        'pembayaran' => $pembayaran,
        'alamat' => $alamat,
        'status' => $status,
        'tanggal' => $tanggal,
    );
}
?>