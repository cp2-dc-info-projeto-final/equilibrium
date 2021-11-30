-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Nov-2021 às 17:58
-- Versão do servidor: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equilibrium`
--

DROP DATABASE IF EXISTS equilibrium;

CREATE DATABASE equilibrium;

USE equilibrium;


DROP USER IF EXISTS 'admin'@'localhost';

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';

GRANT ALL PRIVILEGES ON equilibrium.* TO 'admin'@'localhost';

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizade`
--

CREATE TABLE `amizade` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario_de` int(10) UNSIGNED NOT NULL,
  `id_usuario_para` int(10) UNSIGNED NOT NULL,
  `aceitou` tinyint(1) NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `texto` varchar(400) NOT NULL,
  `dt_comentario` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gostei`
--

CREATE TABLE `gostei` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_post_ou_coment` int(10) UNSIGNED NOT NULL,
  `gostei_de_post_ou_coment` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_img` varchar(255) DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `texto` varchar(1000) NOT NULL,
  `dt_postagem` date NOT NULL,
  `alterado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `nome_img`, `id_usuario`, `texto`, `dt_postagem`, `alterado`) VALUES
(42, 'Capture.PNG', 15, 'Vejam isto, pessoal! Fenomenal!', '2021-11-30', 1),
(41, '240738868_3088188941412855_9009826850203493663_n.jpg', 15, 'Os monstros mais adoráveis de H. P. Lovecraft.', '2021-11-30', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(155) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `caminhoFtPerfil` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `email`, `senha`, `caminhoFtPerfil`, `admin`) VALUES
(16, 'Rayssa Neves Cunha', 'rayssaneves48', 'rayssanevescunha@hotmail.com', '$2y$10$VIxurzoHCkYSawyey4W2VOaD3mgqpqqoD.bezVpa2Al3fqXYA3Cp2', NULL, 0),
(14, 'Rayssa Batista Nazzari', 'rayssabatistanazzari', 'rayssabatistanazzari@gmail.com', '$2y$10$E/Q0MDjYFsACZLZ2WC1aBOkaSiU4IVmmAZJA5HLYTWX608lRoJwD6', NULL, 1),
(15, 'admin', 'admin', 'admin@gmail.com', '$2y$10$o.64Hq4qbC/IChn0xhda3eLJstZKsmofKFNPprX87iWQElzsQ5MTO', NULL, 1),
(10, 'Salazar Falar Bar', 'salazarfalarbar', 'salazarfalarbar@gmail.com', '$2y$10$6szqU1wgspje7beElpSLFeWIGwoA5x7DfFH/nj9Um357sRMbL.ZcW', NULL, 0),
(13, 'Henrique Tavares dos Santos', 'henriquetsantos', 'henriquetavaressantos@outlook.com', '$2y$10$Hk7hCbUjtE23MyxYS/nsP.r0BTUp/PFaDjvYygYMUTh16mMrbvCMu', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amizade`
--
ALTER TABLE `amizade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `gostei`
--
ALTER TABLE `gostei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amizade`
--
ALTER TABLE `amizade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gostei`
--
ALTER TABLE `gostei`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
