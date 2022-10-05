-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql306.epizy.com
-- Waktu pembuatan: 05 Okt 2022 pada 01.31
-- Versi server: 10.3.27-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_29414174_toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `favorite`
--

INSERT INTO `favorite` (`id`, `id_user`, `id_produk`) VALUES
(39, 'YkSoSiq', 16),
(40, 'Ntrm9OU', 11),
(44, 'Ntrm9OU', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `id_user`, `id_produk`, `jumlah`, `tgl`) VALUES
(208, 'XeGiij7', 7, 3, '04-12-2021'),
(209, 'XeGiij7', 6, 1, '04-12-2021'),
(289, 'YkSoSiq', 16, 2, '05-04-2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_pesanan`
--

CREATE TABLE `list_pesanan` (
  `id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_produk` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `harga_asli` varchar(500) NOT NULL,
  `totalHarga` int(11) NOT NULL,
  `pembayaran` varchar(50) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `list_pesanan`
--

INSERT INTO `list_pesanan` (`id`, `invoice`, `id_user`, `id_produk`, `jumlah`, `harga_asli`, `totalHarga`, `pembayaran`, `kurir`, `status`, `tgl`, `alamat`) VALUES
(75, '3811162903', 'Ntrm9OU', '16', '1', '675000', 675000, 'COD', 'Buat abangnya', 'Disiapkan', '04/01/2022', 'jl yang benar dan direstui alloh SWT, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(76, '5611881523', 'Ntrm9OU', '13', '1', '45000', 45000, 'COD', 'Anterin', 'Disiapkan', '23/03/2022', 'jl yang benar dan direstui alloh SWT, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(77, '5167131113', 'Ntrm9OU', '14', '1', '15000', 15000, 'COD', 'Anterin', 'Disiapkan', '23/03/2022', 'jl yang benar dan direstui alloh SWT, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(78, '3112701123', 'YkSoSiq', '15', '2', '20000', 40000, 'COD', 'Buat abangnya', 'Disiapkan', '02/04/2022', 'Jl agung, KADIPATEN, KRATON, KOTA YOGYAKARTA - DI YOGYAKARTA<br>kode POS [22222]'),
(79, '6514125351', 'Ntrm9OU', '10', '1', '35000', 35000, 'COD', 'Anterin', 'Disiapkan', '15/04/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(80, '6514125351', 'Ntrm9OU', '13', '1', '45000', 45000, 'COD', 'Anterin', 'Disiapkan', '15/04/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(81, '6514125351', 'Ntrm9OU', '15', '2', '20000', 40000, 'COD', 'Anterin', 'Disiapkan', '15/04/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(82, '2912781833', 'Ntrm9OU', '15', '10', '20000', 200000, 'COD', 'Ambil sendiri', 'Disiapkan', '14/05/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(83, '4161191111', 'Ntrm9OU', '16', '1', '675000', 675000, 'COD', 'Anterin', 'Disiapkan', '03/06/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(84, '4161191111', 'Ntrm9OU', '14', '2', '15000', 30000, 'COD', 'Anterin', 'Disiapkan', '03/06/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(85, '1391172111', 'Ntrm9OU', '11', '4', '22500', 90000, 'COD', 'Buat abangnya', 'Disiapkan', '17/06/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(86, '6111092701', 'Ntrm9OU', '11', '2', '22500', 45000, 'COD', 'Buat abangnya', 'Disiapkan', '21/07/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]'),
(87, '6111092701', 'Ntrm9OU', '14', '3', '15000', 45000, 'COD', 'Buat abangnya', 'Disiapkan', '21/07/2022', 'Jl ke pelaminan rt 20/22, SUMINGKIR, JERUKLEGI, KABUPATEN CILACAP - JAWA TENGAH<br>kode POS [53252]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `title`, `value`) VALUES
(1, 'notifikasi 1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A, sit! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad, alias!'),
(2, 'notifikasi 2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A, sit! Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad, alias!'),
(3, 'notif 3', 'ini notifikasi ke tiga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `harga` varchar(12) NOT NULL,
  `deskripsi` text NOT NULL,
  `rating` varchar(10) NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual` int(11) NOT NULL,
  `gambar` text NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `deskripsi`, `rating`, `stok`, `terjual`, `gambar`, `diskon`) VALUES
(5, 'Rapsodi jkt48', '50000', 'lorem ipsum sit dlor amet', '4.5', 11, 4052, 'hq720.webp,hqdefault (1).webp,hqdefault.webp', 50),
(6, 'iyod pesan terakhir', '100000', 'lorem pom pom', '4.7', 28, 32, 'hqdefault (1).webp,hqdefault.webp,hq720.webp', 0),
(7, 'produk 4', '200000', 'lorem lalalalaala', '4.9', 39, 21, 'hqdefault.webp,hq720.webp,hqdefault (1).webp', 25),
(8, 'Jerom', '75000', 'ga ada deskripsi woyyyy', '4.8', 43, 7, 'hq7200.webp', 100),
(9, 'Takut igtaf', '150000', 'hal yg sedang di alami bagi kelahiran tahun 2000', '5.0', 46, 4, 'takut.webp,takut 2.webp', 0),
(10, 'Dere rererere', '50000', 'lagu sans bingit', '4.8', 48, 2, 'berizik.webp,dere kota.webp', 30),
(11, 'Burger king salman', '25000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '4.5', 46, 4, 'burger_1.jpg,burger_2.jpg', 10),
(12, 'Fried Chicken Alaska', '15000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '4.7', 50, 0, 'fried_chicken_1.jpg,fried_chicken_2.jpg', 0),
(13, 'Nasi Goreng Krusty Krab ', '50000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '4.8', 47, 3, 'nasi_goreng_1.jpg,nasi_goreng_2.jpg', 10),
(14, 'Seblak Ceker Elang', '15000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '5.0', 44, 6, 'seblak_1.jpg,seblak_2.jpg,seblak_3.jpg', 0),
(15, 'Soto Lamongan', '20000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '4.9', 36, 14, 'soto_1.jpg,soto_2.jpg', 0),
(16, 'Steak Daging Sapi WAHYU A5', '750000', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod necessitatibus eveniet sapiente soluta! Quis quos quas animi? Velit reiciendis nesciunt neque ex temporibus obcaecati rem, corporis aut? Ut, consequuntur unde!', '4.8', 49, 1, 'steak_1.jpg,steak_2.jpg', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `noHp` varchar(13) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `kodePos` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_user`, `nama`, `username`, `password`, `email`, `noHp`, `alamat`, `kodePos`) VALUES
(13, 'Ntrm9OU', 'nafis watsiq', 'admin', '$2y$10$JyRYvqZTJzMU/QCofuc.2uKmCcOFxeuymLPXS15Xfctv3H5ZrK7cq', 'nafiswatsiq@gmail.com', '08523456978', 'Jl rahmatahalu asik, SIDAKAYA, CILACAP SELATAN, KABUPATEN CILACAP - JAWA TENGAH', '2222'),
(16, 'YkSoSiq', 'Nafis watsiq amrulloh', 'nafis', '$2y$10$I0XfX18Qz9.18OTadhSCduqhZrTJw9PYGFhoFn/xN5tRPELMe2s6u', 'nafis@gmail.com', '088525808', 'Hati hati dijalan, PONDOK PINANG, KEBAYORAN LAMA, KOTA JAKARTA SELATAN - DKI JAKARTA', '25803'),
(17, 'TMmosZw', 'Nafis watsiq amrulloh', 'nafiswatsiq', '$2y$10$FpQblbAUNc8AqJ/O2XiD/uM.ab96trq.2eMGA1pXkLbN0cjl.LsN6', 'amrullohnafis@gmail.com', '085725805258', 'Jl rahmatahalu RT 06/60, KALIBATA, PANCORAN, KOTA JAKARTA SELATAN - DKI JAKARTA', '2580'),
(18, 'sBkRrhQ', 'Fardan', 'FardanGANTENG', '$2y$10$br/ZfN3CfZYzLjeA/NG3HeUTngXA5DL1VjyNbczYYFKsyZ6jvV2lK', 'fardan98@gmail.com', '0822777746434', 'Jl. Jeruk, TUMANG, SIAK, KABUPATEN S I A K - RIAU', '54554');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `list_pesanan`
--
ALTER TABLE `list_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT untuk tabel `list_pesanan`
--
ALTER TABLE `list_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
