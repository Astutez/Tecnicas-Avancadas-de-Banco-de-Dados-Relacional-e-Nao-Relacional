-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/04/2026 às 21:28
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`idaluno`, `nome`, `email`, `idade`) VALUES
(1, 'Mateus', NULL, NULL),
(2, 'Fábio', NULL, NULL),
(3, 'Ana', 'ana@email.com', 20),
(4, 'Carlos', 'carlos@email.com', 22),
(5, 'Mariana', 'mariana@email.com', 19),
(6, 'João', 'joao@email.com', 23),
(7, 'Fernanda', 'fernanda@email.com', 21),
(8, 'Lucas', 'lucas@email.com', 24),
(9, 'Patricia', 'patricia@email.com', 22),
(10, 'Rafael', 'rafael@email.com', 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`idcurso`, `nome`, `carga_horaria`) VALUES
(1, 'ADS', NULL),
(2, 'AMS', NULL),
(3, 'Engenharia', 4000),
(4, 'Direito', 3800),
(5, 'Medicina', 6000),
(6, 'Arquitetura', 4200),
(7, 'Administração', 3000),
(8, 'Psicologia', 3500),
(9, 'Design', 2800),
(10, 'Economia', 3200);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `iddisc` int(11) NOT NULL,
  `idcurso` int(11) DEFAULT NULL,
  `idprofessor` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`iddisc`, `idcurso`, `idprofessor`, `nome`, `descricao`, `carga_horaria`) VALUES
(1, 1, 1, 'Programations', NULL, 80),
(2, 2, 2, 'Computação', NULL, 60),
(3, 1, 3, 'Algoritmos', 'Lógica de programação', 80),
(4, 1, 4, 'Banco de Dados', 'Modelagem', 80),
(5, 2, 5, 'Redes', 'Infraestrutura', 60),
(6, 3, 6, 'Cálculo', 'Matemática avançada', 100),
(7, 4, 7, 'Direito Civil', 'Leis', 70),
(8, 6, 8, 'Projeto', 'Arquitetura', 90),
(9, 7, 9, 'Gestão', 'Administração', 60),
(10, 8, 10, 'Comportamento', 'Psicologia', 60);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itemturma`
--

CREATE TABLE `itemturma` (
  `idaluno` int(11) DEFAULT NULL,
  `idturma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itemturma`
--

INSERT INTO `itemturma` (`idaluno`, `idturma`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 6),
(9, 7),
(10, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `idprofessor` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `especialidade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`idprofessor`, `nome`, `email`, `especialidade`) VALUES
(1, 'Fábio', NULL, NULL),
(2, 'José', NULL, NULL),
(3, 'Marcos', 'marcos@email.com', 'Programação'),
(4, 'Cláudia', 'claudia@email.com', 'Banco de Dados'),
(5, 'Ricardo', 'ricardo@email.com', 'Redes'),
(6, 'Juliana', 'juliana@email.com', 'Matemática'),
(7, 'Paulo', 'paulo@email.com', 'Direito'),
(8, 'Sandra', 'sandra@email.com', 'Arquitetura'),
(9, 'Bruno', 'bruno@email.com', 'Administração'),
(10, 'Camila', 'camila@email.com', 'Psicologia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `idturma` int(11) NOT NULL,
  `iddisc` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `sala` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`idturma`, `iddisc`, `nome`, `semestre`, `ano`, `sala`) VALUES
(1, 1, 'Turma A', 1, 2025, 'Sala 1'),
(2, 2, 'Turma B', 1, 2025, 'Sala 2'),
(3, 3, 'Turma C', 2, 2025, 'Sala 3'),
(4, 4, 'Turma D', 2, 2025, 'Sala 4'),
(5, 5, 'Turma E', 1, 2026, 'Sala 5'),
(6, 6, 'Turma F', 1, 2026, 'Sala 6'),
(7, 7, 'Turma G', 2, 2026, 'Sala 7'),
(8, 8, 'Turma H', 2, 2026, 'Sala 8'),
(9, 9, 'Turma I', 1, 2027, 'Sala 9'),
(10, 10, 'Turma J', 1, 2027, 'Sala 10');

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
