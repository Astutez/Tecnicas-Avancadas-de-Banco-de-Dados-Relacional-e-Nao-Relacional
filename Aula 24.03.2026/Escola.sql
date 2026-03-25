-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/03/2026 às 20:14
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
-- Banco de dados: `exerc`
--
CREATE DATABASE IF NOT EXISTS `exerc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `exerc`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `nome`) VALUES
(1, 'Mateus'),
(2, 'Fábio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`idcurso`, `nome`) VALUES
(1, 'ADS'),
(2, 'AMS');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `iddisc` int(11) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  `idprofessor` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`iddisc`, `idcurso`, `idprofessor`, `nome`, `descricao`) VALUES
(1, NULL, NULL, 'Programations', NULL),
(2, NULL, NULL, 'Computação', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itemturma`
--

CREATE TABLE `itemturma` (
  `idaluno` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `idprofessor` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`idprofessor`, `nome`) VALUES
(1, 'Fábio'),
(2, 'José');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL,
  `iddisc` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idcurso`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`iddisc`),
  ADD KEY `idcurso` (`idcurso`),
  ADD KEY `idprofessor` (`idprofessor`);

--
-- Índices de tabela `itemturma`
--
ALTER TABLE `itemturma`
  ADD KEY `idaluno` (`idaluno`),
  ADD KEY `idturma` (`idturma`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`idprofessor`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idturma`),
  ADD KEY `iddisc` (`iddisc`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`idcurso`),
  ADD CONSTRAINT `disciplinas_ibfk_2` FOREIGN KEY (`idprofessor`) REFERENCES `professor` (`idprofessor`);

--
-- Restrições para tabelas `itemturma`
--
ALTER TABLE `itemturma`
  ADD CONSTRAINT `itemturma_ibfk_1` FOREIGN KEY (`idaluno`) REFERENCES `aluno` (`idaluno`),
  ADD CONSTRAINT `itemturma_ibfk_2` FOREIGN KEY (`idturma`) REFERENCES `turma` (`idturma`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`iddisc`) REFERENCES `disciplinas` (`iddisc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
