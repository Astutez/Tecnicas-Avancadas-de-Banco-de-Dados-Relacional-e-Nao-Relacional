<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Cadastrar Disciplina';
$activePage = 'disciplinas';

$erro    = '';
$sucesso = '';
$cursos  = [];

try {
    $db = getDB();
    $cursos = $db->query("SELECT id, nome FROM cursos ORDER BY nome")->fetchAll();
} catch (PDOException $e) {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome']      ?? '');
    $codigo    = trim($_POST['codigo']    ?? '');
    $carga     = (int)($_POST['carga_horaria'] ?? 0);
    $curso_id  = (int)($_POST['curso_id'] ?? 0);
    $ementa    = trim($_POST['ementa']    ?? '');
    $periodo   = (int)($_POST['periodo']  ?? 0);

    if (!$nome || !$codigo) {
        $erro = 'Preencha os campos obrigatórios: Nome e Código.';
    } else {
        try {
            $db = getDB();
            $db->prepare(
                "INSERT INTO disciplinas (nome, codigo, carga_horaria, curso_id, ementa, periodo)
                 VALUES (:nome, :codigo, :carga, :curso_id, :ementa, :periodo)"
            )->execute([
                ':nome'     => $nome,
                ':codigo'   => $codigo,
                ':carga'    => $carga ?: null,
                ':curso_id' => $curso_id ?: null,
                ':ementa'   => $ementa,
                ':periodo'  => $periodo ?: null,
            ]);
            $sucesso = 'Disciplina <strong>' . htmlspecialchars($nome) . '</strong> cadastrada com sucesso!';
            $_POST = [];
        } catch (PDOException $e) {
            $erro = 'Erro: ' . htmlspecialchars($e->getMessage());
        }
    }
}

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span>
  <a href="cons_disciplina.php">Disciplinas</a> <span>/</span>
  Cadastrar
</div>

<div class="page-header">
  <h1>Cadastrar Disciplina</h1>
  <p>Adicione uma nova disciplina à grade curricular</p>
</div>

<?php if ($erro):    ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title"><div class="icon">📝</div> Dados da Disciplina</div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Nome da Disciplina *</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" placeholder="Ex: Algoritmos e Estruturas de Dados" required>
      </div>

      <div class="form-group">
        <label>Código *</label>
        <input type="text" name="codigo" value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" placeholder="Ex: AED-101" required>
      </div>

      <div class="form-group">
        <label>Curso</label>
        <select name="curso_id">
          <option value="">Selecione o curso…</option>
          <?php foreach ($cursos as $c): ?>
            <option value="<?= $c['id'] ?>" <?= (int)($_POST['curso_id'] ?? 0) === $c['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($c['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Carga Horária (horas)</label>
        <input type="number" name="carga_horaria" value="<?= htmlspecialchars($_POST['carga_horaria'] ?? '') ?>" placeholder="Ex: 60" min="1">
      </div>

      <div class="form-group">
        <label>Período / Semestre</label>
        <input type="number" name="periodo" value="<?= htmlspecialchars($_POST['periodo'] ?? '') ?>" placeholder="Ex: 3" min="1" max="12">
      </div>

      <div class="form-group form-full">
        <label>Ementa</label>
        <textarea name="ementa" placeholder="Descreva os tópicos e conteúdos da disciplina…"><?= htmlspecialchars($_POST['ementa'] ?? '') ?></textarea>
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">＋ Cadastrar Disciplina</button>
      <a href="cons_disciplina.php" class="btn btn-secondary">Ver todas as disciplinas</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
