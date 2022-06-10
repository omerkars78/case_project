-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 10 Haz 2022, 19:54:01
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `case_project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_time`) VALUES
(1, 'root', 'omer123456@gmail.com', '$2y$10$YSFIfHGpfkY/B0iBF.LVned79MklY92WLvrG2YkzXXARLKm3R9QXi', '2022-06-08 15:13:44'),
(2, 'omerkars77_', 'omer@gmail.com', '$2y$10$HKnyzW4CGpdemceFlytbmOj2yeUQwuvzs2rpAqinus42xPMB6Q4YO', '2022-06-08 21:33:04'),
(3, 'mehmet_', 'mehmet@gmail.com', '$2y$10$f7w9Sy1rbq2uW1wIaFSN1ODAIrVYC3NEFNwRFMivAKb9hH62R9bvq', '2022-06-08 21:45:10'),
(4, 'osman_9', 'sengul@gmail.com', '$2y$10$CKZywHI0p50Zo9CVsC3Rte8U8DcFS5chCpHJjxjlXJ72B2Z.OGn56', '2022-06-08 21:54:35'),
(5, 'osman_8', 'sengul1@gmail.com', '$2y$10$6xQo5WdCeedL4RdsFR78Iu1.j9FYk.qsjLQ4OlfJHmQI.2z/r.HsW', '2022-06-08 21:57:11'),
(6, 'omerkars74_', 'mng@gm.com', '$2y$10$5oZKNo3p9Os7YoR4s.rm/OA0VxHLkbjpXjHDzrgkmkqJIrZjclDm2', '2022-06-08 21:59:19'),
(7, 'omerkars73_', 'mnag@gm.com', '$2y$10$b4ai7BRNdEwi5BKXnwEXZODc7c3lVjfalpmM024Twfu0zGSGM/qvm', '2022-06-08 22:00:00'),
(8, 'alium_98', 'alium_98@gmail.com', '$2y$10$CJjb3s8aHcumHFphq1RwK.iWXlO5sc1L7br2VKvqfNlUiqDPnTflG', '2022-06-09 09:57:19'),
(9, 'omerkars_12', 'omerkars_12@gmail.com', '$2y$10$qZhR5LL31zH9QwgLT.9M2eMXhbHavRq//j2r7Ko2vIYDO3vMVTh92', '2022-06-09 10:17:08'),
(13, 'merhaba123_', 'kkedmked_0@gmail.com', '$2y$10$5hcwdh.qfzLAE0wdaf0aluEsi/N.oWNsJFJnDm8hs1O752.xQqLXq', '2022-06-09 13:11:08'),
(15, 'furkananter22_', 'furkan@gmail.com', '$2y$10$qG5tecfQKzt/mdRCuEIoQeFYSN55t3buINsuYVEgQHQ9K/JEoUovm', '2022-06-10 22:24:40'),
(16, 'deneme1234_', 'deneme1234_@gmail.com', '$2y$10$lORqpxMJ7BxqSSeZLaRDmeU23T9sw5yRLVHJa2stMnqx5uSlhvqpS', '2022-06-10 22:25:38'),
(17, 'deneme123456_', 'deneme123456_@gmail.com', '$2y$10$r1nQho90fLn4ozKQx15lM.3icjnWMlq.m/XlxTdEmpO8infFMK6f6', '2022-06-10 22:27:43'),
(18, 'nedimmalik_12', 'nedimmalik_12@gmail.com', '$2y$10$24qOcM5YqL65A/0TK3KUN.LIB6V7.DqXWHH8unqu.0FYBCRoLdoB2', '2022-06-10 22:29:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
