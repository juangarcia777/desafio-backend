-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Fev-2021 às 02:50
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `laraveltest`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_transaction` text NOT NULL,
  `created_at` datetime NOT NULL,
  `value` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `operations`
--

INSERT INTO `operations` (`id`, `id_user`, `type_transaction`, `created_at`, `value`) VALUES
(3, 4, 'CREDIT', '2021-02-22 22:00:01', 890.00),
(4, 1, 'DEBIT', '2021-02-22 22:30:01', 90.00),
(5, 1, 'DEBIT', '2021-01-24 23:33:37', 190.00),
(7, 1, 'DEBIT', '2021-01-21 22:30:01', 20.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `birthday` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `initial_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `birthday`, `created_at`, `updated_at`, `initial_value`) VALUES
(1, 'Juan Garcia', 'juangarcia170498@gmail.com', '1998-04-17', '2021-02-22 21:56:12', '2021-02-23 02:59:55', '1860.80'),
(4, 'Lionel Messi', 'lionelmessi@gmail.com', '1988-04-18', '2021-02-22 21:58:12', '2021-02-24 01:21:39', '1450.50'),
(6, 'Cristiano Ronaldo', 'cr7@gmail.com', '1998-04-18', '2021-02-22 22:58:12', '2021-02-24 01:01:17', '1450.50'),
(9, 'Paulo Braga', 'cr7@gmail.com', '1998-04-18', '2021-02-22 22:58:12', '2021-02-22 22:58:28', '1250.90');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
