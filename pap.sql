-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Abr-2024 às 16:14
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
  `Morada` varchar(50) NOT NULL,
  `Descrição` varchar(45) NOT NULL,
  `User_idUser` int(11) NOT NULL,
  `User_Role_IDRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `details`
--

CREATE TABLE `details` (
  `idDetails` int(11) NOT NULL,
  `Descrição` varchar(100) DEFAULT NULL,
  `Valor` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipments`
--

CREATE TABLE `equipments` (
  `idEquipments` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `idProducts` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Descrição` varchar(45) NOT NULL,
  `Service_idService` int(11) NOT NULL,
  `Service_Task_idTask` int(11) NOT NULL,
  `Service_Task_User_idUser` int(11) NOT NULL,
  `Service_Task_User_Role_IDRole` int(11) NOT NULL,
  `Service_Service Types_idService Types` int(11) NOT NULL,
  `Details_idDetails` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receipt`
--

CREATE TABLE `receipt` (
  `idReceipt` int(11) NOT NULL,
  `Serviço` varchar(45) DEFAULT NULL,
  `ValorFinal` varchar(45) DEFAULT NULL,
  `Service_idService` int(11) NOT NULL,
  `Service_Task_idTask` int(11) NOT NULL,
  `Service_Task_User_idUser` int(11) NOT NULL,
  `Service_Task_User_Role_IDRole` int(11) NOT NULL,
  `Service_Service Types_idService Types` int(11) NOT NULL,
  `PaymentStatus_idPaymentStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

CREATE TABLE `role` (
  `IDRole` int(11) NOT NULL,
  `RoleName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`IDRole`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `service`
--

CREATE TABLE `service` (
  `idService` int(11) NOT NULL,
  `TipoServico` varchar(45) NOT NULL,
  `Equipamentos` varchar(50) NOT NULL,
  `Produtos` varchar(50) NOT NULL,
  `DataInicio` date NOT NULL,
  `DataFim` date NOT NULL,
  `Task_idTask` int(11) NOT NULL,
  `Task_User_idUser` int(11) NOT NULL,
  `Task_User_Role_IDRole` int(11) NOT NULL,
  `Service Types_idService Types` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `service types`
--

CREATE TABLE `service types` (
  `idService Types` int(11) NOT NULL,
  `TipoServico` varchar(75) NOT NULL,
  `ValorPHora` int(11) DEFAULT NULL,
  `ServiceValues_idServiceValues` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicevalues`
--

CREATE TABLE `servicevalues` (
  `idServiceValues` int(11) NOT NULL,
  `ValorPorHora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `servicevalues`
--

INSERT INTO `servicevalues` (`idServiceValues`, `ValorPorHora`) VALUES
(1, '8€'),
(2, '10€'),
(3, '12€'),
(4, '14€'),
(5, '16€'),
(6, '18€'),
(7, '20€');

-- --------------------------------------------------------

--
-- Estrutura da tabela `service_has_equipments`
--

CREATE TABLE `service_has_equipments` (
  `Service_idService` int(11) NOT NULL,
  `Service_Task_idTask` int(11) NOT NULL,
  `Service_Task_User_idUser` int(11) NOT NULL,
  `Service_Task_User_Role_IDRole` int(11) NOT NULL,
  `Service_Service Types_idService Types` int(11) NOT NULL,
  `Equipments_idEquipments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`idStatus`, `Status`) VALUES
(1, 'Concluido'),
(2, 'Em execução'),
(3, 'Agendado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `task`
--

CREATE TABLE `task` (
  `idTask` int(11) NOT NULL,
  `User` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Service` varchar(45) NOT NULL,
  `Receipt` varchar(45) NOT NULL,
  `User_idUser` int(11) NOT NULL,
  `User_Role_IDRole` int(11) NOT NULL,
  `Status_idStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Telefone` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `Role_IDRole` int(11) NOT NULL,
  `Role_IDRole1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`,`User_idUser`,`User_Role_IDRole`),
  ADD KEY `fk_Client_User1_idx` (`User_idUser`,`User_Role_IDRole`);

--
-- Índices para tabela `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`idDetails`);

--
-- Índices para tabela `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`idEquipments`);

--
-- Índices para tabela `paymentstatus`
--
ALTER TABLE `paymentstatus`
  ADD PRIMARY KEY (`idPaymentStatus`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProducts`,`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`,`Details_idDetails`),
  ADD KEY `fk_Products_Service1_idx` (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`),
  ADD KEY `fk_Products_Details1_idx` (`Details_idDetails`);

--
-- Índices para tabela `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`idReceipt`,`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`,`PaymentStatus_idPaymentStatus`),
  ADD KEY `fk_Receipt_Service1_idx` (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`),
  ADD KEY `fk_Receipt_PaymentStatus1_idx` (`PaymentStatus_idPaymentStatus`);

--
-- Índices para tabela `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`IDRole`);

--
-- Índices para tabela `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`idService`,`Task_idTask`,`Task_User_idUser`,`Task_User_Role_IDRole`,`Service Types_idService Types`),
  ADD KEY `fk_Service_Task1_idx` (`Task_idTask`,`Task_User_idUser`,`Task_User_Role_IDRole`),
  ADD KEY `fk_Service_Service Types1_idx` (`Service Types_idService Types`);

--
-- Índices para tabela `service types`
--
ALTER TABLE `service types`
  ADD PRIMARY KEY (`idService Types`,`ServiceValues_idServiceValues`),
  ADD KEY `fk_Service Types_ServiceValues1_idx` (`ServiceValues_idServiceValues`);

--
-- Índices para tabela `servicevalues`
--
ALTER TABLE `servicevalues`
  ADD PRIMARY KEY (`idServiceValues`);

--
-- Índices para tabela `service_has_equipments`
--
ALTER TABLE `service_has_equipments`
  ADD PRIMARY KEY (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`,`Equipments_idEquipments`),
  ADD KEY `fk_Service_has_Equipments_Equipments1_idx` (`Equipments_idEquipments`),
  ADD KEY `fk_Service_has_Equipments_Service1_idx` (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Índices para tabela `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`idTask`,`User_idUser`,`User_Role_IDRole`,`Status_idStatus`),
  ADD KEY `fk_Task_User1_idx` (`User_idUser`,`User_Role_IDRole`),
  ADD KEY `fk_Task_Status1_idx` (`Status_idStatus`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`,`Role_IDRole`,`Role_IDRole1`),
  ADD KEY `fk_User_Role1_idx` (`Role_IDRole1`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `details`
--
ALTER TABLE `details`
  MODIFY `idDetails` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `paymentstatus`
--
ALTER TABLE `paymentstatus`
  MODIFY `idPaymentStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `idProducts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receipt`
--
ALTER TABLE `receipt`
  MODIFY `idReceipt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `role`
--
ALTER TABLE `role`
  MODIFY `IDRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `service`
--
ALTER TABLE `service`
  MODIFY `idService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `service types`
--
ALTER TABLE `service types`
  MODIFY `idService Types` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `servicevalues`
--
ALTER TABLE `servicevalues`
  MODIFY `idServiceValues` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `task`
--
ALTER TABLE `task`
  MODIFY `idTask` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_Client_User1` FOREIGN KEY (`User_idUser`,`User_Role_IDRole`) REFERENCES `user` (`idUser`, `Role_IDRole`);

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_Products_Details1` FOREIGN KEY (`Details_idDetails`) REFERENCES `details` (`idDetails`),
  ADD CONSTRAINT `fk_Products_Service1` FOREIGN KEY (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`) REFERENCES `service` (`idService`, `Task_idTask`, `Task_User_idUser`, `Task_User_Role_IDRole`, `Service Types_idService Types`);

--
-- Limitadores para a tabela `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `fk_Receipt_PaymentStatus1` FOREIGN KEY (`PaymentStatus_idPaymentStatus`) REFERENCES `paymentstatus` (`idPaymentStatus`),
  ADD CONSTRAINT `fk_Receipt_Service1` FOREIGN KEY (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`) REFERENCES `service` (`idService`, `Task_idTask`, `Task_User_idUser`, `Task_User_Role_IDRole`, `Service Types_idService Types`);

