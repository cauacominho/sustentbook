-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/11/2024 às 02:30
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
-- Estrutura para tabela `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `author` varchar(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `pages` int NOT NULL,
  `language` varchar(100) NOT NULL,
  `publisher` varchar(200) NOT NULL,
  `translated` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `cover_image` text NOT NULL,
  `other_images` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Despejando dados para a tabela `books`
--

INSERT INTO `books` (`id`, `author_id`, `author`, `title`, `synopsis`, `pages`, `language`, `publisher`, `translated`, `value`, `cover_image`, `other_images`, `date`) VALUES
(1, 1, 'Heloizy Azevedo', 'O homem mais rico da Babilônia', 'Com mais de dois milhões de exemplares vendidos no mundo todo, O homem mais rico da Babilônia é um clássico sobre como multiplicar riqueza e solucionar problemas financeiros.\r\n\r\nBaseando-se nos segredos de sucesso dos antigos babilônicos ― os habitantes da cidade mais rica e próspera de seu tempo ―, George S. Clason mostra soluções ao mesmo tempo sábias e muito atuais para evitar a falta de dinheiro, como não desperdiçar recursos durante tempos de opulência, buscar conhecimento e informação em vez de apenas lucro, assegurar uma renda para o futuro, manter a pontualidade no pagamento de dívidas e, sobretudo, cultivar as próprias aptidões, tornando-se cada vez mais habilidoso e consciente.', 160, 'Português', 'HarperCollins', 'Não', '2.00', '../assets/imgs-books/1/O_homem_mais_rico_da_Babilônia/capa.jpg', 'a1.jpg,a2.jpg,contra-capa.jpg', '2024-11-05 23:28:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
