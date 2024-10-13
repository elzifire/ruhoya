-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 07 Sep 2023 pada 11.55
-- Versi server: 8.0.32-0ubuntu0.22.04.2
-- Versi PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ruhoya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hoyas`
--

CREATE TABLE `hoyas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etymology` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `benefit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leaves` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flowers` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flower_buds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flower_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flower_colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shoots` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reproduction_system` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hoyas`
--

INSERT INTO `hoyas` (`id`, `name`, `local_name`, `author`, `origin`, `type_information`, `publication`, `publication_link`, `etymology`, `benefit`, `stem`, `leaves`, `flowers`, `flower_buds`, `flower_size`, `flower_colors`, `roots`, `shoots`, `reproduction_system`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hoya acanthominima', '-', 'Kloppenb., G.Mend. & Ferreras', 'Filipina, Provinsi Quenzo', '-', 'Hoya New 1(1): 22 (2013)', 'https://www.biodiversitylibrary.org/page/52628508', 'Acantho means spiny or spine-like, and minima means small.', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '2023-07-28 06:32:00', '2023-07-28 06:32:00', NULL),
(2, 'Hoya acicularis', '-', 'T.Green & Kloppenb.', 'Brunei Darussalam, Sabah', 'Lowland hill forests and in ultramafic hill forests from 0 - 600 m', 'Fraterna 15(4): 7 (2002)', 'https://www.biodiversitylibrary.org/page/53668345', 'Name means needlelike, referring to the leaf shape', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '2023-07-28 06:36:10', '2023-07-28 06:36:10', NULL),
(3, 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', 'lorem', '2023-08-24 09:34:07', '2023-08-24 09:34:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hoya_images`
--

