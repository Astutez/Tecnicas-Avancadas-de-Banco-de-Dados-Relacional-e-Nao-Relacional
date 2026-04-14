<html>
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Aluno</title>
</head>
<body>

<?php

$passo = (isset($_POST['passo']) ? $_POST['passo'] : '0');

switch ($passo)
{
    case '0':
    { ?>
    
<form method="POST" action="aulahtmldb.php" name="form1">
  <table style="width: 50%;" align="center" border="1" cellpadding="5">
    
    <tr>
      <td colspan="2" align="center"><b>Cadastro de Aluno</b></td>
    </tr>

    <tr>
      <td>Nome:</td>
      <td><input name="nome" required></td>
    </tr>

    <tr>
      <td>Email:</td>
      <td><input name="email" type="email" required></td>
    </tr>

    <tr>
      <td>Idade:</td>
      <td><input name="idade" type="number" required></td>
    </tr>

    <tr>
      <input type="hidden" value="1" name="passo">
      <td><input type="reset" value="<< Limpar >>"></td>
      <td><input type="submit" value="<< Cadastrar >>"></td>
    </tr>

  </table>
</form>

<?php
    break;
    }

    case '1':
    {
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $idade = $_POST['idade'];

        include('./conect.php');

        // INSERT CORRETO (especificando campos)
        $query = "INSERT INTO aluno (nome, email, idade) 
                  VALUES ('$nome','$email','$idade')";

        $q1 = mysqli_query($con, $query);
?>

  <table style="width: 50%;" align="center" border="1" cellpadding="5">
    
    <tr>
      <td colspan="2" align="center"><b>Aluno Cadastrado</b></td>
    </tr>

    <tr>
      <td>Nome:</td>
      <td><input value="<?php echo $nome;?>" readonly></td>
    </tr>

    <tr>
      <td>Email:</td>
      <td><input value="<?php echo $email;?>" readonly></td>
    </tr>

    <tr>
      <td>Idade:</td>
      <td><input value="<?php echo $idade;?>" readonly></td>
    </tr>

    <tr>
      <td><a href="index.php">Início</a></td>

      <td>
        <form action="aulahtmldb.php" method="POST">
          <input type="hidden" name="passo" value="0">
          <input type="submit" value="<< Voltar >>">
        </form>
      </td>
    </tr>

  </table>

<?php
    break;
    }
}
?>

</body>
</html>