--
-- Limitadores para a tabela `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_Service_Service Types1` FOREIGN KEY (`Service Types_idService Types`) REFERENCES `service types` (`idService Types`),
  ADD CONSTRAINT `fk_Service_Task1` FOREIGN KEY (`Task_idTask`,`Task_User_idUser`,`Task_User_Role_IDRole`) REFERENCES `task` (`idTask`, `User_idUser`, `User_Role_IDRole`);

--
-- Limitadores para a tabela `service types`
--
ALTER TABLE `service types`
  ADD CONSTRAINT `fk_Service Types_ServiceValues1` FOREIGN KEY (`ServiceValues_idServiceValues`) REFERENCES `servicevalues` (`idServiceValues`);

--
-- Limitadores para a tabela `service_has_equipments`
--
ALTER TABLE `service_has_equipments`
  ADD CONSTRAINT `fk_Service_has_Equipments_Equipments1` FOREIGN KEY (`Equipments_idEquipments`) REFERENCES `equipments` (`idEquipments`),
  ADD CONSTRAINT `fk_Service_has_Equipments_Service1` FOREIGN KEY (`Service_idService`,`Service_Task_idTask`,`Service_Task_User_idUser`,`Service_Task_User_Role_IDRole`,`Service_Service Types_idService Types`) REFERENCES `service` (`idService`, `Task_idTask`, `Task_User_idUser`, `Task_User_Role_IDRole`, `Service Types_idService Types`);

--
-- Limitadores para a tabela `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_Task_Status1` FOREIGN KEY (`Status_idStatus`) REFERENCES `status` (`idStatus`),
  ADD CONSTRAINT `fk_Task_User1` FOREIGN KEY (`User_idUser`,`User_Role_IDRole`) REFERENCES `user` (`idUser`, `Role_IDRole`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_Role1` FOREIGN KEY (`Role_IDRole1`) REFERENCES `role` (`IDRole`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
