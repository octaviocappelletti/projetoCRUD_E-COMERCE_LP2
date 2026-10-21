-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/10/2026 às 15:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cat`
--

CREATE TABLE `cat` (
  `id_cat` int(11) NOT NULL,
  `nome_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cat`
--

INSERT INTO `cat` (`id_cat`, `nome_cat`) VALUES
(2, 'Papelarias'),
(3, 'Eletronicos'),
(4, 'Comidas'),
(5, 'Bebidas'),
(6, 'Higiene Pessoal'),
(7, 'Limpeza'),
(8, 'Laticínios'),
(9, 'Padaria'),
(10, 'Hortifruti'),
(11, 'Carnes'),
(12, 'Congelados'),
(13, 'Mercearia'),
(14, 'Pet Shop'),
(15, 'Brinquedos'),
(16, 'Livros'),
(17, 'Esportes'),
(18, 'Vestuário'),
(19, 'Calçados'),
(20, 'Informática'),
(21, 'Eletrodomésticos'),
(22, 'Ferramentas'),
(23, 'Jardinagem'),
(24, 'Utilidades Domésticas');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id_cat`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cat`
--
ALTER TABLE `cat`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
