<?php
#ABRIR CONEXÃO COM O SQL
include("cabecalho.php");

#Instrução para o sql
$sql = "SELECT * FROM clientes WHERE cli_status = 's'";
$retorno = mysqli_query($link, $sql);

$ativo = "s";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == 's') {
        $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
    } elseif ($ativo == 'n') {
        $sql = "SELECT * FROM clientes WHERE cli_status = 'n'";
    } else {
        $sql = "SELECT * FROM clientes";
    }

    $retorno = mysqli_query($link, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>LISTA CLIENTES</title>
</head>
<body>
    <div id="background ">
        <form action="lista_clientes.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required <?= $ativo == 's' ? "checked" : "" ?> onclick="this.form.submit()"> ATIVOS <br>
            <input type="radio" name="ativo" class="radio" value="n" required <?= $ativo == 'n' ? "checked" : "" ?> onclick="this.form.submit()"> INATIVOS <br>
            <input type="radio" name="ativo" class="radio" value="todos" required <?= $ativo == 'todos' ? "checked" : "" ?> onclick="this.form.submit()"> TODOS <br>
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>TELEFONE</th>
                    <th>CPF</th>
                    <th>CURSO</th>
                    <th>SALA</th>
                    <th>SENHA</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO</th>
                </tr>
                <!-- INICIO DE PHP + HTML -->
                <?php
                #FAZENDO PREENCHIMENTO DE TABELA USANDO WHILE (ENQUANTO TEM DADOS PARA PREENCHER)
                while ($tbl = mysqli_fetch_assoc($retorno)) {
                ?>
                    <tr>
                        <td><?= $tbl['cli_nome'] ?></td>
                        <td><?= $tbl['cli_email'] ?></td>
                        <td><?= $tbl['cli_telefone'] ?></td>
                        <td><?= $tbl['cli_cpf'] ?></td>
                        <td><?= $tbl['cli_curso'] ?></td>
                        <td><?= $tbl['cli_sala'] ?></td>
                        <td><?= $tbl['cli_senha'] ?></td>
                        <!-- AO CLICAR NO BOTÃO ELE JÁ TRARÁ O ID DO CLIENTE PARA A PÁGINA DE ALTERAÇÃO -->
                        <td><a href="alteracliente.php?id=<?= $tbl['cli_id'] ?>"><input type="button" value="ALTERAR DADOS"></a></td>
                        <td><?= $tbl['cli_status'] == "s" ? "SIM" : "NÃO" ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
