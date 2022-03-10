-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Feb 2022 pada 01.04
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yfs53db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `cookie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `cookie`) VALUES
(1, 'admin', '$2y$10$pKGfQG2etJ5lDW06PZncIOqY94RJTioYG4oM4n0/Up.cUpnX5HkRO', 'jVVei3128F6bfusLMDAJrdm2gHFoNlkOP4Mr5OvYWsmBjq6Wh8tGcQyaZSUpEBQT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `img` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`id`, `img`, `url`) VALUES
(20, '1644145671298.png', '#'),
(21, '1644145682073.png', '#'),
(22, '1644145693101.png', '#');

-- --------------------------------------------------------

--
-- Struktur dari tabel `block_user`
--

CREATE TABLE `block_user` (
  `blocked_from` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `blocked_to` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `img` varchar(30) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `weight` int(11) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `slug`) VALUES
(6, 'Pakaian Pria', '1586527494296.png', 'pakaian-pria'),
(7, 'Pakaian Wanita', '1586527510434.png', 'pakaian-wanita'),
(11, 'Pakaian Anak', '1644144161540.png', 'pakaian-anak'),
(12, 'Aksesoris', '1644144177311.png', 'aksesoris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cod`
--

CREATE TABLE `cod` (
  `id` int(11) NOT NULL,
  `regency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cod`
--

INSERT INTO `cod` (`id`, `regency_id`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cost_delivery`
--

CREATE TABLE `cost_delivery` (
  `id` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cost_delivery`
--

INSERT INTO `cost_delivery` (`id`, `destination`, `price`) VALUES
(4, 126, 5000),
(5, 23, 20000),
(6, 468, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `email_send`
--

CREATE TABLE `email_send` (
  `id` int(11) NOT NULL,
  `mail_to` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `email_send`
--

INSERT INTO `email_send` (`id`, `mail_to`, `subject`, `message`) VALUES
(10, 23, 'Test email', '<p>Hai kami memiliki produk baru.</p><p>Yuk cek produk terbaru kami dan belanja segera.</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `page` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `footer`
--

INSERT INTO `footer` (`id`, `page`, `type`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 2, 2),
(4, 1, 1),
(5, 4, 1),
(6, 5, 1),
(7, 6, 2),
(8, 7, 2),
(9, 8, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `general`
--

CREATE TABLE `general` (
  `id` int(11) NOT NULL,
  `app_name` varchar(50) NOT NULL,
  `slogan` varchar(150) NOT NULL,
  `navbar_color` varchar(10) NOT NULL,
  `api_rajaongkir` varchar(70) NOT NULL,
  `host_mail` varchar(50) NOT NULL,
  `port_mail` varchar(10) NOT NULL,
  `crypto_smtp` varchar(20) NOT NULL,
  `account_gmail` varchar(50) NOT NULL,
  `pass_gmail` varchar(50) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `whatsappv2` varchar(20) NOT NULL,
  `email_contact` varchar(50) NOT NULL,
  `server_api_midtrans` varchar(150) NOT NULL,
  `client_api_midtrans` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `general`
--

INSERT INTO `general` (`id`, `app_name`, `slogan`, `navbar_color`, `api_rajaongkir`, `host_mail`, `port_mail`, `crypto_smtp`, `account_gmail`, `pass_gmail`, `whatsapp`, `whatsappv2`, `email_contact`, `server_api_midtrans`, `client_api_midtrans`) VALUES
(1, 'YF Store', 'Official Yakha Fashion Online Store', '#161ba1', 'cf55ee865d930f360c105975f4358412', 'ssl://smtp.gmail.com', '465', '', 'cs.yfstore@gmail.com', 'jakarta11290', '087824884140', '089627792753', 'cs.yfstore@gmail.com', 'SB-Mid-server-DtDh1xOOhQl8c_xC9Lfns3QW', 'SB-Mid-client-WfothEh0j4bJHgY1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `grosir`
--

CREATE TABLE `grosir` (
  `id` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `img_product`
--

CREATE TABLE `img_product` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `img_product`
--

INSERT INTO `img_product` (`id`, `id_product`, `img`) VALUES
(1, 22, '1589840767903.jpg'),
(2, 22, '1589840786550.jpg'),
(5, 22, '1589840836102.jpg'),
(7, 29, '1621436002940.jpg'),
(8, 8, '1621436022420.jpg'),
(9, 8, '1621436027602.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `invoice_code` varchar(10) NOT NULL,
  `label` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `province` int(11) NOT NULL,
  `regency` int(11) NOT NULL,
  `district` varchar(50) NOT NULL,
  `village` varchar(50) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `address` text NOT NULL,
  `courier` varchar(5) NOT NULL,
  `courier_service` varchar(70) NOT NULL,
  `ongkir` varchar(10) NOT NULL,
  `total_price` int(11) NOT NULL,
  `total_all` int(11) NOT NULL,
  `date_input` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `resi` varchar(30) NOT NULL,
  `pay_status` varchar(30) NOT NULL,
  `link_pay` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `user`, `invoice_code`, `label`, `name`, `email`, `telp`, `province`, `regency`, `district`, `village`, `zipcode`, `address`, `courier`, `courier_service`, `ongkir`, `total_price`, `total_all`, `date_input`, `status`, `resi`, `pay_status`, `link_pay`) VALUES
(70, 12, '1217059075', 'Rumah', 'Mukti', 'personal.mukti@gmail.com', '089627792753', 9, 126, 'Cilawu', 'Desakolot', 44181, 'Jl. Munjul, No. 25, Kp. Ladeura, RT.02/05', 'jne', 'CTC', '105000', 1425000, 1530000, '2022-02-06 18:14:35', 4, '123456789123456789', 'settlement', 'https://app.sandbox.midtrans.com/snap/v1/transactions/2490bc98-16c2-47ed-8089-812feb3bf00d/pdf'),
(71, 3, '312857878', 'sfgsf', 'sdfsdf', 'member@member.com', '123123123123', 9, 23, 'casd', 'asdasdasdas', 12345, 'dfdsfsdfsdfsdfsd', 'jne', 'OKE', '8000', 150000, 158000, '2022-02-16 20:57:58', 4, '156452254221', 'settlement', 'https://app.sandbox.midtrans.com/snap/v1/transactions/5ae2b9a0-ac33-4388-8169-4b3b546599e2/pdf'),
(72, 3, '312544492', 'asdasd', 'asdasd', 'member@member.com', '12312312', 3, 232, 'sadasd', 'asdasdas', 12313, 'sadasadasd', 'jne', 'OKE', '15000', 150000, 165000, '2022-02-19 18:51:32', 3, '298328728872', 'settlement', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `title`, `link`) VALUES
(1, 'Home', ''),
(2, 'Produk', ''),
(3, 'Testimoni', 'testimoni'),
(4, 'Kontak', 'contact');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `slug`) VALUES
(1, 'Tentang Kami', '<p>Kami adalah toko yang menyediakan berbagai kebutuhan fashion baik fashion wanita, pria, maupun anak-anak, serta berbagai aksesoris untuk pria dan wanita. Keberadaan kami adalah untuk memenuhi kebutuhan Anda terhadap dunia fashion. Toko kami senantiasa berupaya menghadirkan berbagai produk-produk yang up to date demi mendukung gaya trendy dan fashion masa kini. Kami mengucapkan terima kasih atas kepercayaan anda berbelanja di toko kami. Kepuasan Anda adalah prioritas tertinggi bagi kami, sehingga bukan hanya kualitas produk yang kami tawarkan, akan tetapi juga pelayanan terbaik yang kami berikan.&nbsp;</p><p>Dalam suasana pandemi yang membatasi kegiatan Anda, kami berusaha menghadirkan berbagai macam layanan seperti pemesanan online via sosial media hanya untuk menuntaskan visi kami untuk selalu melayani kebutuhan anda. Akan tetapi pelayanan yang kami lakukan masih jauh dari kesempurnaan, oleh sebab itu kami berusaha untuk meningkatkan pelayanan toko kami melalui kanal yang lebih global.</p><p>YF Store versi 5.3 merupakan toko online resmi Yakha Fashion yang dibangun untuk memenuhi kebutuhan fashion Anda. YF Store secara spesifik dibangun untuk menjembatani Anda untuk berbelanja di toko kami tanpa harus berkunjung dan melakukan kontak fisik. Setiap layanan yang disediakan didedikasikan untuk memuaskan Anda dalam dunia Fashion. Dengan dibangunnya YF Store, tidak menjadi alasan untuk tidak memprioritaskan seluruh pelanggan-pelanggan setia Yakha Fashion.</p><p>Atas seluruh upaya yang terkumpul serta tekad Owner yang bulat untuk membangun sistem pelayanan yang lebih baik lagi, YF Store dirancang dan dibangun dalam visi kesempurnaan semata-mata untuk para pelanggan setia Yakha Fashion. Kami menyadari bahwa sistem ini masih jauh dari kesempurnaan, akan tetapi kami akan selalu meningkatkan fitur-fitur sistem, produk-produk, serta pelayanan online kami melalui sistem YF Store versi selanjutnya. Tentunya untuk melaksanakan keinginan tersebut kami memerlukan kontribusi positif dari Anda untuk memberikan kritik, saran, serta masukan yang membangun agar kami dapat selalu meningkatkan kualitas sistem kami.</p><p>Akhir kata kami mengucapkan terima kasih kepada seluruh pihak yang turut berperan serta dalam pembangunan sistem kami. Tak lupa ucapan terima kasih dari kami yang paling utama bagi seluruh pelanggan setia Yakha Fashion. Kami ucapkan terima kasih atas kepercayaan Anda berbelanja di toko kami.</p><p>Salam hormat,</p><p><i><strong>Owner.</strong></i></p>', 'about'),
(2, 'Kontak Kami', '<p>Hubungi Tim Support Kami</p><p>&nbsp;</p><p><strong>Konsultan Penjualan</strong></p><p>Melayani kebutuhan Anda untuk seluruh kategori produk. Silakan hubungi 087824884140 atau email kami di cs.yfstore@gmail.com.</p><p>&nbsp;</p><p><strong>Kantor Pusat</strong><br>Perum Jayawaras Dream Land, Blok A3, RT.005/009, Kelurahan Jayawaras, Kec. Tarogong Kidul, Kab. Garut.</p><p>Hubungi Tim Support Kami</p><p>&nbsp;</p><p><strong>Layanan Klaim Garansi</strong></p><p>Untuk bantuan teknis dan klaim garansi produk, silakan hubungi 087824884140 atau email kami di cs.yfstore@gmail.com.</p><p>&nbsp;</p><p><strong>Layanan Pengembalian Barang &amp; Refund</strong></p><p>Jika produk yang diterima salah/cacat/rusak &amp; ingin mengurus pengembalian dana, untuk laporan dan bantuan dapat menghubungi kami email cs.yfstore@gmail.com.</p><p>&nbsp;</p><p><strong>Layanan Pelanggan</strong></p><p>Silakan berikan feedback atas pelayanan yang kurang berkenan dari tim kami. Tuliskan masukan Anda email cs.yfstore@gmail.com.</p><p>&nbsp;</p><p><strong>Status Pengiriman</strong></p><p>Untuk bantuan tracking status pesanan &amp; status pengiriman, silakan hubungi 087824884140 atau email kami di cs.yfstore@gmail.com.</p><p>&nbsp;</p><p><strong>Tidak Dapat Menemukan Tim yang Anda Cari?</strong></p><p>Anda dapat menghubungi kami email cs.yfstore@gmail.com.</p>', 'contact'),
(3, 'Testimoni', '<p>redirect page</p>', 'testimoni'),
(4, 'Kebijakan Privasi', '<p><strong>KEBIJAKAN PRIVASI SITUS DAN APLIKASI</strong></p><p>YF STORE memahami dan menghormati privasi Anda dan nilai hubungan kami dengan Anda. Kebijakan Privasi ini menjelaskan bagaimana YF STORE mengumpulkan, mengatur dan melindungi informasi Anda ketika Anda mengunjungi dan/atau menggunakan situs atau aplikasi YF STORE, bagaimana YF STORE menggunakan informasi dan kepada siapa YF STORE dapat berbagi. Kebijakan privasi ini juga memberitahu Anda bagaimana Anda dapat meminta YF STORE untuk mengakses atau mengubah informasi Anda serta menjawab pertanyaan Anda sehubungan dengan Kebijakan Privasi ini.<br>Kata-kata yang dimulai dengan huruf besar dalam Kebijakan Privacy ini mempunyai pengertian yang sama dengan Syarat dan Ketentuan penggunaan situs dan aplikasi YF STORE.</p><p>&nbsp;</p><p><strong>Informasi yang kami kumpulkan</strong></p><p>YF STORE dapat memperoleh dan mengumpulkan informasi dan/atau konten dari situs dan aplikasi yang Anda atau pengguna lain sambungkan atau disambungkan oleh situs atau aplikasi YF STORE dengan situs atau pengguna tertentu dan informasi dan/atau konten yang Anda berikan melalui penggunaan situs atau aplikasi YF STORE dan/atau pengisian Aplikasi.</p><p><br>Ketika Anda mengunjungi situs atau aplikasi YF STORE, YF STORE dapat mengumpulkan informasi apapun yang telah dipilih bisa terlihat oleh semua orang dan setiap informasi publik yang tersedia. Informasi ini dapat mencakup nama Anda, gambar profil, jenis kelamin, kota saat ini, hari lahir, email, jaringan, daftar teman, dan informasi-informasi Anda lainnya yang tersedia dalam jaringan. Selain itu, ketika Anda menggunakan aplikasi YF STORE, atau berinteraksi dengan alat terkait, widget atau plug-in, YF STORE dapat mengumpulkan informasi tertentu dengan cara otomatis, seperti cookies dan web beacon. Informasi yang YF STORE kumpulkan dengan cara ini termasuk alamat IP, perangkat pengenal unik, karakteristik perambah, karakteristik perangkat, sistem operasi, preferensi bahasa, URL, informasi tentang tindakan yang dilakukan, tanggal dan waktu kegiatan. Melalui metode pengumpulan otomatis ini, YF STORE mendapatkan informasi mengenai Anda. YF STORE mungkin menghubungkan unsur-unsur tertentu atas data yang telah dikumpulkan melalui sarana otomatis, seperti informasi browser Anda, dengan informasi lain yang diperoleh tentang Anda, misalnya, apakah Anda telah membuka email yang dikirimkan kepada Anda. YF STORE juga dapat menggunakan alat analisis pihak ketiga yang mengumpulkan informasi tentang lalu lintas pengunjung situs atau aplikasi YF STORE. Browser Anda mungkin memberitahu Anda ketika Anda menerima cookie jenis tertentu atau cara untuk membatasi atau menonaktifkan beberapa jenis cookies. Harap dicatat, bahwa tanpa cookie Anda mungkin tidak dapat menggunakan semua fitur dari situs atau aplikasi YF STORE.</p><p><br>Situs atau aplikasi YF STORE mungkin berisi link ke tempat pihak lain yang dapat dioperasikan oleh pihak lain tersebut yang mungkin tidak memiliki kebijakan privasi yang sama dengan YF STORE. YF STORE sangat menyarankan Anda untuk membaca dan mempelajari kebijakan privasi dan ketentuan-ketentuan pihak lain tersebut sebelum masuk atau menggunakannya. YF STORE tidak bertanggung jawab atas pengumpulan dan/atau penyebaran informasi pribadi Anda oleh pihak lain atau yang berkaitan dengan penggunaan media sosial seperti Facebook dan Twitter dan YF STORE dibebaskan dari segala akibat yang timbul atas penyebaran dan/atau penyalahgunaan informasi tersebut.</p><p>&nbsp;</p><p><strong>BAGAIMANA YF STORE MENGGUNAKAN INFORMASI</strong></p><p>YF STORE dapat menggunakan informasi Anda yang diperoleh untuk menyediakan produk dan layanan yang Anda minta, sebagai data riset atau berkomunikasi tentang dan/atau mengelola partisipasi Anda dalam survei atau undian atau kontes atau acara khusus lainnya yang diadakan oleh YF STORE, pengoperasian YF STORE, memberikan dukungan kepada Anda sebagai pengunjung dan/atau pengguna situs atau aplikasi YF STORE, merespon dan berkomunikasi dengan Anda mengenai permintaan Anda, pertanyaan dan/atau komentar Anda, membiarkan Anda untuk meninggalkan komentar di situs atau aplikasi YF STORE atau melalui media sosial lainnya, membangun dan mengelola Akun Anda, mengirimkan berita-berita dan/atau penawaran-penawaran yang berlaku bagi Anda selaku pengunjung dan penguna situs atau aplikasi YF STORE, untuk mengoperasikan, mengevaluasi dan meningkatkan bisnis YF STORE termasuk untuk mengembangkan produk dan layanan baru; untuk mengelola komunikasi YF STORE, menentukan efektifitas layanan, pemasaran dan periklanan situs atau aplikasi YF STORE, dan melakukan akutansi, audit, dan kegiatan YF STORE lainnya, melakukan analisis data termasuk pasar dan pencarian konsumen, analisis trend, keuangan, dan informasi pribadi, melaksanakan kerjasama dengan mitra YF STORE yang terkait dengan program-program yang diadakan oleh YF STORE, melindungi, mengidentifikasi, dan mencegah penipuan dan kegiatan kriminal lainnya, klaim dan kewajiban lainnya, membantu mendiagnosa masalah teknis dan layanan, untuk memelihara, mengoperasikan, atau mengelola situs atau aplikasi YF STOREyang dilakukan oleh YF STORE atau pihak lain yang ditentukan oleh YF STORE, mengidentifikasi pengguna situs atau aplikasi YF STORE, serta mengumpulkan informasi demografis tentang pengguna situs atau aplikasi YF STORE, untuk cara lain yang YF STORE beritahukan pada saat pengumpulan informasi.</p><p><br>YF STORE tidak akan menjual atau memberikan informasi pribadi Anda kepada pihak lain, kecuali seperti yang dijelaskan dalam kebijakan privasi ini. YF STORE akan berbagi informasi dengan afiliasi YF STORE atau pihak lain yang melakukan layanan berdasarkan petunjuk dari YF STORE. Pihak lain tersebut tidak diizinkan untuk menggunakan atau mengungkapkan informasi tersebut kecuali diperlukan untuk melakukan layanan atas nama YF STORE atau untuk mematuhi persyaratan hukum. YF STORE juga dapat berbagi informasi dengan pihak lain yang merupakan mitra YF STORE untuk menawarkan produk atau jasa yang mungkin menarik bagi Anda<br>YF STORE dapat mengungkapkan informasi jika dianggap perlu dalam kebijakan tunggal YF STORE, untuk mematuhi hukum yang berlaku, peraturan, proses hukum atau permintaan pemerintah, dan peraturan yang berlaku di YF STORE. Selain itu, YF STORE dapat mengungkapkan informasi ketika percaya, pengungkapan diperlukan atau wajib dilakukan untuk mencegah kerusakan fisik atau kerugian finansial atau hal lainnya sehubungan dengan dugaan atau terjadinya kegiatan ilegal. YF STORE juga berhak untuk mengungkapkan dan/atau mengalihkan informasi yang dimiliki apabila sebagian atau seluruh bisnis atau aset YF STORE dijual atau dialihkan.<br>YF STORE dapat menyimpan dan/atau memusnahkan informasi tentang Anda sesuai kebijakan yang berlaku atau jika diperlukan.</p><p>&nbsp;</p><p><strong>UPDATE KEBIJAKAN PRIVASI INI</strong></p><p>Kebijakan Privasi ini mungkin diperbarui secara berkala dan tanpa pemberitahuan sebelumnya kepada Anda untuk mencerminkan perubahan dalam praktik informasi pribadi. YF STORE akan menampilkan pemberitahuan di bagian info profil website untuk memberitahu Anda tentang perubahan terhadap Kebijakan Privasi dan menunjukkan di bagian atas Kebijakan saat ketika Kebijakan Privasi ini terakhir diperbarui. Kebijakan Privasi ini merupakan satu kesatuan dan menjadi bagian yang tidak terpisahkan dari Syarat dan Ketentuan Penggunaan situs dan aplikasi YF STORE.</p>', 'privacy-policy'),
(5, 'Syarat dan Ketentuan', '<h2><strong>SYARAT DAN KETENTUAN SITUS DAN APLIKASI</strong></h2><p>Selamat datang dan terima kasih telah mengunjungi situs/aplikasi YF-STORE. Silahkan membaca Syarat dan Ketentuan ini dengan seksama. Syarat dan Ketentuan ini mengatur akses, penelusuran, penggunaan, dan pembelian barang-barang yang ditawarkan atau dijual di www.YF-STORE.com kepada Anda. Dengan mengakses, menelusuri, dan menggunakan situs/aplikasi YF-STORE ini, berarti Anda telah membaca, mengerti, dan setuju untuk tunduk dan terikat pada Syarat dan Ketentuan ini, dan Anda juga setuju untuk tidak mempengaruhi, mengganggu, atau berusaha mempengaruhi atau mengganggu jalannya situs/aplikasi YF-STORE dengan cara apapun. Jika Anda tidak menyetujui salah satu, sebagian, atau seluruh isi Syarat dan Ketentuan ini, maka Anda tidak diperkenankan untuk mengakses, menelusuri atau menggunakan situs/aplikasi YF-STORE ini. Akses, penelusuran, dan penggunaan situs/aplikasi YF-STORE ini hanya untuk penggunaan pribadi Anda. Anda tidak diperkenankan untuk mendistribusikan, memodifikasi, menjual, atau mengirimkan apapun yang Anda akses dari situs/aplikasi YF-STORE ini, termasuk tetapi tidak terbatas pada teks, gambar, audio, dan video untuk keperluan bisnis, komersial, publik atau kepeluan non-personal lainnya.</p><p><br>Penggunaan konten situs/aplikasi YF-STORE, logo YF-STORE, merek layanan dan/atau merek dagang yang tidak sah dapat melanggar undang-undang hak kekayaan intelektual, hak cipta, merek, privasi, publisitas, hukum perdata dan pidana tertentu. Syarat dan Ketentuan ini termasuk hak kekayaan intelektual milik YF-STORE yang dilindungi hak cipta. Setiap penggunaan Syarat dan Ketentuan ini oleh pihak manapun, baik sebagian maupun seluruhnya, tidak diizinkan. Pelanggaran atas hak atas kekayaan intelektual YF-STORE ini dapat dikenakan tindakan atau sanksi berdasarkan ketentuan hukum yang berlaku.<br>Anda perlu mengunjungi halaman ini secara berkala untuk mengetahui setiap perubahan Syarat dan Ketentuan ini.</p><p>&nbsp;</p>', 'terms'),
(6, 'Cara Berbelanja', '<p>Anda bisa mengklik “Beli sekarang” di yf-store.com untuk membeli produk, atau Anda bisa menambahkan produk ke Favorit dahulu lalu menempatkan pesanan.</p><p><strong>1. Beli sekarang</strong></p><p>1.1 Jika Anda ingin membeli produk langsung ketika Anda melihatnya di Product Detail Page (gambar di bawah), Anda bisa mengklik “Beli sekarang” setelah Anda memilih atribut, jumlah, dll. dari produk tersebut.</p><p>&nbsp;</p><p>1.2 Setelah Anda mengkonfirmasi alamat pengiriman, informasi pesanan dan informasi lainnya, klik “Selanjutnya”.</p><p>&nbsp;</p><p>1.3 Anda bisa masuk ke “Keranjang”-“Pesanan Saya” dan melihat pesanan yang telah ditempatkan. Jika Anda sudah mengkonfirmasi jumlah dari pesanan tersebut, klik “Proses Pembayaran”.</p><p>&nbsp;</p><p>1.4 Selanjutnya anda akan diminta untuk mengisi detail pengiriman dan pemilihan jasa ekspedisi yang anda inginkan. Setelah semua informasi yang diminta terisi, silahkan klik bayar/checkout.</p><p>&nbsp;</p><p>1.5 Pilih metode pembayaran yang paling mudah anda lakukan. Tersedia berbagai metode pembayaran seperti Transfer Bank, Indomaret, Alfamart, juga metode pembayaran lain melalui e-wallet.</p><p>&nbsp;</p><p>1.6 Masuk ke halaman pembayaran dan bayarkan pesanan. Status pemesanan akan berubah menjadi “Telah dibayar”, yang artinya barang sedang menunggu dikirim oleh penjual.</p><p>&nbsp;</p><p>1.7 Setelah penjual berhasil mengirimkan barang, status pemesanan akan berubah menjadi “Telah dikirim”. Ketika anda menerima barang dan mengkonfirmasi, mohon klik “Konfirmasi Terima Pesanan”.</p><p>&nbsp;</p><p>1.6 Ketika status berubah ke \"Selesai\", maka berarti transaksi telah selesai.</p><p>&nbsp;</p><p>1.8 Setelah proses pembelian selesai, anda akan diminta untuk memberikan rating terhadap pelayanan toko kami. Berikan bintang dan ulasan untuk pelayanan kami sehingga kami bisa terus meningkatkan kualitas pelayanan kami dari waktu ke waktu.</p><p>&nbsp;</p><p><strong>Checkout beberapa produk yang telah ditambahkan ke Keranjang Belanja secara bersamaan</strong></p><p>Anda bisa menambahkan beberapa produk ke Keranjang Belanja dan membelinya secara bersamaan, lalu menempatkan pesanan dan membayar sekali sekaligus. Prosesnya sama seperti proses “Beli sekarang”.</p>', 'shopping-help'),
(7, 'Pengiriman Barang', '<ol><li>Pengiriman barang untuk setiap transaksi yang terjadi melalui Platform YF-Store menggunakan layanan pengiriman barang yang disediakan YF-Store atas kerjasama YF-Store dengan pihak jasa ekspedisi pengiriman barang resmi.</li><li>Pengguna memahami dan menyetujui bahwa segala bentuk peraturan terkait dengan syarat dan ketentuan pengiriman barang sepenuhnya ditentukan oleh pihak jasa ekspedisi pengiriman barang dan sepenuhnya menjadi tanggung jawab pihak jasa ekspedisi pengiriman barang.</li><li>YF-Store hanya berperan sebagai media perantara antara Pengguna dengan pihak jasa ekspedisi pengiriman barang.</li><li>Pengguna wajib memahami, menyetujui, serta mengikuti ketentuan-ketentuan pengiriman barang yang telah dibuat oleh pihak jasa ekspedisi pengiriman barang.</li><li>Pengiriman barang atas transaksi melalui sistem YF-Store&nbsp;menggunakan jasa ekspedisi pengiriman barang dilakukan dengan tujuan agar barang dapat dipantau melalui sistem YF-Store.</li><li>YF-Store wajib bertanggung jawab penuh atas barang yang dikirimnya.</li><li>Pengguna memahami dan menyetujui bahwa segala bentuk kerugian yang dapat timbul akibat kerusakan ataupun kehilangan pada barang, baik pada saat pengiriman barang tengah berlangsung maupun pada saat pengiriman barang telah selesai, adalah sepenuhnya tanggung jawab pihak jasa ekspedisi pengiriman barang.</li><li>Dalam hal diperlukan untuk dilakukan proses pengembalian barang, maka Pengguna (Pembeli), diwajibkan untuk melakukan pengiriman barang langsung pada Kami dengan menyertakan komplain terkait barang yang diterima. YF-Store&nbsp;tidak menerima pengembalian atau pengiriman barang atas transaksi yang dilakukan oleh Pengguna tanpa menyertakan bukti unboxing paket dan video yang menunjukan bahwa barang yang diterima dalam keadaan rusak.</li><li>Garansi yang kami berikan untuk seluruh produk yang kami jual adalah selama 10 hari terhitung sejak pemesanan dilakukan. Laporan cacat produk yang dilaporkan setelah masa garansi yang kami berikan tidak akan kami layani.</li></ol>', 'pengiriman-barang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_proof`
--

CREATE TABLE `payment_proof` (
  `id` int(11) NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `file` varchar(30) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts_rating`
--

CREATE TABLE `posts_rating` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `posts_rating`
--

INSERT INTO `posts_rating` (`id`, `userid`, `postid`, `rating`) VALUES
(5, 3, 312857878, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `condit` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date_submit` datetime NOT NULL,
  `publish` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `transaction` int(11) NOT NULL,
  `promo_price` int(11) NOT NULL,
  `viewer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `stock`, `category`, `condit`, `weight`, `img`, `description`, `date_submit`, `publish`, `slug`, `transaction`, `promo_price`, `viewer`) VALUES
(31, 'Zaila Dress', 95000, 0, 7, 1, 1000, '1644145029405.jpg', '<p>Zaila Dress desain modis untuk kamu pecinta gaya.</p>', '2022-02-06 17:57:09', 1, 'zaila-dress', 15, 0, 37),
(32, 'fdsewf', 150000, 10, 6, 1, 1000, '1644203402178.jpg', '<p>asdasds</p>', '2022-02-07 10:10:02', 1, 'fdsewf', 2, 0, 31);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_rating`
--

CREATE TABLE `product_rating` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id` int(11) NOT NULL,
  `rekening` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `promo` int(11) NOT NULL,
  `promo_time` varchar(40) NOT NULL,
  `short_desc` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `regency_id` int(11) NOT NULL,
  `verify` int(11) NOT NULL,
  `logo` varchar(30) NOT NULL,
  `favicon` varchar(30) NOT NULL,
  `default_ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `promo`, `promo_time`, `short_desc`, `address`, `regency_id`, `verify`, `logo`, `favicon`, `default_ongkir`) VALUES
(1, 0, '2020-08-08T08:08', 'Toko online resmi Yakha Fashion. Dapatkan penawaran dengan kualitas terbaik. Yakha Fashion hadir untuk memenuhi kebutuhan fashion Anda.', 'Perum Jayawaras Dream Land, Blok A3, RT.005/009, Kelurahan Jayawaras, Kec. Tarogong Kidul, Kab. Garu', 126, 1, '1644143133385.png', '1644143142941.png', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosmed`
--

CREATE TABLE `sosmed` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sosmed`
--

INSERT INTO `sosmed` (`id`, `name`, `icon`, `link`) VALUES
(1, 'Facebook', 'facebook-f', 'https://facebook.com/'),
(3, 'Twitter', 'twitter', 'https://twitter.com/'),
(5, 'Instagram', 'instagram', 'https://instagram.com/'),
(6, 'Youtube', 'youtube', 'https://youtube.com/'),
(7, 'Blog', 'blogger', 'https://www.google.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `submenu` int(11) NOT NULL,
  `link` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`id`, `name`, `submenu`, `link`) VALUES
(1, 'Pakaian Wanita', 2, 'c/pakaian-wanita'),
(2, 'Pakaian Pria', 2, 'c/pakaian-pria'),
(7, 'Pakaian Anak', 2, 'c/pakaian-anak'),
(10, 'Aksesoris', 2, 'c/aksesoris'),
(11, 'Jam Tangan', 2, 'c/jam-tangan'),
(12, 'Live Chat', 4, 'chat'),
(13, 'Info Kontak', 4, 'contact');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_subs` datetime NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `date_subs`, `code`) VALUES
(0, 'Semua Email', '2020-04-21 13:59:23', ''),
(23, 'personal.mukti@gmail.com', '2022-02-06 18:35:26', '16441473261676894499'),
(24, 'personal.mukti@gmail.com', '2022-02-07 15:35:29', '16442229291854822158'),
(25, 'personal.mukti@gmail.com', '2022-02-07 15:40:16', '16442232162056812940'),
(26, 'personal.mukti@gmail.com', '2022-02-07 15:45:27', '1644223527587866746'),
(27, 'member@member.com', '2022-02-07 16:23:01', '16442257811848911982');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `photo`, `content`) VALUES
(1, 'Aliyah Wati - Jakarta', '', 'Sist makasih barangnya udah sampe, bagus dan lucu2. Temenku aja pada ngiri. Semoga sukses selalu buat eveshopashopnya. Sory baru bisa kasih kabar.'),
(2, 'Een Enarsih - Banten', '', 'Sis barang ny dh sya trima,mkasih bnyak untuk layan’n ny sngat m’muaskan untuk sya,smu prtanya’n di jwab…\r\nRespon ny jga sngat baek,smoga usaha ny smakin brkembang'),
(3, 'Ayung Darma - Pekalongan', '', 'Oia mf sis,Nich brg nya brsan aja ampe, mksh ya\r\nBrg nya bgs banget, sesuai yg digambarnya, makasih ya'),
(4, 'Via Garolita - Cimahi', '', 'Sistaaaa……\r\nbaju nyaa udah smpee…\r\nbguss dechh…suka bgt…\r\nmaaksiih yaa'),
(5, 'Dewanti - Solo', '', 'Barang tidak mengecewakan.. cs nya fast respon, resi besoknya langsung di share tanpa kita tanya.. mantap tokohijabku'),
(6, 'Dina - Malang', '', 'Respon cs baik, tapi untuk pengirimannya agak lama, padahal pakai ekspedisi ”sicepat”\r\nharusnya bisa cepat sampainya.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `id_invoice`, `user`, `product_name`, `price`, `qty`, `slug`, `ket`, `img`) VALUES
(67, 1217059075, 12, 'Zaila Dress', 95000, 15, 'zaila-dress', '', '1644145029405.jpg'),
(68, 312857878, 3, 'fdsewf', 150000, 1, 'fdsewf', '', '1644203402178.jpg'),
(69, 312544492, 3, 'fdsewf', 150000, 1, 'fdsewf', '', '1644203402178.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(20) CHARACTER SET latin1 NOT NULL,
  `name` varchar(75) NOT NULL,
  `fname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lname` varchar(30) CHARACTER SET latin1 NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_register` datetime NOT NULL,
  `is_activate` int(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_reset` varchar(100) NOT NULL,
  `cookie` varchar(100) NOT NULL,
  `photo_profile` varchar(30) NOT NULL,
  `bio` varchar(100) CHARACTER SET latin1 NOT NULL,
  `dob` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dump` text NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_status` varchar(10) CHARACTER SET latin1 NOT NULL,
  `last_logout` varchar(30) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `unique_id`, `name`, `fname`, `lname`, `username`, `email`, `password`, `date_register`, `is_activate`, `token`, `token_reset`, `cookie`, `photo_profile`, `bio`, `dob`, `dump`, `phone`, `address`, `user_status`, `last_logout`) VALUES
(3, '932473', 'member name', 'member', 'yfstore', 'member-name', 'member@member.com', '$2y$10$NXwYRU5XfN3wkv3nu61T9uWAPPjsyBX9syQbnl4I/nI//OksC5mF.', '2022-02-07 16:23:01', 1, 'b9fd24b2b18eecb235ad74417cf4eca4c0de2d49', '', '', 'default.png', 'sdfsdfsdfsdf', '11-02-1990', 'member', '123123123', 'sfdfsdfdsf', 'deactive', '7/2/2022 16.56.41');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cod`
--
ALTER TABLE `cod`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cost_delivery`
--
ALTER TABLE `cost_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `email_send`
--
ALTER TABLE `email_send`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `grosir`
--
ALTER TABLE `grosir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `img_product`
--
ALTER TABLE `img_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment_proof`
--
ALTER TABLE `payment_proof`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posts_rating`
--
ALTER TABLE `posts_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `cod`
--
ALTER TABLE `cod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `cost_delivery`
--
ALTER TABLE `cost_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `email_send`
--
ALTER TABLE `email_send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `general`
--
ALTER TABLE `general`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `grosir`
--
ALTER TABLE `grosir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `img_product`
--
ALTER TABLE `img_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `payment_proof`
--
ALTER TABLE `payment_proof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `posts_rating`
--
ALTER TABLE `posts_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
