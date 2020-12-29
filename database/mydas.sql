-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 28, 2020 lúc 04:51 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mydas`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activations`
--

CREATE TABLE `activations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `find_raw` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_cat_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `login_id`, `description`, `status`, `find_raw`, `contact_cat_id`, `created_at`, `updated_at`) VALUES
(6, 'BS khoa nội', 2, 'Mô tả bs khoa nội', 1, 'bs khoa noi mo ta bs khoa noi', 6, '2020-12-22 20:35:52', '2020-12-22 20:57:37'),
(7, 'BS khoa ngoại', 2, 'Mô tả bs khoa ngoại', 1, 'bs khoa ngoai mo ta bs khoa ngoai', 6, '2020-12-22 20:36:31', '2020-12-22 20:36:31'),
(9, 'BS khoa nội tim', 2, 'Mô tả bs khoa nội tim', 1, 'bs khoa noi tim mo ta bs khoa noi tim', 6, '2020-12-22 20:38:23', '2020-12-22 20:57:37'),
(10, 'BS khoa nội gan', 2, 'Mô tả bs khoa nội gan', 1, 'bs khoa noi gan mo ta bs khoa noi gan', 6, '2020-12-22 20:38:47', '2020-12-22 20:57:37'),
(11, 'BS khoa nội gan 1', 2, 'Mô tả bs khoa nội gan1', 1, 'bs khoa noi gan 1 mo ta bs khoa noi gan1', 6, '2020-12-22 20:39:21', '2020-12-22 20:39:21'),
(12, 'BS da liễu', 2, 'Mô tả bs da liễu', 1, 'bs da lieu mo ta bs da lieu', 6, '2020-12-22 20:39:40', '2020-12-22 20:39:40'),
(13, 'BS noi 2', 2, 'Mô tả noi 2', 1, 'bs noi 2 mo ta noi 2', 6, '2020-12-24 01:40:20', '2020-12-24 01:40:20'),
(14, 'BS noi 3', 2, 'BS noi 3', 1, 'bs noi 3 bs noi 3', 6, '2020-12-24 21:17:16', '2020-12-24 21:17:16'),
(15, '<script>BS noi 3</script>', 2, 'BS noi 3', 1, '<script>bs noi 3</script> bs noi 3', 6, '2020-12-25 02:44:32', '2020-12-25 02:44:32'),
(16, '&lt;script&gt;BS noi 3&lt;/script&gt;', 2, 'BS noi 3', 1, '<script>bs noi 3</script> bs noi 3', 6, '2020-12-25 02:48:06', '2020-12-25 02:48:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts_parent`
--

CREATE TABLE `contacts_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts_parent`
--

