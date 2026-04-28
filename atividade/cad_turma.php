<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Cadastrar Turma';
$activePage = 'turmas';

$erro    = '';
$sucesso = '';
$disciplinas = [];
$professores = [];

try {
    $db = getDB();
    $disciplinas = $db->query("SELECT id, nome, codigo FROM disciplinas ORDER BY nome")->fetchAll();
    $professores = $db->query("SELECT id, nome FROM professores ORDER BY nome")->fetchAll();
} catch (PDOException $e) {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo        = trim($_POST['codigo']        ?? '');
    $disciplina_id = (int)($_POST['disciplina_id'] ?? 0);
    $professor_id  = (int)($_POST['professor_id']  ?? 0);
    $semestre      = trim($_POST['semestre']      ?? '');
    $ano           = (int)($_POST['ano']          ?? date('Y'));
    $vagas         = (int)($_POST['vagas']        ?? 0);
    $horario       = trim($_POST['horario']       ?? '');
    $sala          = trim($_POST['sala']          ?? '');

    if (!$codigo || !$disciplina_id) {
        $erro = 'Preencha os campos obrigatórios: Código e Disciplina.';
    } else {
        try {
            $db = getDB();
            $db->prepare(
                "INSERT INTO turmas (codigo, disciplina_id, professor_id, semestre, ano, vagas, horario, sala)
                 VALUES (:codigo, :disciplina_id, :professor_id, :semestre, :ano, :vagas, :horario, :sala)"
            )->execute([
                ':codigo'        => $codigo,
                ':disciplina_id' => $disciplina_id,
                ':professor_id'  => $professor_id ?: null,
                ':semestre'      => $semestre,
                ':ano'           => $ano,
                ':vagas'         => $vagas ?: null,
                ':horario'       => $horario,
                ':sala'          => $sala,
            ]);
            $sucesso = 'Turma <strong>' . htmlspecialchars($codigo) . '</strong> cadastrada com sucesso!';
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
  <a href="cons_turma.php">Turmas</a> <span>/</span>
  Cadastrar
</div>

<div class="page-header">
  <h1>Cadastrar Turma</h1>
  <p>Crie uma nova turma para o semestre</p>
</div>

<?php if ($erro):    ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title"><div class="icon">🗂️</div> Dados da Turma</div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Código da Turma *</label>
        <input type="text" name="codigo" value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" placeholder="Ex: AED-101-A" required>
      </div>

      <div class="form-group">
        <label>Disciplina *</label>
        <select name="disciplina_id" required>
          <option value="">Selecione a disciplina…</option>
          <?php foreach ($disciplinas as $d): ?>
            <option value="<?= $d['id'] ?>" <?= (int)($_POST['disciplina_id'] ?? 0) === $d['id'] ? 'selected' : '' ?>>
              [<?= htmlspecialchars($d['codigo']) ?>] <?= htmlspecialchars($d['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Professor</label>
        <select name="professor_id">
          <option value="">Selecione o professor…</option>
          <?php foreach ($professores as $p): ?>
            <option value="<?= $p['id'] ?>" <?= (int)($_POST['professor_id'] ?? 0) === $p['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($p['nome']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Vagas</label>
        <input type="number" name="vagas" value="<?= htmlspecialchars($_POST['vagas'] ?? '') ?>" placeholder="Ex: 40" min="1">
      </div>

      <div class="form-group">
        <label>Semestre</label>
        <select name="semestre">
          <option value="">Selecione…</option>
          <option value="1" <?= ($_POST['semestre'] ?? '') === '1' ? 'selected' : '' ?>>1º Semestre</option>
          <option value="2" <?= ($_POST['semestre'] ?? '') === '2' ? 'selected' : '' ?>>2º Semestre</option>
        </select>
      </div>

      <div class="form-group">
        <label>Ano</label>
        <input type="number" name="ano" value="<?= htmlspecialchars($_POST['ano'] ?? date('Y')) ?>" min="2000" max="2099">
      </div>

      <div class="form-group">
        <label>Horário</label>
        <input type="text" name="horario" value="<?= htmlspecialchars($_POST['horario'] ?? '') ?>" placeholder="Ex: Seg/Qua 08h-10h">
      </div>

      <div class="form-group">
        <label>Sala</label>
        <input type="text" name="sala" value="<?= htmlspecialchars($_POST['sala'] ?? '') ?>" placeholder="Ex: Bloco A - 203">
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">＋ Cadastrar Turma</button>
      <a href="cons_turma.php" class="btn btn-secondary">Ver todas as turmas</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
