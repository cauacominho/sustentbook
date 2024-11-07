-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/11/2024 às 02:29
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sustentbook`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `access` enum('simple','author','admin','') NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `token`, `access`, `name`, `email`, `phone`, `password`, `img`) VALUES
(1, '10720be8a8312d0534a88c432a42d1ff', 'author', 'Heloizy Azevedo', 'heloizyazevedo@hotmail.com', '(19) 98308-2452', '$2y$10$DQL4B8cOVN1ZBIw5oUIed.1PnZ3IZmVa7MqLfi4UMis8gS7elxu.m', ''),
(2, '742f2fac929eb06c307da19a8b9ed39b', 'admin', 'Cauã Cominho Barbosa', 'cauacominho@gmail.com', '(19) 99928-6074', '$2y$10$clbzZQXsWOrD.71JfwkpRehdAAt/pC/5vU2GGn54u96asmsr4faVO', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