CREATE TABLE `hoya_images` (
  `id` bigint UNSIGNED NOT NULL,
  `hoya_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hoya_images`
--

INSERT INTO `hoya_images` (`id`, `hoya_id`, `image`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'hoya/4qzBKPdf59zULtKuQDXXhMHmDAe24Mg12rqlQfep.jpg', 'Hoya acanthominima', '2023-07-28 06:32:00', '2023-07-28 06:32:00', NULL),
(2, 2, 'hoya/Dmk9CZVWupMBKXWZSWOC8YYhyQnFKdRCYzJksaMC.jpg', 'Hoya acicularis', '2023-07-28 06:36:10', '2023-07-28 06:36:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hoya_spreads`
--

CREATE TABLE `hoya_spreads` (
  `id` bigint UNSIGNED NOT NULL,
  `hoya_id` bigint UNSIGNED NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hoya_spreads`
--

INSERT INTO `hoya_spreads` (`id`, `hoya_id`, `latitude`, `longitude`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '14.031563624797974', '122.11344518147087', 'Filipna, Provinsi Quenzo', '2023-07-28 06:32:00', '2023-07-28 06:32:00', NULL),
(2, 2, '4.485546850017522', '114.60096480463508', 'Brunei Darussalam', '2023-07-28 06:36:10', '2023-07-28 06:36:10', NULL),
(3, 2, '5.437764643618272', '116.7323123464427', 'Sabah, Malaysia', '2023-07-28 06:36:10', '2023-07-28 06:36:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `insect_associations`
--

CREATE TABLE `insect_associations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `insect_associations`
--

INSERT INTO `insect_associations` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lebah dan Tawon', '2023-07-30 02:47:20', '2023-07-30 02:47:20', NULL),
(2, 'Kupu-Kupu', '2023-07-30 02:47:26', '2023-07-30 02:47:26', NULL),
(3, 'Kumbang', '2023-07-30 02:47:31', '2023-07-30 02:47:31', NULL),
(4, 'Semut', '2023-07-30 02:47:35', '2023-07-30 02:47:35', NULL),
(5, 'Serangga Kecil', '2023-07-30 02:47:39', '2023-07-30 02:47:39', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_07_21_024637_create_hoya_table', 1),
(6, '2023_07_21_025112_create_hoya_spread_table', 1),
(7, '2023_07_21_025820_create_hoya_photos_table', 1),
(8, '2023_07_21_025912_create_pests_table', 1),
(9, '2023_07_21_025923_create_insect_associations_table', 1),
(12, '2023_07_27_124833_create_sliders_table', 2),
(13, '2023_07_27_124839_create_teams_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pests`
--

CREATE TABLE `pests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pests`
--

INSERT INTO `pests` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kutu Daun', '2023-07-30 02:47:45', '2023-07-30 02:47:45', NULL),
(2, 'Ulat Grayak', '2023-07-30 02:47:50', '2023-07-30 02:47:50', NULL),
(3, 'Jamur Daun', '2023-07-30 02:47:55', '2023-07-30 02:47:55', NULL),
(4, 'Penyakit Busuk Akar', '2023-07-30 02:48:00', '2023-07-30 02:48:09', '2023-07-30 02:48:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mengungkap Pesona Hoya', 'Temukan keindahan alami tanaman Hoya melalui daun mengkilap dan bunga harum yang memikat, menginspirasi, dan memberikan ketenangan. Hoya, juga dikenal sebagai tanaman lilin, adalah genus tumbuhan yang terkenal karena keanggunan dan daya tariknya. Dengan ribuan spesies yang tersebar di berbagai wilayah tropis dan subtropis, Hoya telah memikat hati para pecinta tanaman di seluruh dunia.', 'sliders/z3S3mB83IMraL124z3o1wRHWZzRI0na5Bo4JBjnz.jpg', '2023-07-27 06:12:51', '2023-07-27 06:12:51', NULL),
(2, 'Tanaman Hias yang Menyimpan Pesona', 'Hoya, dengan daun mengkilap dan bunga harum, menghadirkan keajaiban alam  bentuk keindahan yang tak terlupakan. Tanaman ini adalah saksi hidup dari pesona alam,  sentuhan magis yang mampu memikat dan menginspirasi siapa pun yang melihatnya.', 'sliders/mtOnep3MaP3CWbFMxRNQQgsecPHHLApVKRXTNV03.jpg', '2023-07-27 06:14:02', '2023-07-27 06:14:02', NULL),
(3, 'Daun Mengkilap dan Bunga Memikat', 'Dari Daun Mengkilap Hingga Bunga yang Memikat: Hoya menawarkan daya tarik tak tertandingi melalui keindahan daun mengkilap dan bunga yang memikat hati. Saksikan keajaiban alam \r\nmempesona.', 'sliders/pExtTAaGI0JfzIYjLK5VPrUQy6cN7zMBRXWUbGih.jpg', '2023-07-27 06:14:43', '2023-07-27 06:14:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `teams`
--

INSERT INTO `teams` (`id`, `name`, `title`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Margot Robbie', 'Ahli Hortikultura', 'teams/ni5IozcEvHPE2iI3F1Ewx35AmHiNMeFIjvGNG3uO.jpg', '2023-07-27 06:16:58', '2023-07-27 06:16:58', NULL),
(2, 'Sidney Poitier', 'Ahli Agronomi', 'teams/4WZi6R2TJxSoJTkqdgnuVQlphmpC46PlDYx9uqnO.jpg', '2023-07-27 06:17:13', '2023-07-27 06:17:13', NULL),
(3, 'Brie Larson', 'Ahli Kehutanan', 'teams/edDsb6fLuZwmt8NInSCiVtA5F03YzvkzFGJLblFx.jpg', '2023-07-27 06:17:29', '2023-07-27 06:17:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '2023-07-22 07:16:23', '$2y$10$4Oci1clehjR3i8TJXzf7UObwfaEnEQmJIPBNQHxIkJiI7cVYFL0MO', 'GvltmgZkiQwQtHNATQO6eR5uUB5cpiizV9rLx0r4dTfbeOo0afG3ksF81W3k', '2023-07-22 07:16:23', '2023-07-22 07:16:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `hoyas`
--
ALTER TABLE `hoyas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hoya_images`
--
ALTER TABLE `hoya_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoya_images_hoya_id_foreign` (`hoya_id`);

--
-- Indeks untuk tabel `hoya_spreads`
--
ALTER TABLE `hoya_spreads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hoya_spreads_hoya_id_foreign` (`hoya_id`);

--
-- Indeks untuk tabel `insect_associations`
--
ALTER TABLE `insect_associations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pests`
--
ALTER TABLE `pests`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hoyas`
--
ALTER TABLE `hoyas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `hoya_images`
--
ALTER TABLE `hoya_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `hoya_spreads`
--
ALTER TABLE `hoya_spreads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `insect_associations`
--
ALTER TABLE `insect_associations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pests`
--
ALTER TABLE `pests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hoya_images`
--
ALTER TABLE `hoya_images`
  ADD CONSTRAINT `hoya_images_hoya_id_foreign` FOREIGN KEY (`hoya_id`) REFERENCES `hoyas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hoya_spreads`
--
ALTER TABLE `hoya_spreads`
  ADD CONSTRAINT `hoya_spreads_hoya_id_foreign` FOREIGN KEY (`hoya_id`) REFERENCES `hoyas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
