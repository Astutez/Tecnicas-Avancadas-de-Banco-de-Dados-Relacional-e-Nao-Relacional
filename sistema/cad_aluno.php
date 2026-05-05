<?php
session_start();
require_once 'db.php';

$pageTitle  = 'Cadastrar Aluno';
$activePage = 'alunos';

$erro   = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = trim($_POST['nome']    ?? '');
    $cpf     = trim($_POST['cpf']     ?? '');
    $email   = trim($_POST['email']   ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $nascimento = $_POST['nascimento'] ?? '';
    $endereco = trim($_POST['endereco'] ?? '');

    if (!$nome || !$cpf || !$email) {
        $erro = 'Preencha os campos obrigatórios: Nome, CPF e E-mail.';
    } else {
        try {
            $db = getDB();
            $stmt = $db->prepare(
                "INSERT INTO alunos (nome, cpf, email, telefone, data_nascimento, endereco)
                 VALUES (:nome, :cpf, :email, :telefone, :nascimento, :endereco)"
            );
            $stmt->execute([
                ':nome'       => $nome,
                ':cpf'        => $cpf,
                ':email'      => $email,
                ':telefone'   => $telefone,
                ':nascimento' => $nascimento ?: null,
                ':endereco'   => $endereco,
            ]);
            $sucesso = 'Aluno <strong>' . htmlspecialchars($nome) . '</strong> cadastrado com sucesso!';
            // Limpa campos após sucesso
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
  <a href="cons_aluno.php">Alunos</a> <span>/</span>
  Cadastrar
</div>

<div class="page-header">
  <h1>Cadastrar Aluno</h1>
  <p>Preencha os dados do novo aluno</p>
</div>

<?php if ($erro):   ?><div class="alert alert-danger">⚠ <?= $erro ?></div><?php endif; ?>
<?php if ($sucesso): ?><div class="alert alert-success">✓ <?= $sucesso ?></div><?php endif; ?>

<div class="card">
  <div class="card-title">
    <div class="icon">🎓</div>
    Dados do Aluno
  </div>

  <form method="POST">
    <div class="form-grid">

      <div class="form-group">
        <label>Nome completo *</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" placeholder="Ex: João da Silva" required>
      </div>

      <div class="form-group">
        <label>CPF *</label>
        <input type="text" name="cpf" value="<?= htmlspecialchars($_POST['cpf'] ?? '') ?>" placeholder="000.000.000-00" required>
      </div>

      <div class="form-group">
        <label>E-mail *</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="joao@email.com" required>
      </div>

      <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" placeholder="(11) 99999-0000">
      </div>

      <div class="form-group">
        <label>Data de Nascimento</label>
        <input type="date" name="nascimento" value="<?= htmlspecialchars($_POST['nascimento'] ?? '') ?>">
      </div>

      <div class="form-group form-full">
        <label>Endereço</label>
        <input type="text" name="endereco" value="<?= htmlspecialchars($_POST['endereco'] ?? '') ?>" placeholder="Rua, número, bairro, cidade">
      </div>

    </div>

    <div class="form-actions" style="margin-top:1.25rem;">
      <button type="submit" class="btn btn-primary">＋ Cadastrar Aluno</button>
      <a href="cons_aluno.php" class="btn btn-secondary">Ver todos os alunos</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
