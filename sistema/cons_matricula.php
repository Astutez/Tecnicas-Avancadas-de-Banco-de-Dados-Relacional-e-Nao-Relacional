<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Matrículas';
$activePage = 'matriculas';

$matriculas = [];
$erro       = '';
$busca      = trim($_GET['busca'] ?? '');

if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM matriculas WHERE id = :id")->execute([':id' => (int)$_GET['excluir']]);
        header('Location: cons_matricula.php'); exit;
    } catch (PDOException $e) { $erro = $e->getMessage(); }
}

// Alteração de status via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status_id'])) {
    try {
        $db = getDB();
        $db->prepare("UPDATE matriculas SET status = :s WHERE id = :id")
           ->execute([':s' => $_POST['status'], ':id' => (int)$_POST['status_id']]);
        header('Location: cons_matricula.php'); exit;
    } catch (PDOException $e) { $erro = $e->getMessage(); }
}

try {
    $db = getDB();
    $sql = "SELECT m.id, m.data_matricula, m.status,
                   a.nome AS aluno_nome, a.cpf AS aluno_cpf,
                   t.codigo AS turma_codigo,
                   d.nome AS disciplina_nome,
                   p.nome AS professor_nome,
                   t.semestre, t.ano
            FROM matriculas m
            JOIN alunos a ON a.id = m.aluno_id
            JOIN turmas t ON t.id = m.turma_id
            LEFT JOIN disciplinas d ON d.id = t.disciplina_id
            LEFT JOIN professores p ON p.id = t.professor_id";
    if ($busca) {
        $stmt = $db->prepare($sql . " WHERE a.nome LIKE :b OR t.codigo LIKE :b OR d.nome LIKE :b ORDER BY m.data_matricula DESC");
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query($sql . " ORDER BY m.data_matricula DESC");
    }
    $matriculas = $stmt->fetchAll();
} catch (PDOException $e) { $erro = $e->getMessage(); }

$statusBadge = ['Ativo' => 'badge-success', 'Cancelado' => 'badge-danger', 'Trancado' => 'badge-warning', 'Concluído' => 'badge-info'];

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span> Matrículas
</div>
<div class="page-header">
  <h1>Matrículas</h1>
  <p><?= count($matriculas) ?> matrícula(s) encontrada(s)</p>
</div>

<?php if ($erro): ?><div class="alert alert-danger">⚠ <?= htmlspecialchars($erro) ?></div><?php endif; ?>

<div class="card">
  <div class="table-toolbar">
    <form method="GET" style="display:flex;gap:10px;flex:1;">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por aluno, turma ou disciplina…">
      </div>
      <button type="submit" class="btn btn-secondary">Buscar</button>
      <?php if ($busca): ?><a href="cons_matricula.php" class="btn btn-secondary">Limpar</a><?php endif; ?>
    </form>
    <a href="matricular.php" class="btn btn-primary">＋ Nova Matrícula</a>
  </div>

  <?php if (empty($matriculas)): ?>
    <div class="empty-state"><div class="empty-icon">✅</div><p>Nenhuma matrícula encontrada.</p></div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr><th>#</th><th>Aluno</th><th>Turma</th><th>Disciplina</th><th>Período</th><th>Data</th><th>Status</th><th>Ações</th></tr>
      </thead>
      <tbody>
        <?php foreach ($matriculas as $m): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $m['id'] ?></span></td>
          <td><?= htmlspecialchars($m['aluno_nome']) ?></td>
          <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;"><?= htmlspecialchars($m['turma_codigo']) ?></span></td>
          <td><?= htmlspecialchars($m['disciplina_nome'] ?? '—') ?></td>
          <td><?= $m['semestre'] && $m['ano'] ? $m['semestre'] . 'º/' . $m['ano'] : '—' ?></td>
          <td style="font-size:12px;color:var(--text2);">
            <?= $m['data_matricula'] ? date('d/m/Y', strtotime($m['data_matricula'])) : '—' ?>
          </td>
          <td>
            <span class="badge <?= $statusBadge[$m['status']] ?? 'badge-accent' ?>">
              <?= htmlspecialchars($m['status']) ?>
            </span>
          </td>
          <td>
            <div class="actions">
              <!-- Mini form para mudar status -->
              <form method="POST" style="display:inline;">
                <input type="hidden" name="status_id" value="<?= $m['id'] ?>">
                <select name="status" onchange="this.form.submit()"
                        style="background:var(--surface);border:1px solid var(--border);color:var(--text);
                               font-size:11px;padding:4px 6px;border-radius:6px;cursor:pointer;font-family:'Sora',sans-serif;">
                  <?php foreach (['Ativo','Trancado','Cancelado','Concluído'] as $s): ?>
                    <option value="<?= $s ?>" <?= $m['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
              <a href="cons_matricula.php?excluir=<?= $m['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir esta matrícula?')">✕</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
