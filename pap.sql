-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jul-2024 às 18:01
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `Morada` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`idClient`, `cliente`, `Telefone`, `Morada`) VALUES
(4, 'TestE', 1212, 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paymentstatus`
--

CREATE TABLE `paymentstatus` (
  `idPaymentStatus` int(11) NOT NULL,
  `Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `paymentstatus`
--

INSERT INTO `paymentstatus` (`idPaymentStatus`, `Status`) VALUES
(1, 'Pago'),
(2, 'Em Pagamento'),
(3, 'Por pagar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receipt`
--

CREATE TABLE `receipt` (
  `idReceipt` int(11) NOT NULL,
  `servico` varchar(45) NOT NULL,
  `ValorPorHora` double DEFAULT NULL,
  `NumHoras` int(11) DEFAULT NULL,
  `ValorFinal` int(11) DEFAULT NULL,
  `PaymentStatus_idPaymentStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `receipt`
--

INSERT INTO `receipt` (`idReceipt`, `servico`, `ValorPorHora`, `NumHoras`, `ValorFinal`, `PaymentStatus_idPaymentStatus`) VALUES
(16, 'Ok', 4, 10, 40, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `service`
--

CREATE TABLE `service` (
  `idService` int(11) NOT NULL,
  `TipoServico` varchar(45) NOT NULL,
  `DataInicio` date NOT NULL,
  `DataFim` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `service`
--

INSERT INTO `service` (`idService`, `TipoServico`, `DataInicio`, `DataFim`, `status`) VALUES
(168, 'Ok', '2112-12-12', '2112-12-12', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `teste` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `teste`, `status`) VALUES
(23, 'Teste', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `url_address` varchar(65) NOT NULL,
  `date` date NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`idUser`, `nome`, `telefone`, `email`, `password`, `active`, `url_address`, `date`, `role`) VALUES
(1, 'eduardo', 918261738, 'sirpearls12@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 0, 'T', '2024-04-20', 'admin'),
(2, 'DLay', 23232323, 'JP12345@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 0, 'dpKs3NHgVAURXYhpBdXmbCNERDmurR68bG8jAYAv1C067eCmjCuwGQE00FEW', '2024-05-06', 'user'),
(3, 'eduardo', 918261738, 'fsdfsd@dads.com', '8cb2237d0679ca88db6464eac60da96345513964', 0, 'i8oVVE1hf4Sestc2BhU7CVdrx2qeg9EYnzsgIY65CTCAz7WiYM9d9g5zqHi9', '2024-07-08', 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Índices para tabela `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD PRIMARY KEY (`idPaymentStatus`);

--
-- Índices para tabela `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`idReceipt`,`PaymentStatus_idPaymentStatus`) USING BTREE,
  ADD KEY `fk_Receipt_PaymentStatus1_idx` (`PaymentStatus_idPaymentStatus`);

--
-- Índices para tabela `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`) USING BTREE;

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `url_address` (`url_address`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `paymentstatus`
--
ALTER TABLE `paymentstatus`
  MODIFY `idPaymentStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `receipt`
--
ALTER TABLE `receipt`
  MODIFY `idReceipt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
