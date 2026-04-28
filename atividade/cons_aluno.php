<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Consultar Alunos';
$activePage = 'alunos';

$alunos = [];
$erro   = '';
$busca  = trim($_GET['busca'] ?? '');

try {
    $db = getDB();

    if ($busca) {
        $stmt = $db->prepare(
            "SELECT * FROM alunos 
             WHERE nome LIKE :b 
                OR cpf LIKE :b 
                OR email LIKE :b 
                OR cidade LIKE :b
             ORDER BY id ASC"
        );
        $stmt->execute([':b' => "%$busca%"]);
    } else {
        $stmt = $db->query("SELECT * FROM alunos ORDER BY id ASC");
    }

    $alunos = $stmt->fetchAll();

} catch (PDOException $e) {
    $erro = 'Erro ao consultar: ' . htmlspecialchars($e->getMessage());
}

// Exclusão
if (isset($_GET['excluir'])) {
    try {
        $db = getDB();
        $db->prepare("DELETE FROM alunos WHERE id = :id")
           ->execute([':id' => (int)$_GET['excluir']]);

        header('Location: cons_aluno.php');
        exit;

    } catch (PDOException $e) {
        $erro = 'Erro ao excluir: ' . htmlspecialchars($e->getMessage());
    }
}

include 'header.php';
?>

<div class="breadcrumb">
  <a href="index.php">Início</a> <span>/</span>
  Alunos
</div>

<div class="page-header">
  <h1>Alunos</h1>
  <p><?= count($alunos) ?> aluno(s) encontrado(s)</p>
</div>

<?php if ($erro): ?>
  <div class="alert alert-danger">⚠ <?= $erro ?></div>
<?php endif; ?>

<div class="card">
  <div class="table-toolbar">
    <form method="GET" style="display:flex;gap:10px;flex:1;">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="busca" 
               value="<?= htmlspecialchars($busca) ?>" 
               placeholder="Buscar por nome, CPF, e-mail ou cidade…">
      </div>
      <button type="submit" class="btn btn-secondary">Buscar</button>
      <?php if ($busca): ?>
        <a href="cons_aluno.php" class="btn btn-secondary">Limpar</a>
      <?php endif; ?>
    </form>
    <a href="cad_aluno.php" class="btn btn-primary">＋ Novo Aluno</a>
  </div>

  <?php if (empty($alunos)): ?>
    <div class="empty-state">
      <div class="empty-icon">🎓</div>
      <p><?= $busca ? 'Nenhum aluno encontrado para essa busca.' : 'Nenhum aluno cadastrado ainda.' ?></p>
    </div>
  <?php else: ?>
  <div class="table-wrapper">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Cidade</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($alunos as $a): ?>
        <tr>
          <td><span class="badge badge-accent"><?= $a['id'] ?></span></td>
          <td><?= htmlspecialchars($a['nome']) ?></td>
          <td style="font-family:'JetBrains Mono',monospace;font-size:12px;">
            <?= htmlspecialchars($a['cpf']) ?>
          </td>
          <td><?= htmlspecialchars($a['email']) ?></td>
          <td><?= htmlspecialchars($a['telefone'] ?? '—') ?></td>
          <td><?= htmlspecialchars($a['cidade'] ?? '—') ?></td>
          <td>
            <div class="actions">
              <a href="cad_aluno.php?editar=<?= $a['id'] ?>" 
                 class="btn btn-secondary btn-sm">✏ Editar</a>

              <a href="cons_aluno.php?excluir=<?= $a['id'] ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Excluir <?= htmlspecialchars(addslashes($a['nome'])) ?>?')">
                 ✕
              </a>
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