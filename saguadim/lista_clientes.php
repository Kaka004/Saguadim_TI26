<?php
#ABRIR CONEXÃO COM O SQL
include("cabecalho.php");

#Instrução para o sql
$sql = "SELECT * FROM clientes WHERE cli_status = 's'";
$retorno = mysqli_query($link, $sql);

$ativo ="s";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ativo = $_POST['ativo'];

    if($ativo == 's') {
        $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
    } elseif ($ativo == 'n') {
        $sql = "SELECT * FROM clientes WHERE cli_status = 'n'";
    } else{
        $sql = "SELECT * FROM clientes";
    }

    $retorno = mysqli_query($link, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>LISTA CLIENTES</title>
</head>
<body>
<div id="background ">
            <form action="lista_clientes.php" method="post">
                <input type="radio" name="ativo" class="radio" value="s"
                required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>ATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="n"
                required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>INATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="todos" 
                required onclick="submit()" <?= $ativo == 'todos' ? "checked" : "" ?>>TODOS

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

                    #FAZENDO PREECHIMENTO DE TABELA USANDO WHILE (ENQUANTO TEM DADOS PARA PREENCHER)
                    while ($tbl = mysqli_fetch_array($retorno)) {

                        #MAS AQUI EU FECHO PARA TRABLHAR COM HTML SIMULTANEAMENTE
                    ?>
                        <tr>
                            <td><?=$tbl[1] ?></td> <!--TRAZ SOMENTE A COLUNA 1 [NOME] DO BANCO -->
                            <td><?= $tbl[2]?></td>
                            <td><?= $tbl[3]?></td>
                            <td><?=$tbl[4]?></td>
                            <td><?=$tbl[5]?></td>
                            <td><?=$tbl[6]?></td>
                            <td><?=$tbl[9]?></td>

                            <!-- AO CLICAR NO BOTÃO ELE JÁ TRARÁ O ID DO USUÁRIO PARA A PÁGINA DO ALTERUSUARIO -->
                            <td><a href="alteracliente.php?id=<?=$tbl[0] ?>"><input type="button" value="ALTERAR DADOS"></a></td>

                            <td><?= $check = ($tbl[7] == "s") ? "SIM" : "NÃO" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    
</body>
</html>