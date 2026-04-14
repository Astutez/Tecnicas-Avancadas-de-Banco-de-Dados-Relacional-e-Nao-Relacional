<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consulta de Alunos</title>
</head>
<body>

<?php
include('./conect.php');

// Consulta
$query = "SELECT * FROM aluno";
$result = mysqli_query($con, $query);
?>

<table style="width: 60%; margin: auto; text-align: center;"
       border="1" cellpadding="10">

    <tr>
        <td colspan="4"><b>Lista de Alunos</b></td>
    </tr>

    <tr>
        <td><b>ID</b></td>
        <td><b>Nome</b></td>
        <td><b>Email</b></td>
        <td><b>Idade</b></td>
    </tr>

    <?php
    while($linha = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>".$linha['idaluno']."</td>";
        echo "<td>".$linha['nome']."</td>";
        echo "<td>".$linha['email']."</td>";
        echo "<td>".$linha['idade']."</td>";
        echo "</tr>";
    }
    ?>

    <tr>
        <td colspan="4">
            <a href="index.php"><< Voltar</a>
        </td>
    </tr>

</table>

</body>
</html>