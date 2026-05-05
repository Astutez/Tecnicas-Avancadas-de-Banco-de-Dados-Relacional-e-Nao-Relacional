-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/05/2026 às 21:23
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
-- Banco de dados: `academico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `cpf`, `data_nascimento`) VALUES
(1, 'Mateus Souza', 'mateus@email.com', '111.111.111-01', '2004-03-15'),
(2, 'Fábio Ribeiro', 'fabio.r@email.com', '111.111.111-02', '2003-07-22'),
(3, 'Ana Lima', 'ana@email.com', '111.111.111-03', '2005-01-10'),
(4, 'Carlos Pereira', 'carlos@email.com', '111.111.111-04', '2003-11-05'),
(5, 'Mariana Santos', 'mariana@email.com', '111.111.111-05', '2006-04-18'),
(6, 'João Batista', 'joao@email.com', '111.111.111-06', '2003-09-30'),
(7, 'Fernanda Gomes', 'fernanda@email.com', '111.111.111-07', '2004-06-12'),
(8, 'Lucas Martins', 'lucas@email.com', '111.111.111-08', '2003-02-28'),
(9, 'Patricia Dias', 'patricia@email.com', '111.111.111-09', '2005-08-03'),
(10, 'Rafael Correia', 'rafael@email.com', '111.111.111-10', '2004-12-19'),
(11, 'Beatriz Alves', 'beatriz@email.com', '222.222.222-11', '2004-05-21'),
(12, 'Thiago Nascimento', 'thiago@email.com', '222.222.222-12', '2003-08-14'),
(13, 'Larissa Ferreira', 'larissa@email.com', '222.222.222-13', '2005-03-07'),
(14, 'Eduardo Costa', 'eduardo@email.com', '222.222.222-14', '2004-11-30'),
(15, 'Camila Rocha', 'camila@email.com', '222.222.222-15', '2003-06-25'),
(16, 'Gabriel Mendes', 'gabriel@email.com', '222.222.222-16', '2006-01-12'),
(17, 'Juliana Lima', 'juliana@email.com', '222.222.222-17', '2004-09-08'),
(18, 'Vinícius Oliveira', 'vinicius@email.com', '222.222.222-18', '2003-04-17'),
(19, 'Amanda Carvalho', 'amanda@email.com', '222.222.222-19', '2005-12-03'),
(20, 'Rodrigo Martins', 'rodrigo@email.com', '222.222.222-20', '2004-07-29'),
(21, 'Natália Santos', 'natalia@email.com', '333.333.333-21', '2003-02-11'),
(22, 'Felipe Andrade', 'felipe@email.com', '333.333.333-22', '2005-06-18'),
(23, 'Isabela Gomes', 'isabela@email.com', '333.333.333-23', '2004-10-24'),
(24, 'Leandro Barbosa', 'leandro@email.com', '333.333.333-24', '2003-03-09'),
(25, 'Priscila Dias', 'priscila@email.com', '333.333.333-25', '2006-08-15'),
(26, 'Henrique Cardoso', 'henrique@email.com', '333.333.333-26', '2004-01-27'),
(27, 'Vanessa Cruz', 'vanessa@email.com', '333.333.333-27', '2003-05-13'),
(28, 'Diego Ribeiro', 'diego@email.com', '333.333.333-28', '2005-11-06'),
(29, 'Letícia Pereira', 'leticia@email.com', '333.333.333-29', '2004-04-22'),
(30, 'Anderson Souza', 'anderson@email.com', '333.333.333-30', '2003-10-01'),
(31, 'Aline Nunes', 'aline@email.com', '444.444.444-31', '2005-07-16'),
(32, 'Renato Teixeira', 'renato@email.com', '444.444.444-32', '2004-02-28'),
(33, 'Gabriela Melo', 'gabriela@email.com', '444.444.444-33', '2003-09-19'),
(34, 'Bruno Freitas', 'bruno@email.com', '444.444.444-34', '2006-03-04'),
(35, 'Daniela Fonseca', 'daniela@email.com', '444.444.444-35', '2004-08-11'),
(36, 'Marcos Araújo', 'marcos@email.com', '444.444.444-36', '2003-12-30'),
(37, 'Sabrina Pinto', 'sabrina@email.com', '444.444.444-37', '2005-05-07'),
(38, 'Gustavo Moreira', 'gustavo@email.com', '444.444.444-38', '2004-06-23'),
(39, 'Tatiane Monteiro', 'tatiane@email.com', '444.444.444-39', '2003-01-15'),
(40, 'Caio Borges', 'caio@email.com', '444.444.444-40', '2006-09-28'),
(41, 'Érica Tavares', 'erica@email.com', '555.555.555-41', '2004-04-14'),
(42, 'Otávio Lopes', 'otavio@email.com', '555.555.555-42', '2003-07-03'),
(43, 'Raquel Azevedo', 'raquel@email.com', '555.555.555-43', '2005-10-19'),
(44, 'Willian Castro', 'willian@email.com', '555.555.555-44', '2004-02-06'),
(45, 'Milena Campos', 'milena@email.com', '555.555.555-45', '2003-06-21'),
(46, 'Tiago Ramos', 'tiago@email.com', '555.555.555-46', '2005-01-30'),
(47, 'Roberta Pires', 'roberta@email.com', '555.555.555-47', '2004-11-12'),
(48, 'Alexandre Cunha', 'alexandre@email.com', '555.555.555-48', '2003-03-25'),
(49, 'Mônica Barros', 'monica@email.com', '555.555.555-49', '2006-07-08'),
(50, 'Sérgio Soares', 'sergio@email.com', '555.555.555-50', '2004-09-17'),
(51, 'Clara Vasconcelos', 'clara@email.com', '666.666.666-51', '2005-04-02'),
(52, 'João Pedro Luz', 'joaopedro@email.com', '666.666.666-52', '2003-08-26'),
(53, 'Bianca Machado', 'bianca@email.com', '666.666.666-53', '2004-12-13'),
(54, 'Fábio Guimarães', 'fabio.g@email.com', '666.666.666-54', '2003-05-31'),
(55, 'Luana Cavalcanti', 'luana@email.com', '666.666.666-55', '2005-02-17'),
(56, 'Murilo Paiva', 'murilo@email.com', '666.666.666-56', '2004-10-05'),
(57, 'Simone Braga', 'simone@email.com', '666.666.666-57', '2003-11-22'),
(58, 'Cássio Duarte', 'cassio@email.com', '666.666.666-58', '2006-06-10'),
(59, 'Luciana Queiroz', 'luciana@email.com', '666.666.666-59', '2004-01-18'),
(60, 'Pedro Henrique Reis', 'pedrohenrique@email.com', '666.666.666-60', '2003-04-07'),
(61, 'Denise Moura', 'denise@email.com', '777.777.777-61', '2005-09-24'),
(62, 'Claudio Xavier', 'claudio@email.com', '777.777.777-62', '2004-03-11'),
(63, 'Patrícia Vieira', 'patricia.v@email.com', '777.777.777-63', '2003-07-28'),
(64, 'Edson Corrêa', 'edson@email.com', '777.777.777-64', '2006-02-14'),
(65, 'Silvia Leão', 'silvia@email.com', '777.777.777-65', '2004-06-01'),
(66, 'Maurício Farias', 'mauricio@email.com', '777.777.777-66', '2003-10-19'),
(67, 'Keila Sampaio', 'keila@email.com', '777.777.777-67', '2005-05-27'),
(68, 'Igor Falcão', 'igor@email.com', '777.777.777-68', '2004-08-15'),
(69, 'Elaine Bastos', 'elaine@email.com', '777.777.777-69', '2003-01-03'),
(70, 'Adriano Guerreiro', 'adriano@email.com', '777.777.777-70', '2006-04-20'),
(71, 'Fernanda Coelho', 'fernanda.c@email.com', '888.888.888-71', '2004-07-09'),
(72, 'Leonardo Brandão', 'leonardo@email.com', '888.888.888-72', '2003-09-26'),
(73, 'Verônica Esteves', 'veronica@email.com', '888.888.888-73', '2005-12-14'),
(74, 'Renan Figueiredo', 'renan@email.com', '888.888.888-74', '2004-05-01'),
(75, 'Soraia Magalhães', 'soraia@email.com', '888.888.888-75', '2003-02-18'),
(76, 'Matheus Lacerda', 'matheus.l@email.com', '888.888.888-76', '2006-10-07'),
(77, 'Bruna Wanderley', 'bruna@email.com', '888.888.888-77', '2004-03-25'),
(78, 'Cristiano Salles', 'cristiano@email.com', '888.888.888-78', '2003-08-12'),
(79, 'Nathalia Evangelista', 'nathalia@email.com', '888.888.888-79', '2005-11-29'),
(80, 'Paulo Sérgio Viana', 'pauloviana@email.com', '888.888.888-80', '2004-04-16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `codigo`, `carga_horaria`, `nivel`) VALUES
(1, 'Análise e Desenvolvimento de Sistemas', 'ADS-001', 2400, 'Técnico'),
(2, 'Administração de Redes', 'AMS-002', 2000, 'Técnico'),
(3, 'Engenharia Civil', 'ENG-003', 4000, 'Graduação'),
(4, 'Direito', 'DIR-004', 3800, 'Graduação'),
(5, 'Medicina', 'MED-005', 6000, 'Graduação'),
(6, 'Arquitetura e Urbanismo', 'ARQ-006', 4200, 'Graduação'),
(7, 'Administração', 'ADM-007', 3000, 'Graduação'),
(8, 'Psicologia', 'PSI-008', 3500, 'Graduação'),
(9, 'Design Gráfico', 'DES-009', 2800, 'Técnico'),
(10, 'Ciências Econômicas', 'ECO-010', 3200, 'Graduação');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`id`, `curso_id`, `nome`, `codigo`, `descricao`, `carga_horaria`, `periodo`) VALUES
(1, 1, 'Programação Orientada a Objetos', 'POO-101', 'Lógica e paradigma OO', 80, 1),
(2, 2, 'Fundamentos de Redes', 'RED-101', 'Modelo OSI e protocolos', 60, 1),
(3, 1, 'Algoritmos e Estruturas de Dados', 'AED-102', 'Lógica de programação', 80, 1),
(4, 1, 'Banco de Dados', 'BD-201', 'Modelagem e SQL', 80, 2),
(5, 2, 'Redes Avançadas', 'RED-202', 'Infraestrutura e segurança', 60, 2),
(6, 3, 'Cálculo I', 'MAT-101', 'Matemática diferencial', 100, 1),
(7, 4, 'Direito Civil', 'DIR-101', 'Código civil brasileiro', 70, 1),
(8, 6, 'Projeto Arquitetônico', 'ARQ-201', 'Fundamentos de projeto', 90, 2),
(9, 7, 'Gestão Empresarial', 'ADM-101', 'Princípios de administração', 60, 1),
(10, 8, 'Psicologia do Comportamento', 'PSI-101', 'Comportamento humano', 60, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `aluno_id` int(11) DEFAULT NULL,
  `turma_id` int(11) DEFAULT NULL,
  `data_matricula` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `aluno_id`, `turma_id`, `data_matricula`, `status`) VALUES
(1, 1, 1, '2025-01-20', 'Ativo'),
(2, 2, 1, '2025-01-20', 'Ativo'),
(3, 11, 1, '2025-01-20', 'Ativo'),
(4, 12, 1, '2025-01-21', 'Ativo'),
(5, 13, 1, '2025-01-21', 'Ativo'),
(6, 21, 1, '2025-01-22', 'Ativo'),
(7, 22, 1, '2025-01-22', 'Concluído'),
(8, 31, 1, '2025-01-22', 'Ativo'),
(9, 41, 1, '2025-01-23', 'Ativo'),
(10, 51, 1, '2025-01-23', 'Ativo'),
(11, 3, 2, '2025-01-21', 'Ativo'),
(12, 4, 2, '2025-01-21', 'Concluído'),
(13, 14, 2, '2025-01-22', 'Ativo'),
(14, 15, 2, '2025-01-22', 'Ativo'),
(15, 23, 2, '2025-01-23', 'Ativo'),
(16, 32, 2, '2025-01-23', 'Ativo'),
(17, 42, 2, '2025-01-24', 'Trancado'),
(18, 52, 2, '2025-01-24', 'Ativo'),
(19, 61, 2, '2025-01-24', 'Ativo'),
(20, 71, 2, '2025-01-25', 'Ativo'),
(21, 5, 3, '2025-07-15', 'Ativo'),
(22, 16, 3, '2025-07-15', 'Ativo'),
(23, 24, 3, '2025-07-16', 'Ativo'),
(24, 33, 3, '2025-07-16', 'Ativo'),
(25, 43, 3, '2025-07-17', 'Ativo'),
(26, 53, 3, '2025-07-17', 'Concluído'),
(27, 62, 3, '2025-07-17', 'Ativo'),
(28, 72, 3, '2025-07-18', 'Ativo'),
(29, 25, 3, '2025-07-18', 'Ativo'),
(30, 34, 3, '2025-07-18', 'Ativo'),
(31, 6, 4, '2025-07-16', 'Ativo'),
(32, 17, 4, '2025-07-16', 'Ativo'),
(33, 26, 4, '2025-07-17', 'Ativo'),
(34, 35, 4, '2025-07-17', 'Ativo'),
(35, 44, 4, '2025-07-18', 'Ativo'),
(36, 54, 4, '2025-07-18', 'Trancado'),
(37, 63, 4, '2025-07-18', 'Ativo'),
(38, 73, 4, '2025-07-19', 'Ativo'),
(39, 36, 4, '2025-07-19', 'Ativo'),
(40, 45, 4, '2025-07-19', 'Ativo'),
(41, 7, 5, '2026-01-18', 'Ativo'),
(42, 18, 5, '2026-01-18', 'Ativo'),
(43, 27, 5, '2026-01-19', 'Ativo'),
(44, 37, 5, '2026-01-19', 'Ativo'),
(45, 46, 5, '2026-01-20', 'Ativo'),
(46, 55, 5, '2026-01-20', 'Ativo'),
(47, 64, 5, '2026-01-20', 'Ativo'),
(48, 74, 5, '2026-01-21', 'Ativo'),
(49, 8, 6, '2026-01-19', 'Trancado'),
(50, 19, 6, '2026-01-19', 'Ativo'),
(51, 28, 6, '2026-01-20', 'Ativo'),
(52, 38, 6, '2026-01-20', 'Ativo'),
(53, 47, 6, '2026-01-21', 'Ativo'),
(54, 56, 6, '2026-01-21', 'Ativo'),
(55, 65, 6, '2026-01-21', 'Ativo'),
(56, 75, 6, '2026-01-22', 'Ativo'),
(57, 9, 7, '2026-07-20', 'Ativo'),
(58, 20, 7, '2026-07-20', 'Ativo'),
(59, 29, 7, '2026-07-21', 'Ativo'),
(60, 39, 7, '2026-07-21', 'Ativo'),
(61, 48, 7, '2026-07-21', 'Ativo'),
(62, 57, 7, '2026-07-22', 'Ativo'),
(63, 66, 7, '2026-07-22', 'Concluído'),
(64, 76, 7, '2026-07-22', 'Ativo'),
(65, 10, 8, '2026-07-21', 'Ativo'),
(66, 30, 8, '2026-07-21', 'Ativo'),
(67, 40, 8, '2026-07-22', 'Ativo'),
(68, 49, 8, '2026-07-22', 'Ativo'),
(69, 58, 8, '2026-07-22', 'Ativo'),
(70, 67, 8, '2026-07-23', 'Ativo'),
(71, 77, 8, '2026-07-23', 'Ativo'),
(72, 50, 8, '2026-07-23', 'Trancado'),
(73, 59, 9, '2027-01-18', 'Ativo'),
(74, 60, 9, '2027-01-18', 'Ativo'),
(75, 68, 9, '2027-01-19', 'Ativo'),
(76, 69, 9, '2027-01-19', 'Ativo'),
(77, 78, 9, '2027-01-19', 'Ativo'),
(78, 79, 9, '2027-01-20', 'Ativo'),
(79, 80, 9, '2027-01-20', 'Ativo'),
(80, 70, 9, '2027-01-20', 'Ativo'),
(81, 71, 10, '2027-01-19', 'Ativo'),
(82, 72, 10, '2027-01-19', 'Concluído'),
(83, 73, 10, '2027-01-20', 'Ativo'),
(84, 74, 10, '2027-01-20', 'Ativo'),
(85, 75, 10, '2027-01-20', 'Ativo'),
(86, 76, 10, '2027-01-21', 'Ativo'),
(87, 77, 10, '2027-01-21', 'Ativo'),
(88, 78, 10, '2027-01-21', 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `especialidade` varchar(100) DEFAULT NULL,
  `titulacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `email`, `especialidade`, `titulacao`) VALUES
