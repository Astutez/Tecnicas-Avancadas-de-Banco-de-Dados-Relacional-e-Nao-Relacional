-- =====================================================
-- AcadSystem — Esquema do Banco de Dados
-- Execute este script no MySQL/MariaDB antes de usar
-- =====================================================

CREATE DATABASE IF NOT EXISTS academico
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE academico;

-- Alunos
CREATE TABLE IF NOT EXISTS alunos (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(150)  NOT NULL,
  cpf             VARCHAR(14)   UNIQUE,
  email           VARCHAR(120)  NOT NULL UNIQUE,
  telefone        VARCHAR(20),
  data_nascimento DATE,
  endereco        VARCHAR(255),
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cursos
CREATE TABLE IF NOT EXISTS cursos (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(150)  NOT NULL,
  codigo          VARCHAR(20)   NOT NULL UNIQUE,
  descricao       TEXT,
  carga_horaria   INT,
  nivel           ENUM('Graduação','Pós-Graduação','Técnico','Extensão','MBA'),
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Professores
CREATE TABLE IF NOT EXISTS professores (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(150)  NOT NULL,
  cpf             VARCHAR(14)   UNIQUE,
  email           VARCHAR(120)  NOT NULL UNIQUE,
  telefone        VARCHAR(20),
  titulacao       ENUM('Graduado','Especialista','Mestre','Doutor','Pós-Doutor'),
  especialidade   VARCHAR(100),
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Disciplinas
CREATE TABLE IF NOT EXISTS disciplinas (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nome            VARCHAR(150)  NOT NULL,
  codigo          VARCHAR(20)   NOT NULL UNIQUE,
  carga_horaria   INT,
  curso_id        INT,
  ementa          TEXT,
  periodo         TINYINT UNSIGNED,
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE SET NULL
);

-- Turmas
CREATE TABLE IF NOT EXISTS turmas (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  codigo          VARCHAR(30)   NOT NULL UNIQUE,
  disciplina_id   INT           NOT NULL,
  professor_id    INT,
  semestre        TINYINT,
  ano             YEAR,
  vagas           SMALLINT UNSIGNED,
  horario         VARCHAR(100),
  sala            VARCHAR(50),
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (disciplina_id) REFERENCES disciplinas(id) ON DELETE CASCADE,
  FOREIGN KEY (professor_id)  REFERENCES professores(id) ON DELETE SET NULL
);

-- Matrículas
CREATE TABLE IF NOT EXISTS matriculas (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id        INT NOT NULL,
  turma_id        INT NOT NULL,
  data_matricula  DATE,
  status          ENUM('Ativo','Trancado','Cancelado','Concluído') DEFAULT 'Ativo',
  criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uk_matricula (aluno_id, turma_id),
  FOREIGN KEY (aluno_id) REFERENCES alunos(id)  ON DELETE CASCADE,
  FOREIGN KEY (turma_id) REFERENCES turmas(id)  ON DELETE CASCADE
);

-- =====================================================
-- Dados de exemplo (opcional — remova se não quiser)
-- =====================================================

INSERT IGNORE INTO cursos (nome, codigo, nivel, carga_horaria) VALUES
  ('Ciência da Computação',  'CC-001',  'Graduação',     3200),
  ('Engenharia de Software', 'ES-002',  'Graduação',     3600),
  ('Análise e Desenvolvimento de Sistemas', 'ADS-003', 'Técnico', 2400);

INSERT IGNORE INTO professores (nome, email, titulacao, especialidade) VALUES
  ('Prof. Carlos Mendes',  'carlos@acad.edu.br', 'Doutor',   'Banco de Dados'),
  ('Profa. Beatriz Lima',  'beatriz@acad.edu.br','Mestre',   'Engenharia de Software'),
  ('Prof. Ricardo Souza',  'ricardo@acad.edu.br','Doutor',   'Inteligência Artificial');

INSERT IGNORE INTO alunos (nome, cpf, email) VALUES
  ('Ana Beatriz Costa',    '111.222.333-44', 'ana@email.com'),
  ('Lucas Ferreira',       '222.333.444-55', 'lucas@email.com'),
  ('Mariana Santos',       '333.444.555-66', 'mariana@email.com');

SELECT 'Banco criado com sucesso!' AS resultado;
