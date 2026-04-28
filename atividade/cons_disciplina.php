<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Disciplinas';
$activePage = 'disciplinas';

$disciplinas = [];
$erro  = '';
$busca = trim($_GET['busca'] ?? '');

if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM disciplinas WHERE id = :id")->execute([':id' => (int)$_GET['excluir']]);
        header('Location: cons_disciplina.php'); exit;
    } catch (PDOException $e) { $erro = $e->getMessage(); }
}

try {
    $db = getDB();
    $sql = "SELECT d.*, c.nome AS curso_nome
            FROM disciplinas d
            LEFT JOIN cursos c ON c.id = d.curso_id";
    if ($busca) {
        $stmt = $db->prepare($sql . " WHERE d.nome LIKE :b OR d.codigo LIKE :b ORDER BY d.nome");
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query($sql . " ORDER BY d.nome");
    }
    $disciplinas = $stmt->fetchAll();
} catch (PDOException $e) { $erro = $e->getMessage(); }

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span> Disciplinas
</div>
<div class="page-header">
  <h1>Disciplinas</h1>
  <p><?= count($disciplinas) ?> disciplina(s) encontrada(s)</p>
</div>

<?php if ($erro): ?><div class="alert alert-danger">⚠ <?= htmlspecialchars($erro) ?></div><?php endif; ?>

<div class="card">
  <div class="table-toolbar">
    <form method="GET" style="display:flex;gap:10px;flex:1;">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por nome ou código…">
      </div>
      <button type="submit" class="btn btn-secondary">Buscar</button>
      <?php if ($busca): ?><a href="cons_disciplina.php" class="btn btn-secondary">Limpar</a><?php endif; ?>
    </form>
    <a href="cad_disciplina.php" class="btn btn-primary">＋ Nova Disciplina</a>
  </div>

  <?php if (empty($disciplinas)): ?>
    <div class="empty-state"><div class="empty-icon">📝</div><p>Nenhuma disciplina encontrada.</p></div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr><th>#</th><th>Código</th><th>Nome</th><th>Curso</th><th>C.H.</th><th>Período</th><th>Ações</th></tr>
      </thead>
      <tbody>
        <?php foreach ($disciplinas as $d): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $d['id'] ?></span></td>
          <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;"><?= htmlspecialchars($d['codigo']) ?></span></td>
          <td><?= htmlspecialchars($d['nome']) ?></td>
          <td><?= $d['curso_nome'] ? '<span class="badge badge-info">' . htmlspecialchars($d['curso_nome']) . '</span>' : '—' ?></td>
          <td><?= $d['carga_horaria'] ? $d['carga_horaria'] . 'h' : '—' ?></td>
          <td><?= $d['periodo'] ? $d['periodo'] . 'º' : '—' ?></td>
          <td>
            <div class="actions">
              <a href="cad_disciplina.php?editar=<?= $d['id'] ?>" class="btn btn-secondary btn-sm">✏ Editar</a>
              <a href="cons_disciplina.php?excluir=<?= $d['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir <?= htmlspecialchars(addslashes($d['nome'])) ?>?')">✕</a>
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
