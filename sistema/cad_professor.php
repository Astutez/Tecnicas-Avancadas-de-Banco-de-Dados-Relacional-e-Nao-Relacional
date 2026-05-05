<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Cadastrar Professor';
$activePage = 'professores';

$erro    = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome       = trim($_POST['nome']       ?? '');
    $cpf        = trim($_POST['cpf']        ?? '');
    $email      = trim($_POST['email']      ?? '');
    $telefone   = trim($_POST['telefone']   ?? '');
    $titulacao  = $_POST['titulacao']  ?? '';
    $especialidade = trim($_POST['especialidade'] ?? '');

    if (!$nome || !$email) {
        $erro = 'Preencha os campos obrigatórios: Nome e E-mail.';
    } else {
        try {
            $db = getDB();
            $db->prepare(
                "INSERT INTO professores (nome, cpf, email, telefone, titulacao, especialidade)
                 VALUES (:nome, :cpf, :email, :telefone, :titulacao, :especialidade)"
            )->execute([
                ':nome'          => $nome,
                ':cpf'           => $cpf,
                ':email'         => $email,
                ':telefone'      => $telefone,
                ':titulacao'     => $titulacao,
                ':especialidade' => $especialidade,
            ]);
            $sucesso = 'Professor <strong>' . htmlspecialchars($nome) . '</strong> cadastrado com sucesso!';
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
  <a href="cons_professor.php">Professores</a> <span>/</span>
  Cadastrar
</div>

<div class="page-header">
  <h1>Cadastrar Professor</h1>
  <p>Adicione um novo professor ao quadro docente</p>
</div>

<?php if ($erro):    ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title"><div class="icon">👨‍🏫</div> Dados do Professor</div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Nome completo *</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" placeholder="Ex: Dra. Ana Oliveira" required>
      </div>

      <div class="form-group">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>" placeholder="000.000.000-00">
      </div>

      <div class="form-group">
        <label>E-mail *</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="professor@inst.edu.br" required>
      </div>

      <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" placeholder="(11) 99999-0000">
      </div>

      <div class="form-group">
        <label>Titulação</label>
        <select name="titulacao">
          <option value="">Selecione…</option>
          <?php foreach (['Graduado','Especialista','Mestre','Doutor','Pós-Doutor'] as $t): ?>
            <option value="<?= $t ?>" <?= ($_POST['titulacao'] ?? '') === $t ? 'selected' : '' ?>><?= $t ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Especialidade</label>
        <input type="text" name="especialidade" value="<?= htmlspecialchars($_POST['especialidade'] ?? '') ?>" placeholder="Ex: Ciência de Dados">
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">＋ Cadastrar Professor</button>
      <a href="cons_professor.php" class="btn btn-secondary">Ver todos os professores</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
