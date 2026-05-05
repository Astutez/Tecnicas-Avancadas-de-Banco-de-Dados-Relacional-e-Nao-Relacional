<?php
// header.php — inclua no topo de todas as páginas
// Uso: include 'header.php'; com $pageTitle e $activePage definidos antes

$pageTitle = $pageTitle ?? 'Sistema Acadêmico';
$activePage = $activePage ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?> — AcadSystem</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topbar">
  <a href="index.php" class="topbar-brand">
    <div class="logo-icon">AS</div>
    <span>AcadSystem</span>
  </a>
  <nav class="topbar-nav">
    <a href="cons_aluno.php"      class="<?= $activePage === 'alunos'       ? 'active' : '' ?>">Alunos</a>
    <a href="cons_curso.php"      class="<?= $activePage === 'cursos'       ? 'active' : '' ?>">Cursos</a>
    <a href="cons_professor.php"  class="<?= $activePage === 'professores'  ? 'active' : '' ?>">Professores</a>
    <a href="cons_disciplina.php" class="<?= $activePage === 'disciplinas'  ? 'active' : '' ?>">Disciplinas</a>
    <a href="cons_turma.php"      class="<?= $activePage === 'turmas'       ? 'active' : '' ?>">Turmas</a>
    <a href="cons_matricula.php"  class="<?= $activePage === 'matriculas'   ? 'active' : '' ?>">Matrículas</a>
  </nav>
</header>

<main class="main">
