<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Turmas';
$activePage = 'turmas';

$turmas = [];
$erro   = '';
$busca  = trim($_GET['busca'] ?? '');

if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM turmas WHERE id = :id")->execute([':id' => (int)$_GET['excluir']]);
        header('Location: cons_turma.php'); exit;
    } catch (PDOException $e) { $erro = $e->getMessage(); }
}

try {
    $db = getDB();
    $sql = "SELECT t.*, d.nome AS disciplina_nome, d.codigo AS disciplina_codigo,
                   p.nome AS professor_nome
            FROM turmas t
            LEFT JOIN disciplinas d ON d.id = t.disciplina_id
            LEFT JOIN professores p ON p.id = t.professor_id";
    if ($busca) {
        $stmt = $db->prepare($sql . " WHERE t.codigo LIKE :b OR d.nome LIKE :b OR p.nome LIKE :b ORDER BY t.ano DESC, t.semestre, t.codigo");
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query($sql . " ORDER BY t.ano DESC, t.semestre, t.codigo");
    }
    $turmas = $stmt->fetchAll();
} catch (PDOException $e) { $erro = $e->getMessage(); }

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span> Turmas
</div>
<div class="page-header">
  <h1>Turmas</h1>
  <p><?= count($turmas) ?> turma(s) encontrada(s)</p>
</div>

<?php if ($erro): ?><div class="alert alert-danger">⚠ <?= htmlspecialchars($erro) ?></div><?php endif; ?>

<div class="card">
  <div class="table-toolbar">
    <form method="GET" style="display:flex;gap:10px;flex:1;">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por código, disciplina ou professor…">
      </div>
      <button type="submit" class="btn btn-secondary">Buscar</button>
      <?php if ($busca): ?><a href="cons_turma.php" class="btn btn-secondary">Limpar</a><?php endif; ?>
    </form>
    <a href="cad_turma.php" class="btn btn-primary">＋ Nova Turma</a>
  </div>

  <?php if (empty($turmas)): ?>
    <div class="empty-state"><div class="empty-icon">🗂️</div><p>Nenhuma turma encontrada.</p></div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr><th>#</th><th>Código</th><th>Disciplina</th><th>Professor</th><th>Período</th><th>Horário</th><th>Vagas</th><th>Ações</th></tr>
      </thead>
      <tbody>
        <?php foreach ($turmas as $t): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $t['id'] ?></span></td>
          <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:500;"><?= htmlspecialchars($t['codigo']) ?></span></td>
          <td><?= htmlspecialchars($t['disciplina_nome'] ?? '—') ?></td>
          <td><?= htmlspecialchars($t['professor_nome'] ?? '—') ?></td>
          <td>
            <?php if ($t['semestre'] && $t['ano']): ?>
              <span class="badge badge-info"><?= $t['semestre'] ?>º/<?= $t['ano'] ?></span>
            <?php else: ?>—<?php endif; ?>
          </td>
          <td style="font-size:12px;color:var(--text2);"><?= htmlspecialchars($t['horario'] ?? '—') ?></td>
          <td><?= $t['vagas'] ?? '—' ?></td>
          <td>
            <div class="actions">
              <a href="matricular.php?turma_id=<?= $t['id'] ?>" class="btn btn-secondary btn-sm">✅ Matricular</a>
              <a href="cad_turma.php?editar=<?= $t['id'] ?>" class="btn btn-secondary btn-sm">✏</a>
              <a href="cons_turma.php?excluir=<?= $t['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir turma <?= htmlspecialchars(addslashes($t['codigo'])) ?>?')">✕</a>
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
