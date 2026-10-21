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
-- Estrutura para tabela `prod`
--

CREATE TABLE `prod` (
  `id_prod` int(11) NOT NULL,
  `nome_prod` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_cat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prod`
--

INSERT INTO `prod` (`id_prod`, `nome_prod`, `preco`, `id_cat`) VALUES
(5, 'Celular', 10000.00, 3),
(6, 'arroz', 10.00, 4),
(7, 'Caderno 10 matérias', 24.90, 2),
(8, 'Caneta esferográfica azul', 2.50, 2),
(9, 'Lápis de cor 24 cores', 18.90, 2),
(10, 'Fone de ouvido Bluetooth', 129.90, 3),
(11, 'Carregador USB-C', 49.90, 3),
(12, 'Smart TV 43 polegadas', 1899.00, 3),
(13, 'Feijão carioca 1kg', 8.49, 4),
(14, 'Macarrão espaguete 500g', 4.99, 4),
(15, 'Refrigerante cola 2L', 9.99, 5),
(16, 'Suco de laranja 1L', 7.50, 5),
(17, 'Água mineral 1,5L', 3.29, 5),
(18, 'Sabonete em barra', 2.99, 6),
(19, 'Creme dental 90g', 5.49, 6),
(20, 'Shampoo 350ml', 16.90, 6),
(21, 'Detergente 500ml', 2.79, 7),
(22, 'Água sanitária 2L', 7.90, 7),
(23, 'Sabão em pó 1kg', 14.90, 7),
(24, 'Leite integral 1L', 5.29, 8),
(25, 'Queijo muçarela 500g', 32.90, 8),
(26, 'Iogurte natural 170g', 3.99, 8),
(27, 'Pão francês kg', 16.90, 9),
(28, 'Bolo de fubá', 19.90, 9),
(29, 'Banana prata kg', 6.99, 10),
(30, 'Tomate kg', 8.49, 10),
(31, 'Alface crespa', 3.50, 10),
(32, 'Peito de frango kg', 21.90, 11),
(33, 'Carne moída kg', 34.90, 11),
(34, 'Pizza congelada muçarela', 18.90, 12),
(35, 'Sorvete de chocolate 1,5L', 24.90, 12),
(36, 'Açúcar refinado 1kg', 4.89, 13),
(37, 'Café torrado 500g', 22.90, 13),
(38, 'Ração para cães 3kg', 59.90, 14),
(39, 'Areia higiênica para gatos 4kg', 21.90, 14),
(40, 'Quebra-cabeça 500 peças', 49.90, 15),
(41, 'Bola de futebol infantil', 29.90, 15),
(42, 'Livro de receitas', 59.90, 16),
(43, 'Dicionário de português', 44.90, 16),
(44, 'Garrafa térmica 1L', 69.90, 17),
(45, 'Corda de pular', 19.90, 17),
(46, 'Camiseta básica algodão', 39.90, 18),
(47, 'Calça jeans', 119.90, 18),
(48, 'Tênis de corrida', 249.90, 19),
(49, 'Chinelo de borracha', 29.90, 19),
(50, 'Mouse sem fio', 59.90, 20),
(51, 'Pen drive 64GB', 39.90, 20),
(52, 'Liquidificador 1000W', 179.90, 21),
(53, 'Jogo de chaves de fenda', 45.90, 22),
(54, 'Regador 5L', 27.90, 23),
(55, 'Jogo de panelas 5 peças', 299.90, 24),
(56, 'Pano de prato kit 3', 19.90, 24);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `FK_CAT_PROD` (`id_cat`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `prod`
--
ALTER TABLE `prod`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `prod`
--
ALTER TABLE `prod`
  ADD CONSTRAINT `FK_CAT_PROD` FOREIGN KEY (`id_cat`) REFERENCES `cat` (`id_cat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
