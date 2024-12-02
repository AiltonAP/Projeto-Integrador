-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Nov-2023 às 01:39
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dev`
--

CREATE TABLE `dev` (
  `id_dev` int(11) NOT NULL,
  `NOME` varchar(20) DEFAULT NULL,
  `SOBRENOME` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `GÊNERO` varchar(20) DEFAULT NULL,
  `ESTADO CIVIL` varchar(20) DEFAULT NULL,
  `IDIOMAS` varchar(20) DEFAULT NULL,
  `EXPERIENCIA` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dev`
--
ALTER TABLE `dev`
  ADD PRIMARY KEY (`id_dev`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dev`
--
ALTER TABLE `dev`
  MODIFY `id_dev` int(11) NOT NULL AUTO_INCREMENT;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