(1, 'Fábio Andrade', 'fabio@acad.edu.br', 'Programação', 'Mestre'),
(2, 'José Carvalho', 'jose@acad.edu.br', 'Redes', 'Especialista'),
(3, 'Marcos Oliveira', 'marcos@acad.edu.br', 'Programação', 'Mestre'),
(4, 'Cláudia Ferreira', 'claudia@acad.edu.br', 'Banco de Dados', 'Doutor'),
(5, 'Ricardo Lima', 'ricardo@acad.edu.br', 'Redes', 'Mestre'),
(6, 'Juliana Costa', 'juliana@acad.edu.br', 'Matemática', 'Doutor'),
(7, 'Paulo Mendes', 'paulo@acad.edu.br', 'Direito', 'Especialista'),
(8, 'Sandra Rocha', 'sandra@acad.edu.br', 'Arquitetura', 'Doutor'),
(9, 'Bruno Alves', 'bruno@acad.edu.br', 'Administração', 'Mestre'),
(10, 'Camila Nunes', 'camila@acad.edu.br', 'Psicologia', 'Doutor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `id` int(11) NOT NULL,
  `disciplina_id` int(11) DEFAULT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `vagas` int(11) DEFAULT NULL,
  `sala` varchar(100) DEFAULT NULL,
  `horario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`id`, `disciplina_id`, `professor_id`, `codigo`, `semestre`, `ano`, `vagas`, `sala`, `horario`) VALUES
(1, 1, 1, 'POO-101-A', 1, 2025, 40, 'Bloco A - Sala 101', 'Seg/Qua 19h-21h'),
(2, 2, 2, 'RED-101-B', 1, 2025, 35, 'Bloco B - Sala 202', 'Ter/Qui 19h-21h'),
(3, 3, 3, 'AED-102-C', 2, 2025, 40, 'Bloco A - Sala 103', 'Seg/Qua 21h-23h'),
(4, 4, 4, 'BD-201-D', 2, 2025, 38, 'Lab de Informática 1', 'Ter/Qui 21h-23h'),
(5, 5, 5, 'RED-202-E', 1, 2026, 35, 'Bloco B - Sala 204', 'Sex 19h-23h'),
(6, 6, 6, 'MAT-101-F', 1, 2026, 50, 'Bloco C - Sala 301', 'Seg/Qua 07h-09h'),
(7, 7, 7, 'DIR-101-G', 2, 2026, 45, 'Bloco D - Sala 401', 'Ter/Qui 07h-09h'),
(8, 8, 8, 'ARQ-201-H', 2, 2026, 30, 'Ateliê de Projetos', 'Seg/Qua 13h-15h'),
(9, 9, 9, 'ADM-101-I', 1, 2027, 42, 'Bloco E - Sala 501', 'Ter/Qui 13h-15h'),
(10, 10, 10, 'PSI-101-J', 1, 2027, 38, 'Bloco F - Sala 601', 'Sex 13h-17h');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aluno_id` (`aluno_id`,`turma_id`),
  ADD KEY `turma_id` (`turma_id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disciplina_id` (`disciplina_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `disciplinas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`);

--
-- Restrições para tabelas `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_ibfk_1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id`),
  ADD CONSTRAINT `turmas_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