INSERT INTO `contacts_parent` (`id`, `child_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 6, 0, '2020-12-22 20:35:52', '2020-12-22 20:35:52'),
(2, 7, 0, '2020-12-22 20:36:31', '2020-12-22 20:36:31'),
(6, 12, 0, '2020-12-22 20:39:40', '2020-12-22 20:39:40'),
(7, 13, 6, '2020-12-24 01:40:20', '2020-12-24 01:40:20'),
(8, 14, 6, '2020-12-24 21:17:16', '2020-12-24 21:17:16'),
(9, 15, 6, '2020-12-25 02:44:32', '2020-12-25 02:44:32'),
(10, 16, 6, '2020-12-25 02:48:06', '2020-12-25 02:48:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_categories`
--

CREATE TABLE `contact_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_vi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `find_raw` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_categories`
--

INSERT INTO `contact_categories` (`id`, `name_vi`, `name_en`, `description`, `login_id`, `status`, `find_raw`, `created_at`, `updated_at`) VALUES
(2, 'BV Gò Vấp', NULL, NULL, 2, 1, 'bv go vap  ', '2020-12-22 01:10:10', '2020-12-22 19:23:26'),
(5, 'BV Tân Phú', NULL, NULL, 2, 1, 'bv tan phu  ', '2020-12-22 01:21:23', '2020-12-22 01:21:23'),
(6, 'Bác sĩ', NULL, NULL, 2, 1, 'bac si  ', '2020-12-22 01:28:42', '2020-12-22 19:35:07'),
(7, 'Y tá BV Gò Vấp', NULL, NULL, 2, 1, 'y ta bv go vap  ', '2020-12-22 01:30:43', '2020-12-22 19:35:30'),
(8, 'Bác sĩ nội khoa TQuát', NULL, NULL, 2, 1, 'bac si noi khoa tquat  ', '2020-12-22 21:48:24', '2020-12-22 21:48:24'),
(9, 'Bác sĩ nội khoa TQuát 2', NULL, NULL, 2, 1, 'bac si noi khoa tquat 2  ', '2020-12-24 01:08:35', '2020-12-24 01:08:35'),
(10, 'Bác sĩ nội khoa TQuát 3', NULL, NULL, 2, 1, 'bac si noi khoa tquat 3  ', '2020-12-24 21:11:11', '2020-12-24 21:11:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact_categories_parent`
--

CREATE TABLE `contact_categories_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact_categories_parent`
--

INSERT INTO `contact_categories_parent` (`id`, `child_id`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 2, 0, '2020-12-22 01:10:10', '2020-12-22 01:10:10'),
(3, 5, 0, '2020-12-22 01:21:23', '2020-12-22 01:21:23'),
(5, 6, 5, '2020-12-22 01:28:42', '2020-12-22 01:28:42'),
(9, 10, 8, '2020-12-24 21:11:11', '2020-12-24 21:11:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_10_230148_create_acl_tables', 1),
(4, '2019_08_13_033145_remove_unused_columns_in_users_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_12_15_072319_create_settings_table', 1),
(7, '2020_12_18_064024_edit_users_table', 2),
(8, '2020_12_17_081027_create_contact_categories_table', 3),
(9, '2020_12_21_070232_create_contacts_table', 3),
(10, '2020_12_21_081528_create_users_contact_table', 3),
(11, '2020_12_22_072918_create_contact_categories_parent', 3),
(12, '2020_12_23_031721_create_contacts_parent', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_users`
--

CREATE TABLE `role_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'activated_plugins', '[\"auth\",\"contact\"]', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `fullname` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 1,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate` tinyint(4) NOT NULL DEFAULT 0,
  `user_code` bigint(20) DEFAULT NULL,
  `fcode` int(11) DEFAULT NULL,
  `token_aff_sys` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL DEFAULT 1,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login`, `fullname`, `avatar`, `gender`, `phone`, `affiliate`, `user_code`, `fcode`, `token_aff_sys`, `status`, `level`, `logo`) VALUES
(1, 'duong@gmail.com', NULL, '$2y$10$sEImt7pDjXbDBWGstFO4yu/6XZ7BpBBbj0IwCAJWDjjio5vvBql4i', NULL, '2020-12-22 00:41:09', '2020-12-22 00:41:09', NULL, 'duong', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL),
(2, 'minhminh@gmail.com', NULL, '$2y$10$HI.q0JOI0dyumXC5lLJUi.6LSn17MCXahFQJMOJCOPBaUoRNZMW52', NULL, '2020-12-22 00:41:25', '2020-12-24 20:51:42', NULL, 'MinhMinh', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL),
(3, 'Mai@gmail.com', NULL, '$2y$10$0pl4O0IJrm8mtdjB3wfgYeBU4.BmK.hrxycT87BcQhK4tIPrVXPXi', NULL, '2020-12-24 00:15:30', '2020-12-24 00:15:30', NULL, 'Mai', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL),
(6, 'xuan@gmail.com', NULL, '$2y$10$ezyYqGKkNd.JV8BS1raJZeWYy7yTQEIKZyb.Z.HaVPih/XIJ1JLgO', NULL, '2020-12-24 20:45:15', '2020-12-24 20:45:15', NULL, 'Xuan', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL),
(7, 'trungduc74f1@gmail.com', NULL, '$2y$10$MiEX7drqPCioMEufqUQO2O019Kf8Wmbe9Gyh/OIKlUFx3j4P0klfC', NULL, '2020-12-27 19:39:30', '2020-12-27 19:39:30', NULL, 'Trung', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL),
(8, 'trungduc74f2@gmail.com', NULL, '$2y$10$INR4YAYCyjAK3aQ0AcMI2.mZlOj8CcowTvsl8RRV3YVIsF/aDTPKq', NULL, '2020-12-27 19:39:48', '2020-12-27 19:39:48', NULL, '1', NULL, 1, NULL, 0, NULL, NULL, NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_contact`
--

CREATE TABLE `users_contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `extra_phone` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_email` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `identify_card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_id` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `find_raw` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users_contact`
--

INSERT INTO `users_contact` (`id`, `login_id`, `contact_id`, `first_name`, `last_name`, `phone`, `status`, `extra_phone`, `email`, `extra_email`, `address`, `extra_address`, `birthday`, `identify_card_number`, `passport_number`, `district`, `city`, `state`, `zipcode`, `country`, `extra_id`, `find_raw`, `created_at`, `updated_at`) VALUES
(8, 2, 7, 'Tet', 'Tet', '1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tet tet 1', '2020-12-24 23:07:36', '2020-12-24 23:07:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `activations`
--
ALTER TABLE `activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activations_user_id_index` (`user_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_contact_cat_id_foreign` (`contact_cat_id`);

--
-- Chỉ mục cho bảng `contacts_parent`
--
ALTER TABLE `contacts_parent`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact_categories`
--
ALTER TABLE `contact_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contact_categories_parent`
--
ALTER TABLE `contact_categories_parent`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`),
  ADD KEY `roles_created_by_index` (`created_by`),
  ADD KEY `roles_updated_by_index` (`updated_by`);

--
-- Chỉ mục cho bảng `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_users_user_id_index` (`user_id`),
  ADD KEY `role_users_role_id_index` (`role_id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`fullname`);

--
-- Chỉ mục cho bảng `users_contact`
--
ALTER TABLE `users_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_contact_contact_id_foreign` (`contact_id`);

--
-- Chỉ mục cho bảng `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_meta_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `activations`
--
ALTER TABLE `activations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `contacts_parent`
--
ALTER TABLE `contacts_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `contact_categories`
--
ALTER TABLE `contact_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `contact_categories_parent`
--
ALTER TABLE `contact_categories_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users_contact`
--
ALTER TABLE `users_contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_contact_cat_id_foreign` FOREIGN KEY (`contact_cat_id`) REFERENCES `contact_categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users_contact`
--
ALTER TABLE `users_contact`
  ADD CONSTRAINT `users_contact_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
