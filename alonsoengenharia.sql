-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Set-2020 às 05:02
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alonsoengenharia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidade`
--

CREATE TABLE `tb_cidade` (
  `id_cidade` int(11) NOT NULL,
  `nm_cidade` varchar(45) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`id_cidade`, `nm_cidade`, `id_estado`) VALUES
(1, 'Santos', 1),
(2, 'São Paulo', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `razao_social_cliente` varchar(45) DEFAULT NULL,
  `nome_fantasia_cliente` varchar(45) DEFAULT NULL,
  `cnpj_cliente` varchar(45) DEFAULT NULL,
  `email_cliente` varchar(45) DEFAULT NULL,
  `telefone_cliente` varchar(45) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estado`
--

CREATE TABLE `tb_estado` (
  `id_estado` int(11) NOT NULL,
  `nm_estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_estado`
--

INSERT INTO `tb_estado` (`id_estado`, `nm_estado`) VALUES
(1, 'São Paulo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_file_proposta`
--

CREATE TABLE `tb_file_proposta` (
  `id_proposta` int(11) NOT NULL,
  `nm_file` varchar(45) NOT NULL,
  `type_file` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_logradouro`
--

CREATE TABLE `tb_logradouro` (
  `nm_logradouro` varchar(45) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_logradouro_proposta`
--

CREATE TABLE `tb_logradouro_proposta` (
  `nm_logradouro_proposta` varchar(150) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `id_proposta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_parcela_proposta`
--

CREATE TABLE `tb_parcela_proposta` (
  `id_proposta` int(11) NOT NULL,
  `qt_parcela` int(11) NOT NULL,
  `valor_parcela` decimal(11,2) NOT NULL,
  `dt_parcela` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_proposta`
--

CREATE TABLE `tb_proposta` (
  `id_proposta` int(11) NOT NULL,
  `valor_total_proposta` decimal(11,2) NOT NULL,
  `sinal_proposta` decimal(11,2) DEFAULT NULL,
  `dt_pagamento_proposta` date NOT NULL,
  `dt_proposta` date NOT NULL,
  `status_proposta` tinyint(1) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_responsavel_cliente`
--

CREATE TABLE `tb_responsavel_cliente` (
  `nm_responsavel_cliente` varchar(45) NOT NULL,
  `cpf_responsavel_cliente` varchar(11) NOT NULL,
  `celular_responsavel_cliente` varchar(13) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD PRIMARY KEY (`id_cidade`),
  ADD KEY `FK_estado_cidade_idx` (`id_estado`);

--
-- Indexes for table `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `FK_user_cliente_idx` (`id_user`);

--
-- Indexes for table `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `tb_file_proposta`
--
ALTER TABLE `tb_file_proposta`
  ADD KEY `FK_file_proposta_idx` (`id_proposta`);

--
-- Indexes for table `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  ADD KEY `FK_cliente_logradouro_idx` (`id_cliente`),
  ADD KEY `FK_cidade_logradouro_idx` (`id_cidade`);

--
-- Indexes for table `tb_logradouro_proposta`
--
ALTER TABLE `tb_logradouro_proposta`
  ADD KEY `FK_cidade_logradouro_proposta_idx` (`id_cidade`),
  ADD KEY `FK_proposta_logradouro_idx` (`id_proposta`);

--
-- Indexes for table `tb_parcela_proposta`
--
ALTER TABLE `tb_parcela_proposta`
  ADD KEY `FK_proposta_parcela` (`id_proposta`);

--
-- Indexes for table `tb_proposta`
--
ALTER TABLE `tb_proposta`
  ADD PRIMARY KEY (`id_proposta`),
  ADD KEY `FK_cliente_proposta_idx` (`id_cliente`);

--
-- Indexes for table `tb_responsavel_cliente`
--
ALTER TABLE `tb_responsavel_cliente`
  ADD KEY `Fk_clinete_id_idx` (`id_cliente`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `FK_estado_cidade` FOREIGN KEY (`id_estado`) REFERENCES `tb_estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD CONSTRAINT `FK_user_cliente` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_file_proposta`
--
ALTER TABLE `tb_file_proposta`
  ADD CONSTRAINT `FK_file_proposta` FOREIGN KEY (`id_proposta`) REFERENCES `tb_proposta` (`id_proposta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_logradouro`
--
ALTER TABLE `tb_logradouro`
  ADD CONSTRAINT `FK_cidade_logradouro` FOREIGN KEY (`id_cidade`) REFERENCES `tb_cidade` (`id_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_cliente_logradouro` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_logradouro_proposta`
--
ALTER TABLE `tb_logradouro_proposta`
  ADD CONSTRAINT `FK_cidade_logradouro_proposta` FOREIGN KEY (`id_cidade`) REFERENCES `tb_cidade` (`id_cidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_proposta_logradouro` FOREIGN KEY (`id_proposta`) REFERENCES `tb_proposta` (`id_proposta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_parcela_proposta`
--
ALTER TABLE `tb_parcela_proposta`
  ADD CONSTRAINT `FK_proposta_parcela` FOREIGN KEY (`id_proposta`) REFERENCES `tb_proposta` (`id_proposta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_proposta`
--
ALTER TABLE `tb_proposta`
  ADD CONSTRAINT `FK_cliente_proposta` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_responsavel_cliente`
--
ALTER TABLE `tb_responsavel_cliente`
  ADD CONSTRAINT `Fk_clinete_id` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
