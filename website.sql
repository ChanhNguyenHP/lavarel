-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 20, 2026 lúc 07:32 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_products`
--

CREATE TABLE `categories_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_products`
--

INSERT INTO `categories_products` (`id`, `name`, `parent_id`, `show`, `created_at`, `updated_at`) VALUES
(1, 'Phá lấu bò', 0, 1, '2026-03-19 00:22:40', '2026-03-19 20:30:48'),
(2, 'Nước uống', 0, 1, '2026-03-19 00:38:26', '2026-03-19 00:38:26'),
(3, 'Lẩu bò', 0, 1, '2026-03-19 00:38:36', '2026-03-19 00:38:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_25_075324_create_personal_access_tokens_table', 2),
(5, '2025_12_26_031519_create_products_table', 3),
(6, '2025_12_26_042617_create_orders_table', 4),
(7, '2025_12_26_042724_create_order_items_table', 4),
(8, '2025_12_26_082836_add_user_id_to_orders_table', 5),
(9, '2026_03_19_041826_add_image_to_products_table', 6),
(10, '2026_03_19_061745_create_categories_products_table', 7),
(11, '2026_03_19_074523_add_show_category_id_to_products_table', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(9, 1, 'ORD-11111', 80000.00, 'pending', '2026-03-19 22:00:30', '2026-03-19 22:00:30'),
(13, 1, 'ORD-1773982981', 595000.00, 'pending', '2026-03-19 22:03:01', '2026-03-19 22:03:01'),
(14, 1, 'ORD-1773983296', 125000.00, 'pending', '2026-03-19 22:08:16', '2026-03-19 22:08:16'),
(15, 1, 'ORD-1773983395', 16000.00, 'pending', '2026-03-19 22:09:55', '2026-03-19 22:09:55'),
(16, 1, 'ORD-1773983438', 180000.00, 'pending', '2026-03-19 22:10:38', '2026-03-19 22:10:38'),
(17, 1, 'ORD-1773984805', 51000.00, 'pending', '2026-03-19 22:33:25', '2026-03-19 22:33:25'),
(18, 1, 'ORD-1773984999', 60000.00, 'pending', '2026-03-19 22:36:39', '2026-03-19 22:36:39'),
(19, 1, 'ORD-1773985025', 125000.00, 'pending', '2026-03-19 22:37:05', '2026-03-19 22:37:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(16, 9, 22, 'sữa đào', 45000.00, 1, 45000.00, '2026-03-19 22:00:30', '2026-03-19 22:00:30'),
(17, 9, 23, 'hồng trà đào', 35000.00, 1, 35000.00, '2026-03-19 22:00:30', '2026-03-19 22:00:30'),
(18, 13, 13, 'phá lấu bò mì nước', 55000.00, 1, 55000.00, '2026-03-19 22:03:01', '2026-03-19 22:03:01'),
(19, 13, 14, 'phá lấu bò 1 kg', 540000.00, 1, 540000.00, '2026-03-19 22:03:01', '2026-03-19 22:03:01'),
(20, 14, 12, 'phá lấu bò mì nước lớn', 70000.00, 1, 70000.00, '2026-03-19 22:08:16', '2026-03-19 22:08:16'),
(21, 14, 13, 'phá lấu bò mì nước', 55000.00, 1, 55000.00, '2026-03-19 22:08:16', '2026-03-19 22:08:16'),
(22, 15, 18, 'mì gói không', 10000.00, 1, 10000.00, '2026-03-19 22:09:55', '2026-03-19 22:09:55'),
(23, 15, 19, 'bánh mì không', 6000.00, 1, 6000.00, '2026-03-19 22:09:55', '2026-03-19 22:09:55'),
(24, 16, 21, 'sữa dâu tằm', 45000.00, 3, 135000.00, '2026-03-19 22:10:38', '2026-03-19 22:10:38'),
(25, 16, 22, 'sữa đào', 45000.00, 1, 45000.00, '2026-03-19 22:10:38', '2026-03-19 22:10:38'),
(26, 17, 17, 'phá lấu bò chén nước', 45000.00, 1, 45000.00, '2026-03-19 22:33:25', '2026-03-19 22:33:25'),
(27, 17, 19, 'bánh mì không', 6000.00, 1, 6000.00, '2026-03-19 22:33:25', '2026-03-19 22:33:25'),
(28, 18, 19, 'bánh mì không', 6000.00, 10, 60000.00, '2026-03-19 22:36:39', '2026-03-19 22:36:39'),
(29, 19, 12, 'phá lấu bò mì nước lớn', 70000.00, 1, 70000.00, '2026-03-19 22:37:05', '2026-03-19 22:37:05'),
(30, 19, 13, 'phá lấu bò mì nước', 55000.00, 1, 55000.00, '2026-03-19 22:37:05', '2026-03-19 22:37:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 8, 'mobile_token', '5cb3bbbf4b3ea31418f1991b2a8f19b740e58dd8ea4a72fa6b6dd4033748314e', '[\"*\"]', NULL, NULL, '2025-12-25 00:54:25', '2025-12-25 00:54:25'),
(2, 'App\\Models\\User', 8, 'mobile_token', '15029f098d097b5a2071c0d2dddd1c0b5af45ed2a38cb38df9b8fe5cda87815b', '[\"*\"]', NULL, NULL, '2025-12-25 01:10:34', '2025-12-25 01:10:34'),
(3, 'App\\Models\\User', 8, 'mobile_token', '1a4f3c3635ea810749d0e9d0dc795ca7a1962944e74957253fb892d2f06fda9f', '[\"*\"]', NULL, NULL, '2025-12-25 01:40:12', '2025-12-25 01:40:12'),
(4, 'App\\Models\\User', 8, 'mobile_token', 'fa7eda80c7d8db2089076c2d86aecf12a1a44255d2a10399424f47e8339cb592', '[\"*\"]', NULL, NULL, '2025-12-25 01:42:08', '2025-12-25 01:42:08'),
(5, 'App\\Models\\User', 8, 'mobile_token', '7590b03bc22c7adf99995574fd091b06268056ebf641f48ba8791f548b9efab9', '[\"*\"]', NULL, NULL, '2025-12-25 01:50:18', '2025-12-25 01:50:18'),
(6, 'App\\Models\\User', 8, 'mobile_token', '127dd9b576b1cc923f4d2ea1c657355d3ab37a869e232b743aef37a7c35880d6', '[\"*\"]', NULL, NULL, '2025-12-25 02:03:12', '2025-12-25 02:03:12'),
(7, 'App\\Models\\User', 9, 'mobile_token', 'daf9afdd5b20c39371c238b0f1869e002f6c054091d2e21fa1c61b6db9110801', '[\"*\"]', NULL, NULL, '2025-12-25 02:04:41', '2025-12-25 02:04:41'),
(8, 'App\\Models\\User', 9, 'mobile_token', '729c952cb0cfe4067f589f9c9aa81fe7273e658a8b8555780f5a4267f62be52e', '[\"*\"]', NULL, NULL, '2025-12-25 02:15:25', '2025-12-25 02:15:25'),
(9, 'App\\Models\\User', 9, 'mobile_token', 'c6d7cb671ea3a97e38653e40de2a169dd13a1f529849adc98fb213a52d536cd5', '[\"*\"]', NULL, NULL, '2025-12-25 02:16:15', '2025-12-25 02:16:15'),
(10, 'App\\Models\\User', 9, 'mobile_token', '16db3d7d763c45cebfbdad71049907c74ed054070a7a85991cba569a095f7fba', '[\"*\"]', NULL, NULL, '2025-12-25 02:29:33', '2025-12-25 02:29:33'),
(11, 'App\\Models\\User', 9, 'mobile_token', '28e5955f3598b88e1843864006e7c0e179805a2f11a29ff0ef3e1fee87dcb3ff', '[\"*\"]', NULL, NULL, '2025-12-25 02:44:26', '2025-12-25 02:44:26'),
(12, 'App\\Models\\User', 9, 'mobile_token', '1e342e22ac650be5da9fe3b1bec29b6393b1589e789d73d414fc3db1ebeb1829', '[\"*\"]', '2025-12-25 20:50:08', NULL, '2025-12-25 19:16:09', '2025-12-25 20:50:08'),
(13, 'App\\Models\\User', 10, 'mobile_token', '3d54145217fe1da7dde4e0077d4b010ee23712c62bde038e56c5b312b985da99', '[\"*\"]', '2025-12-26 19:48:38', NULL, '2025-12-25 21:03:36', '2025-12-26 19:48:38'),
(14, 'App\\Models\\User', 10, 'mobile_token', 'f7b7aa9564d367a0bd0d9018a99b41c574ba8bbec1a2beabce522d0bb158f3d6', '[\"*\"]', NULL, NULL, '2025-12-25 22:05:53', '2025-12-25 22:05:53'),
(15, 'App\\Models\\User', 10, 'mobile_token', 'e69fafa72f14db6d467a74f7c2ab44c5c68cbf2b7209b6cd6feeeb523cb72914', '[\"*\"]', '2026-03-18 02:35:14', NULL, '2025-12-25 22:05:57', '2026-03-18 02:35:14'),
(16, 'App\\Models\\User', 5, 'mobile_token', 'a9d2c6c3a9b1617f62d4da6bb7f9a7db7e758c15c17df0efcdc00886561eb012', '[\"*\"]', '2026-03-19 01:29:31', NULL, '2025-12-26 00:55:00', '2026-03-19 01:29:31'),
(17, 'App\\Models\\User', 7, 'mobile_token', '1409ac06d6a01d65f569384d2316a761d1acf3e44b6fc8e9b48aa62a0d2bb37d', '[\"*\"]', '2025-12-26 01:23:21', NULL, '2025-12-26 01:21:37', '2025-12-26 01:23:21'),
(18, 'App\\Models\\User', 8, 'mobile_token', 'b2e277780e7fe43db7403d9ac646e7e2eaae2355a4c0168568a19f61bcb9d4ce', '[\"*\"]', '2026-03-18 02:32:14', NULL, '2026-03-18 02:31:46', '2026-03-18 02:32:14'),
(19, 'App\\Models\\User', 7, 'mobile_token', 'b56c4dacf385a4b5ccfed64d780a32cd993ce925742b09cc1407eb259fccf17b', '[\"*\"]', '2026-03-19 01:29:24', NULL, '2026-03-18 02:35:44', '2026-03-19 01:29:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT 1,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `show`, `category_id`, `user_id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(12, 1, 1, 1111, 'phá lấu bò mì nước lớn', 'Mì nước lớn với thịt bò, rau thơm và gia vị đậm đà.', 70000.00, 'products/55XL2wwUMJGo4hPEQfvVfLJJC84H3KZYV3e4JFFZ.webp', '2026-03-19 20:15:02', '2026-03-19 20:15:02'),
(13, 1, 1, 1111, 'phá lấu bò mì nước', 'Mì nước thơm ngon, thịt bò mềm, rau thơm tươi mát.', 55000.00, 'products/TAHbeZxYxbWxiUKwBX82N9eps3oOM3wM1beD0MwK.webp', '2026-03-19 20:16:18', '2026-03-19 20:16:18'),
(14, 1, 1, 1111, 'phá lấu bò 1 kg', 'tặng kèm 3 ly trà tắc size vừa', 540000.00, 'products/NprM4tP4bdgTa57sEmcSMuOxoSkh3lDsrUkV76DI.webp', '2026-03-19 20:17:09', '2026-03-19 20:17:09'),
(15, 1, 1, 1111, 'phá lấu bò 1/2 kg', 'tặng kèm 2 ly trà tắc size vừa', 275000.00, 'products/yB6oV8NyiyOg5ZqyBHystJsuxPGGvSOWYWssQPEC.webp', '2026-03-19 20:17:58', '2026-03-19 20:17:58'),
(16, 1, 1, 1111, 'phá lấu bò xào rau muống lớn', 'xào bơ hành phi', 68000.00, 'products/U8hHT3rNfWCeNXLaEmBfslaciv1hpedt1vZP28Ij.webp', '2026-03-19 20:23:39', '2026-03-19 20:23:39'),
(17, 1, 1, 1111, 'phá lấu bò chén nước', 'chưa kèm bánh mì', 45000.00, 'products/Hcc0kl9mhnZ0ViecOCKFjbGPTmUezNVVZ4U9Q0aq.webp', '2026-03-19 20:24:20', '2026-03-19 20:24:20'),
(18, 1, 1, 1111, 'mì gói không', NULL, 10000.00, 'products/w3fdtmMd1v3T5YpH46EDPiuSPI2fSoP21K0TqcEg.webp', '2026-03-19 20:25:16', '2026-03-19 20:25:16'),
(19, 1, 1, 1111, 'bánh mì không', NULL, 6000.00, 'products/gRN1wJUYAyO1D6GL1LbqSgjduq2jw4NxEEOrK13r.webp', '2026-03-19 20:25:42', '2026-03-19 20:25:42'),
(20, 1, 2, 1111, 'trà tắc xí muội', 'Trà tắc mát lạnh, xí muội chua ngọt, kết hợp tinh tế.', 28000.00, 'products/x56ixTgDXCuFFLSjxVUTevgQmHUjfAifzsR7eeQl.webp', '2026-03-19 20:27:14', '2026-03-19 20:27:14'),
(21, 1, 2, 1111, 'sữa dâu tằm', 'Sữa dâu tằm thơm ngon, mát lạnh, hòa quyện vị ngọt tự nhiên.', 45000.00, 'products/1KdGhwDWd5xaFgu5NPMAEqJivdzvado7wFxbwMeU.webp', '2026-03-19 20:28:01', '2026-03-19 20:28:01'),
(22, 1, 2, 1111, 'sữa đào', 'Sữa thơm mát, vị ngọt nhẹ, kết hợp trái cây tươi ngon.', 45000.00, 'products/kj0vSpd8womeFQaDa1ZD8uvAsFoqIx95Va6gBfgO.webp', '2026-03-19 20:28:40', '2026-03-19 20:28:40'),
(23, 1, 2, 1111, 'hồng trà đào', 'Trà đào thơm mát, ngọt dịu, hòa quyện cùng hồng trà đậm đà.', 35000.00, 'products/1s2kFfJnMTwh9btGkmRz8rYhDnUHNbPVw4SIuc5o.webp', '2026-03-19 20:30:00', '2026-03-19 20:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@gmail.com', NULL, '$2y$12$OeAjsTf0FuNmz5oWlsosj.ffhE2NvynxcrpnvMd0RpAedwVC58zvG', NULL, '2025-12-25 00:20:36', '2025-12-25 00:20:36'),
(5, 'chanhnguyen', 'chanhnguyen@gmail.com', NULL, '$2y$12$N4Fw27lE3wYKNE1bofTrW.zSPvu4JylZtMZkBRVzMStnVV2pWLD9e', NULL, '2025-12-25 00:33:23', '2025-12-25 00:33:23'),
(7, 'chanhnguyen2', 'chanhnguyen2@gmail.com', NULL, '$2y$12$wQLW6L4uAV32IS5ZdgUuBeDwziHDXFPGetPMqQ8Ml9sg6Ra1L8dd6', NULL, '2025-12-25 00:36:25', '2025-12-25 00:36:25'),
(8, 'chanhnguyen3', 'chanhnguyen3@gmail.com', NULL, '$2y$12$LD6W9vm9aSGv6eQL0rXg2ui1vfS5J5oRwx7cXx.CjVEwmsYkk8bSe', NULL, '2025-12-25 00:54:25', '2025-12-25 00:54:25'),
(9, 'chanhnguyen4', 'chanhnguyen4@gmail.com', NULL, '$2y$12$in8vBSQ2TZmrUC8OzxrkbOpGaNtt2737CTQxPPubjcdtFkTLyDoDC', NULL, '2025-12-25 02:04:07', '2025-12-25 02:04:07'),
(10, 'admin', 'admin@gmail.com', NULL, '$2y$12$WnWcLZX6GO3HkpFihlqWPO3rgmlMxMGBsI0FO65aiUJSoc6Xp6dSS', NULL, '2025-12-25 21:00:12', '2025-12-25 21:00:12');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories_products`
--
ALTER TABLE `categories_products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories_products`
--
ALTER TABLE `categories_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
