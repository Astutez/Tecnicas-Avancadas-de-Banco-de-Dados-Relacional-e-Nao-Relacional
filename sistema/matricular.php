<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Matricular Aluno';
$activePage = 'matriculas';

$erro    = '';
$sucesso = '';
$alunos  = [];
$turmas  = [];

try {
    $db = getDB();
    $alunos = $db->query("SELECT id, nome, cpf FROM alunos ORDER BY nome")->fetchAll();
    $turmas = $db->query(
        "SELECT t.id, t.codigo, d.nome AS disciplina, t.semestre, t.ano, t.vagas,
                (SELECT COUNT(*) FROM matriculas m WHERE m.turma_id = t.id) AS matriculados
         FROM turmas t
         LEFT JOIN disciplinas d ON d.id = t.disciplina_id
         ORDER BY t.ano DESC, t.semestre, t.codigo"
    )->fetchAll();
} catch (PDOException $e) {}

// Pré-seleciona turma via GET
$turmaPresel = (int)($_GET['turma_id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = (int)($_POST['aluno_id'] ?? 0);
    $turma_id = (int)($_POST['turma_id'] ?? 0);
    $data_matricula = $_POST['data_matricula'] ?? date('Y-m-d');

    if (!$aluno_id || !$turma_id) {
        $erro = 'Selecione o aluno e a turma.';
    } else {
        try {
            $db = getDB();
            // Verifica duplicidade
            $existe = $db->prepare("SELECT id FROM matriculas WHERE aluno_id = :a AND turma_id = :t");
            $existe->execute([':a' => $aluno_id, ':t' => $turma_id]);
            if ($existe->fetch()) {
                $erro = 'Este aluno já está matriculado nesta turma.';
            } else {
                $db->prepare(
                    "INSERT INTO matriculas (aluno_id, turma_id, data_matricula, status)
                     VALUES (:aluno_id, :turma_id, :data_matricula, 'Ativo')"
                )->execute([
                    ':aluno_id'       => $aluno_id,
                    ':turma_id'       => $turma_id,
                    ':data_matricula' => $data_matricula,
                ]);
                $sucesso = 'Matrícula realizada com sucesso!';
                $_POST = [];
            }
        } catch (PDOException $e) {
            $erro = 'Erro: ' . htmlspecialchars($e->getMessage());
        }
    }
}

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span>
  <a href="cons_matricula.php">Matrículas</a> <span>/</span>
  Matricular Aluno
</div>

<div class="page-header">
  <h1>Matricular Aluno</h1>
  <p>Vincule um aluno a uma turma</p>
</div>

<?php if ($erro):    ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title"><div class="icon">✅</div> Dados da Matrícula</div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Aluno *</label>
        <select name="aluno_id" required>
          <option value="">Selecione o aluno…</option>
          <?php foreach ($alunos as $a): ?>
            <option value="<?= $a['id'] ?>" <?= (int)($_POST['aluno_id'] ?? 0) === $a['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($a['nome']) ?> — <?= htmlspecialchars($a['cpf'] ?? '') ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Turma *</label>
        <select name="turma_id" required>
          <option value="">Selecione a turma…</option>
          <?php foreach ($turmas as $t):
            $selecionado = ($turmaPresel && $turmaPresel === $t['id']) || (int)($_POST['turma_id'] ?? 0) === $t['id'];
            $vagas_disp  = $t['vagas'] ? ($t['vagas'] - $t['matriculados']) : '∞';
          ?>
            <option value="<?= $t['id'] ?>" <?= $selecionado ? 'selected' : '' ?>>
              <?= htmlspecialchars($t['codigo']) ?> — <?= htmlspecialchars($t['disciplina'] ?? '') ?>
              (<?= $t['semestre'] ?>º/<?= $t['ano'] ?>) — Vagas: <?= $vagas_disp ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Data da Matrícula</label>
        <input type="date" name="data_matricula" value="<?= htmlspecialchars($_POST['data_matricula'] ?? date('Y-m-d')) ?>">
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">✅ Realizar Matrícula</button>
      <a href="cons_matricula.php" class="btn btn-secondary">Ver matrículas</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
