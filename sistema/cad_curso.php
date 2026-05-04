<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Cadastrar Curso';
$activePage = 'cursos';

$erro    = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $codigo   = trim($_POST['codigo']   ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $carga    = (int)($_POST['carga_horaria'] ?? 0);
    $nivel    = $_POST['nivel'] ?? '';

    if (!$nome || !$codigo) {
        $erro = 'Preencha os campos obrigatórios: Nome e Código.';
    } else {
        try {
            $db = getDB();
            $stmt = $db->prepare(
                "INSERT INTO cursos (nome, codigo, descricao, carga_horaria, nivel)
                 VALUES (:nome, :codigo, :descricao, :carga, :nivel)"
            );
            $stmt->execute([
                ':nome'     => $nome,
                ':codigo'   => $codigo,
                ':descricao' => $descricao,
                ':carga'    => $carga ?: null,
                ':nivel'    => $nivel,
            ]);
            $sucesso = 'Curso <strong>' . htmlspecialchars($nome) . '</strong> cadastrado com sucesso!';
            $_POST = [];
        } catch (PDOException $e) {
            $erro = 'Erro ao cadastrar: ' . htmlspecialchars($e->getMessage());
        }
    }
}

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span>
  <a href="cons_curso.php">Cursos</a> <span>/</span>
  Cadastrar
</div>

<div class="page-header">
  <h1>Cadastrar Curso</h1>
  <p>Adicione um novo curso ao sistema</p>
</div>

<?php if ($erro):    ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title">
    <div class="icon">📚</div>
    Dados do Curso
  </div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Nome do Curso *</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" placeholder="Ex: Engenharia de Software" required>
      </div>

      <div class="form-group">
        <label>Código *</label>
        <input type="text" name="codigo" value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" placeholder="Ex: ENG-SW" required>
      </div>

      <div class="form-group">
        <label>Nível</label>
        <select name="nivel">
          <option value="">Selecione…</option>
          <?php foreach (['Graduação','Pós-Graduação','Técnico','Extensão','MBA'] as $n): ?>
            <option value="<?= $n ?>" <?= ($_POST['nivel'] ?? '') === $n ? 'selected' : '' ?>><?= $n ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Carga Horária (horas)</label>
        <input type="number" name="carga_horaria" value="<?= htmlspecialchars($_POST['carga_horaria'] ?? '') ?>" placeholder="Ex: 3200" min="1">
      </div>

      <div class="form-group form-full">
        <label>Descrição</label>
        <textarea name="descricao" placeholder="Descreva o curso, objetivos, público-alvo…"><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">＋ Cadastrar Curso</button>
      <a href="cons_curso.php" class="btn btn-secondary">Ver todos os cursos</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
