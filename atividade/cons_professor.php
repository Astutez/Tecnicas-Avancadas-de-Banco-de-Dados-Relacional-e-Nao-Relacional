<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Professores';
$activePage = 'professores';

$professores = [];
$erro  = '';
$busca = trim($_GET['busca'] ?? '');

if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM professores WHERE id = :id")->execute([':id' => (int)$_GET['excluir']]);
        header('Location: cons_professor.php'); exit;
    } catch (PDOException $e) { $erro = $e->getMessage(); }
}

try {
    $db = getDB();
    if ($busca) {
        $stmt = $db->prepare("SELECT * FROM professores WHERE nome LIKE :b OR email LIKE :b OR especialidade LIKE :b ORDER BY nome");
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query("SELECT * FROM professores ORDER BY nome");
    }
    $professores = $stmt->fetchAll();
} catch (PDOException $e) { $erro = $e->getMessage(); }

$titBadge = ['Doutor' => 'badge-success', 'Pós-Doutor' => 'badge-warning', 'Mestre' => 'badge-info', 'Especialista' => 'badge-accent', 'Graduado' => 'badge-danger'];

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span> Professores
</div>
<div class="page-header">
  <h1>Professores</h1>
  <p><?= count($professores) ?> professor(es) encontrado(s)</p>
</div>

<?php if ($erro): ?><div class="alert alert-danger">⚠ <?= htmlspecialchars($erro) ?></div><?php endif; ?>

<div class="card">
  <div class="table-toolbar">
    <form method="GET" style="display:flex;gap:10px;flex:1;">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Buscar por nome, e-mail ou especialidade…">
      </div>
      <button type="submit" class="btn btn-secondary">Buscar</button>
      <?php if ($busca): ?><a href="cons_professor.php" class="btn btn-secondary">Limpar</a><?php endif; ?>
    </form>
    <a href="cad_professor.php" class="btn btn-primary">＋ Novo Professor</a>
  </div>

  <?php if (empty($professores)): ?>
    <div class="empty-state"><div class="empty-icon">👨‍🏫</div><p>Nenhum professor encontrado.</p></div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr><th>#</th><th>Nome</th><th>Titulação</th><th>Especialidade</th><th>E-mail</th><th>Ações</th></tr>
      </thead>
      <tbody>
        <?php foreach ($professores as $p): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $p['id'] ?></span></td>
          <td><?= htmlspecialchars($p['nome']) ?></td>
          <td><?php if ($p['titulacao']): ?>
            <span class="badge <?= $titBadge[$p['titulacao']] ?? 'badge-accent' ?>"><?= htmlspecialchars($p['titulacao']) ?></span>
          <?php else: ?>—<?php endif; ?></td>
          <td><?= htmlspecialchars($p['especialidade'] ?? '—') ?></td>
          <td><?= htmlspecialchars($p['email']) ?></td>
          <td>
            <div class="actions">
              <a href="cad_professor.php?editar=<?= $p['id'] ?>" class="btn btn-secondary btn-sm">✏ Editar</a>
              <a href="cons_professor.php?excluir=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir <?= htmlspecialchars(addslashes($p['nome'])) ?>?')">✕</a>
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
