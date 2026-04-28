<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Cursos';
$activePage = 'cursos';

$cursos = [];
$erro   = '';
$busca  = trim($_GET['busca'] ?? '');

if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM cursos WHERE id = :id")->execute([':id' => (int)$_GET['excluir']]);
        header('Location: cons_curso.php'); exit;
    } catch (PDOException $e) { $erro = 'Erro ao excluir: ' . $e->getMessage(); }
}

try {
    $db = getDB();
    if ($busca) {
        $stmt = $db->prepare("SELECT * FROM cursos WHERE nome LIKE :b OR codigo LIKE :b ORDER BY nome");
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query("SELECT * FROM cursos ORDER BY nome");
    }
    $cursos = $stmt->fetchAll();
} catch (PDOException $e) { $erro = $e->getMessage(); }

$nivelBadge = ['Graduação' => 'badge-info', 'Pós-Graduação' => 'badge-warning', 'Técnico' => 'badge-success', 'Extensão' => 'badge-accent', 'MBA' => 'badge-danger'];

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span> Cursos
</div>
<div class="page-header">
  <h1>Cursos</h1>
  <p><?= count($cursos) ?> curso(s) cadastrado(s)</p>
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
      <?php if ($busca): ?><a href="cons_curso.php" class="btn btn-secondary">Limpar</a><?php endif; ?>
    </form>
    <a href="cad_curso.php" class="btn btn-primary">＋ Novo Curso</a>
  </div>

  <?php if (empty($cursos)): ?>
    <div class="empty-state">
      <div class="empty-icon">📚</div>
      <p>Nenhum curso encontrado.</p>
    </div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr><th>#</th><th>Código</th><th>Nome</th><th>Nível</th><th>Carga Horária</th><th>Ações</th></tr>
      </thead>
      <tbody>
        <?php foreach ($cursos as $c): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $c['id'] ?></span></td>
          <td><span style="font-family:'JetBrains Mono',monospace;font-size:12px;"><?= htmlspecialchars($c['codigo']) ?></span></td>
          <td><?= htmlspecialchars($c['nome']) ?></td>
          <td><?php if ($c['nivel']): ?>
            <span class="badge <?= $nivelBadge[$c['nivel']] ?? 'badge-accent' ?>"><?= htmlspecialchars($c['nivel']) ?></span>
          <?php else: ?>—<?php endif; ?></td>
          <td><?= $c['carga_horaria'] ? $c['carga_horaria'] . 'h' : '—' ?></td>
          <td>
            <div class="actions">
              <a href="cad_curso.php?editar=<?= $c['id'] ?>" class="btn btn-secondary btn-sm">✏ Editar</a>
              <a href="cons_curso.php?excluir=<?= $c['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir <?= htmlspecialchars(addslashes($c['nome'])) ?>?')">✕</a>
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
