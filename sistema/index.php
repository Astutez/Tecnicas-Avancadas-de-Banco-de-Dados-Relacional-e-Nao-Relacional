<?php
session_start();
$pageTitle  = 'Dashboard';
$activePage = 'home';
include 'header.php';
include 'db.php';

// Tenta buscar contagens do banco (silenciosamente)
$counts = ['alunos' => 0, 'cursos' => 0, 'professores' => 0, 'disciplinas' => 0, 'turmas' => 0, 'matriculas' => 0];
try {
    $db = getDB();
    foreach (['alunos', 'cursos', 'professores', 'disciplinas', 'turmas', 'matriculas'] as $t) {
        $counts[$t] = $db->query("SELECT COUNT(*) FROM $t")->fetchColumn();
    }
} catch (Exception $e) { /* banco ainda não configurado */ }
?>

<div class="page-header">
  <h1>Dashboard</h1>
  <p>Bem-vindo ao Sistema de Gerenciamento Acadêmico</p>
</div>

<!-- Stats -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-label">Alunos</div>
    <div class="stat-value"><?= $counts['alunos'] ?></div>
    <div class="stat-sub">cadastrados</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Cursos</div>
    <div class="stat-value"><?= $counts['cursos'] ?></div>
    <div class="stat-sub">ativos</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Professores</div>
    <div class="stat-value"><?= $counts['professores'] ?></div>
    <div class="stat-sub">cadastrados</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Turmas</div>
    <div class="stat-value"><?= $counts['turmas'] ?></div>
    <div class="stat-sub">abertas</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Matrículas</div>
    <div class="stat-value"><?= $counts['matriculas'] ?></div>
    <div class="stat-sub">realizadas</div>
  </div>
</div>

<!-- Módulos -->
<div class="module-grid">

  <div class="module-card">
    <div class="mod-icon">🎓</div>
    <div class="mod-title">Alunos</div>
    <div class="mod-desc">Cadastro e consulta de alunos matriculados</div>
    <div class="mod-links">
      <a href="cad_aluno.php">＋ Cadastrar Aluno</a>
      <a href="cons_aluno.php">⊟ Consultar Alunos</a>
    </div>
  </div>

  <div class="module-card">
    <div class="mod-icon">📚</div>
    <div class="mod-title">Cursos</div>
    <div class="mod-desc">Gerenciamento de cursos oferecidos</div>
    <div class="mod-links">
      <a href="cad_curso.php">＋ Cadastrar Curso</a>
      <a href="cons_curso.php">⊟ Consultar Cursos</a>
    </div>
  </div>

  <div class="module-card">
    <div class="mod-icon">👨‍🏫</div>
    <div class="mod-title">Professores</div>
    <div class="mod-desc">Corpo docente e suas informações</div>
    <div class="mod-links">
      <a href="cad_professor.php">＋ Cadastrar Professor</a>
      <a href="cons_professor.php">⊟ Consultar Professores</a>
    </div>
  </div>

  <div class="module-card">
    <div class="mod-icon">📝</div>
    <div class="mod-title">Disciplinas</div>
    <div class="mod-desc">Disciplinas disponíveis na grade curricular</div>
    <div class="mod-links">
      <a href="cad_disciplina.php">＋ Cadastrar Disciplina</a>
      <a href="cons_disciplina.php">⊟ Consultar Disciplinas</a>
    </div>
  </div>

  <div class="module-card">
    <div class="mod-icon">🗂️</div>
    <div class="mod-title">Turmas</div>
    <div class="mod-desc">Turmas e seus horários e docentes</div>
    <div class="mod-links">
      <a href="cad_turma.php">＋ Cadastrar Turma</a>
      <a href="cons_turma.php">⊟ Consultar Turmas</a>
    </div>
  </div>

  <div class="module-card">
    <div class="mod-icon">✅</div>
    <div class="mod-title">Matrículas</div>
    <div class="mod-desc">Vinculação de alunos às turmas</div>
    <div class="mod-links">
      <a href="matricular.php">＋ Matricular Aluno</a>
      <a href="cons_matricula.php">⊟ Consultar Matrículas</a>
    </div>
  </div>

</div>

<?php include 'footer.php'; ?>
