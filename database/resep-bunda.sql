-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2020 pada 14.20
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resep-bunda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id_profile`, `nama_lengkap`, `alamat`, `no_hp`, `id_user`) VALUES
(1, 'Udin sedunia akhirat', 'Di indonesia tercinta yang kaya', '089877823372', 3),
(2, 'Ceilla', 'Indonesia', '098933874463', 4),
(3, 'Asep Sutisna', 'New york city', '098911212231', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `judul_resep` varchar(50) NOT NULL,
  `caption` text NOT NULL,
  `bahan` text NOT NULL,
  `langkah` text NOT NULL,
  `gambar` varchar(250) NOT NULL DEFAULT 'no-photo.jpg',
  `id_profile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `judul_resep`, `caption`, `bahan`, `langkah`, `gambar`, `id_profile`) VALUES
(1, 'Bolu vanila', 'Karena gabut dirumah, akhir nya saya buat bolu ini dan rasanya enak banget lohh', '250 gr tepung terigu| 4 butir telur| 250 gr gula pasir| 1/2 sdm tbm| 250 gr mentega| 1 bks vanila bubuk', 'Kocok dengan menggunakan mixer terlebih dahulu margarin,gula,vanili dan tbm sampai gula agak halus dan tercampur| Setelah itu masukan telur lalu kocok selama 15 menit hingga mengembang yah| Kemudian masukan sedikit demi sedikit terigu sampai adonan tercampur merata| Siapkan loyang yang sudah di olesi mentega dan diberi taburan tepung hingga merata,lalu tuangkan adonan| Kemudian beri coklat (cokie-cokie) melingkar langsung putar\" menggunakan tusukan hingga cantik atau bisa di beri topping lain nya| Lalu oven hingga matang,bolu siap disajikanðŸ¤—', 'photo_bolu vanilla.jpg', 1),
(3, 'Agar-agar Lumut', 'Hanya pengen makan yang seger-seger, bikin yang gampil. Dimakan pas udah keluar dari kulkas hmmmm ademðŸ˜ liat warna nya juga bikin adem.', 'Lapisan Hijau| 1 bungkus agar-agar (5 gr)| 1 bungkus santan instan (65 ml)| 1 butir kuning telur| 80 gr gula pasir| 500 ml air perasan pandan| Lapisan Merah Muda| 1 bungkus agar-agar| 75 ml susu kental manis cocopandan| 25 gr gula| 500 ml air', 'Siapkan semua bahan yah\r\n| Lapisan hijau : campur semua bahan untuk lapisan hijau, aduk rata. Kemudian masak hingga mendidih.| Tuang lapisan hijau pada cetakan yang sebelumnya sudah di basahi dengan air. Tunggu beberapa saat sebelum membuat lapisan merah muda. Karena kita nuang lapisan nya tunggu lapisan hijau nya sedikit mengeras.| Lapisan merah muda : campur semua bahan, aduk rata dan panaskan hingga mendidih.Tuang lapisan merah muda sedikit demi sedikit biar ga bikin kaget si lapisan hijau dan malah bikin bocorðŸ˜€ Saya pakai sendok makan.| Tunggu agak dingin sebelum di masukan kulkas. Setelah dingin agar-agar siap di nikmati. Tidak masuk kulkas juga tidak apa-apa, sesuai selera.| Oh ya... Untuk masing-masing warna saya tambahkan 1 tetes pewarna makan, biar warna nya makin terlihat, tapi sesuai selera ya tidak pakai pewarna tambahan juga ok.', 'photo_agar lumut.jpg', 1),
(4, 'Tumis Sawi Tempe', 'Request.nya pak suami nih. Langsung cuss buat dah. Bahanya simple banget guyss #PejuangGoldenApron3 #staysafe', '1/2 papan Tempe| 1 ikat Sawi Putih| 3 siung Bawang Merah| 2 siung Bawang Putih| 2 Cabe Rawit| 1/2 sdm Saori Saus Tiram| secukupnya Garam| secukupnya Lada| secukupnya Gula', 'Cuci bersih sawi putih & potong sesuai selera, potong tempe sesuai dengan selera kalian yaa. Lalu goreng tempe setengah matang. Sisihkan.| Potong cabe rawit, Cincang bawang merah & bawang putih.| Tumis bawang merah, bawang putih & cabe, setelah wangi masukkan sawi putih, tambahkan garam, gula, lada, selanjutnya masukkan tempe yg suda digoreng tadi, tambahkan saori, koreksi rasa. Siap disajikan.', 'photo_tumis sawi.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Ghp2ZSVdu/l2rdLIp.CYsOZCTlUYDHKfdJGI772ShT3AjJ9SbSv6e', 'admin'),
(3, 'udin', 'udin@gmail.com', '$2y$10$1p37/oXFeec7Dq2eDN6bIuGyVxq3i9YhCHuj/8BBwqWPGtCqwm9Hu', 'user'),
(4, 'ceilla', 'ceilla@gmail.com', '$2y$10$0ms/vH3Z.6EoR14dNZ1Oc.FgUTftHgaAD7oAe6OlYn9Xv/RmJRo.K', 'user'),
(5, 'asep', 'asep@gmail.com', '$2y$10$t6OC4FvHyeLW4rVMSplRdekZFjIiWHJRxXNmUHLCIdpAnFSnMq4r6', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `fk_users` (`id_user`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `fk_profile` (`id_profile`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `fk_profile` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id_profile`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
