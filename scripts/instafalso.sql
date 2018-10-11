-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Set-2018 às 06:18
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instafalso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `canal`
--

CREATE TABLE `canal` (
  `cod` bigint(20) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `dono` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `canal`
--

INSERT INTO `canal` (`cod`, `nome`, `descricao`, `dono`) VALUES
(1, 'Super daoras', 'para fotos daoras', 1),
(2, 'Super Fotos', NULL, 2),
(3, 'Beleza', 'opa beleza!', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `cod` bigint(20) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `visibilidade` bit(1) DEFAULT NULL,
  `cod_canal` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`cod`, `nome`, `descricao`, `visibilidade`, `cod_canal`) VALUES
(62, '18653888790226911001538021058.jpg', 'Cara daora', b'1', 3),
(63, '9756929340625157001538021227.jpg', 'Cara daora', b'1', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` bigint(20) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `nome`, `email`, `login`, `senha`) VALUES
(1, 'lele', 'leledacuca@gmail.com', 'lele', '1234'),
(2, 'root', 'root@gmail.com', 'root', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_canal`
--

CREATE TABLE `usuario_canal` (
  `cod_usu` bigint(20) DEFAULT NULL,
  `cod_canal` bigint(20) DEFAULT NULL,
  `autorizacao` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario_canal`
--

INSERT INTO `usuario_canal` (`cod_usu`, `cod_canal`, `autorizacao`) VALUES
(2, 2, b'1'),
(1, 1, b'1'),
(1, 1, b'1'),
(1, 1, b'1'),
(1, 1, b'1'),
(1, 1, b'1'),
(2, 3, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `canal`
--
ALTER TABLE `canal`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_usuario_idx` (`dono`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `fk_canal_idx` (`cod_canal`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `usuario_canal`
--
ALTER TABLE `usuario_canal`
  ADD KEY `fk_canal1_idx` (`cod_canal`),
  ADD KEY `fk_usuario1_idx` (`cod_usu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `canal`
--
ALTER TABLE `canal`
  MODIFY `cod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `cod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuario_canal`
--
ALTER TABLE `usuario_canal`
  ADD CONSTRAINT `fk_canal1` FOREIGN KEY (`cod_canal`) REFERENCES `canal` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario1` FOREIGN KEY (`cod_usu`) REFERENCES `usuario` (`cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
