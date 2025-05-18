-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2024 às 13:18
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
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `cad_id` int(10) NOT NULL,
  `cad_nome` varchar(100) NOT NULL,
  `cad_email` varchar(100) NOT NULL,
  `cad_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(9) NOT NULL,
  `nome_cat` varchar(40) NOT NULL,
  `situacao_cat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nome_cat`, `situacao_cat`) VALUES
(11, 'Agulha', 1),
(18, 'Aparelho de pressão', 1),
(19, 'Auto-teste', 1),
(21, 'Bandagens', 1),
(23, 'Bolsa térmica', 1),
(24, 'Caneta lancetora', 1),
(25, 'Caixa perfuro cortan', 1),
(26, 'Coletores', 1),
(27, 'Compressa de gaze', 1),
(28, 'Cortador de unha', 1),
(29, 'Curativo', 1),
(30, 'Eletroestimulador', 1),
(31, 'Esparadrapos', 1),
(32, 'Espaçadores', 1),
(33, 'Géis', 1),
(34, 'Produtos capilares', 1),
(35, 'Joelheiras', 1),
(36, 'Lancetas', 1),
(38, 'Máscaras', 1),
(39, 'Microporosas', 1),
(40, 'Munhequeiras', 1),
(41, 'Inaladores', 1),
(42, 'Protetores oculares', 1),
(43, 'Sabonetes', 1),
(44, 'Seringas', 1),
(45, 'Termômetro', 1),
(46, 'Tornozeleiras', 1),
(47, 'Remédio', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `log_id` int(10) NOT NULL,
  `log_usu` varchar(50) NOT NULL,
  `log_senha` varchar(50) NOT NULL,
  `log_nome` varchar(50) NOT NULL,
  `log_tipo` int(1) NOT NULL,
  `log_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`log_id`, `log_usu`, `log_senha`, `log_nome`, `log_tipo`, `log_status`) VALUES
(1, 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', '', 0, 1),
(2, 'teste', 'teste', '', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id_prod` int(9) NOT NULL,
  `nome_prod` varchar(30) NOT NULL,
  `cat_prod` int(9) NOT NULL,
  `valor_prod` float NOT NULL,
  `estoque_prod` int(5) NOT NULL,
  `cod_prod` int(5) NOT NULL,
  `situacao_prod` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id_venda` int(11) NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_venda` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`log_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_prod`),
  ADD UNIQUE KEY `cod_prod` (`cod_prod`),
  ADD UNIQUE KEY `cod_prod_2` (`cod_prod`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `fk_cod_prod` (`cod_prod`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_prod` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_cod_prod` FOREIGN KEY (`cod_prod`) REFERENCES `produto` (`cod_prod`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
