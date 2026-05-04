-- =====================================================
-- AcadSystem — Dados de Exercício / Exemplo
-- Compatível com schema.sql (banco: academico)
-- Corrigido em 2026
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

USE academico;

-- =====================================================
-- Cursos
-- =====================================================
INSERT IGNORE INTO cursos (id, nome, codigo, carga_horaria, nivel) VALUES
(1,  'Análise e Desenvolvimento de Sistemas', 'ADS-001', 2400, 'Técnico'),
(2,  'Administração de Redes',                'AMS-002', 2000, 'Técnico'),
(3,  'Engenharia Civil',                      'ENG-003', 4000, 'Graduação'),
(4,  'Direito',                               'DIR-004', 3800, 'Graduação'),
(5,  'Medicina',                              'MED-005', 6000, 'Graduação'),
(6,  'Arquitetura e Urbanismo',               'ARQ-006', 4200, 'Graduação'),
(7,  'Administração',                         'ADM-007', 3000, 'Graduação'),
(8,  'Psicologia',                            'PSI-008', 3500, 'Graduação'),
(9,  'Design Gráfico',                        'DES-009', 2800, 'Técnico'),
(10, 'Ciências Econômicas',                   'ECO-010', 3200, 'Graduação');

-- =====================================================
-- Professores
-- =====================================================
INSERT IGNORE INTO professores (id, nome, email, especialidade, titulacao) VALUES
(1,  'Fábio Andrade',    'fabio@acad.edu.br',    'Programação',    'Mestre'),
(2,  'José Carvalho',    'jose@acad.edu.br',     'Redes',          'Especialista'),
(3,  'Marcos Oliveira',  'marcos@acad.edu.br',   'Programação',    'Mestre'),
(4,  'Cláudia Ferreira', 'claudia@acad.edu.br',  'Banco de Dados', 'Doutor'),
(5,  'Ricardo Lima',     'ricardo@acad.edu.br',  'Redes',          'Mestre'),
(6,  'Juliana Costa',    'juliana@acad.edu.br',  'Matemática',     'Doutor'),
(7,  'Paulo Mendes',     'paulo@acad.edu.br',    'Direito',        'Especialista'),
(8,  'Sandra Rocha',     'sandra@acad.edu.br',   'Arquitetura',    'Doutor'),
(9,  'Bruno Alves',      'bruno@acad.edu.br',    'Administração',  'Mestre'),
(10, 'Camila Nunes',     'camila@acad.edu.br',   'Psicologia',     'Doutor');

-- =====================================================
-- Alunos
-- =====================================================
INSERT IGNORE INTO alunos (id, nome, email, data_nascimento) VALUES
(1,  'Mateus Souza',    'mateus@email.com',   '2004-03-15'),
(2,  'Fábio Ribeiro',   'fabio.r@email.com',  '2003-07-22'),
(3,  'Ana Lima',        'ana@email.com',       '2005-01-10'),
(4,  'Carlos Pereira',  'carlos@email.com',    '2003-11-05'),
(5,  'Mariana Santos',  'mariana@email.com',   '2006-04-18'),
(6,  'João Batista',    'joao@email.com',      '2003-09-30'),
(7,  'Fernanda Gomes',  'fernanda@email.com',  '2004-06-12'),
(8,  'Lucas Martins',   'lucas@email.com',     '2003-02-28'),
(9,  'Patricia Dias',   'patricia@email.com',  '2005-08-03'),
(10, 'Rafael Correia',  'rafael@email.com',    '2004-12-19');

-- =====================================================
-- Disciplinas
-- =====================================================
INSERT IGNORE INTO disciplinas (id, curso_id, nome, codigo, descricao, carga_horaria, periodo) VALUES
(1,  1,  'Programação Orientada a Objetos', 'POO-101', 'Lógica e paradigma OO',       80, 1),
(2,  2,  'Fundamentos de Redes',            'RED-101', 'Modelo OSI e protocolos',      60, 1),
(3,  1,  'Algoritmos e Estruturas de Dados','AED-102', 'Lógica de programação',        80, 1),
(4,  1,  'Banco de Dados',                  'BD-201',  'Modelagem e SQL',              80, 2),
(5,  2,  'Redes Avançadas',                 'RED-202', 'Infraestrutura e segurança',   60, 2),
(6,  3,  'Cálculo I',                       'MAT-101', 'Matemática diferencial',      100, 1),
(7,  4,  'Direito Civil',                   'DIR-101', 'Código civil brasileiro',      70, 1),
(8,  6,  'Projeto Arquitetônico',           'ARQ-201', 'Fundamentos de projeto',       90, 2),
(9,  7,  'Gestão Empresarial',              'ADM-101', 'Princípios de administração',  60, 1),
(10, 8,  'Psicologia do Comportamento',     'PSI-101', 'Comportamento humano',         60, 1);

-- =====================================================
-- Turmas
-- =====================================================
INSERT IGNORE INTO turmas (id, disciplina_id, professor_id, codigo, semestre, ano, vagas, sala) VALUES
(1,  1,  1,  'POO-101-A', 1, 2025, 40, 'Bloco A - Sala 101'),
(2,  2,  2,  'RED-101-B', 1, 2025, 35, 'Bloco B - Sala 202'),
(3,  3,  3,  'AED-102-C', 2, 2025, 40, 'Bloco A - Sala 103'),
(4,  4,  4,  'BD-201-D',  2, 2025, 38, 'Lab de Informática 1'),
(5,  5,  5,  'RED-202-E', 1, 2026, 35, 'Bloco B - Sala 204'),
(6,  6,  6,  'MAT-101-F', 1, 2026, 50, 'Bloco C - Sala 301'),
(7,  7,  7,  'DIR-101-G', 2, 2026, 45, 'Bloco D - Sala 401'),
(8,  8,  8,  'ARQ-201-H', 2, 2026, 30, 'Ateliê de Projetos'),
(9,  9,  9,  'ADM-101-I', 1, 2027, 42, 'Bloco E - Sala 501'),
(10, 10, 10, 'PSI-101-J', 1, 2027, 38, 'Bloco F - Sala 601');

-- =====================================================
-- Matrículas (substitui itemturma sem PK/status/FK corretas)
-- =====================================================
INSERT IGNORE INTO matriculas (aluno_id, turma_id, data_matricula, status) VALUES
(1,  1, '2025-01-20', 'Ativo'),
(2,  1, '2025-01-20', 'Ativo'),
(3,  2, '2025-01-21', 'Ativo'),
(4,  2, '2025-01-21', 'Concluído'),
(5,  3, '2025-07-15', 'Ativo'),
(6,  4, '2025-07-16', 'Ativo'),
(7,  5, '2026-01-18', 'Ativo'),
(8,  6, '2026-01-19', 'Trancado'),
(9,  7, '2026-07-20', 'Ativo'),
(10, 8, '2026-07-21', 'Ativo');

COMMIT;
