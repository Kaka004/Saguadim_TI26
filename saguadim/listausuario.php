<?php
 session_start();
    #ABRE UMA CONEXÃO COM O BANCO DE DADOS
    include("cabecalho.php");
    
    $id = $_SESSION['idusuario'];

    #PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
    $sql = "SELECT * FROM usuarios WHERE usu_status = 's', usu_id = '$id'";
    $retorno = mysqli_query($link, $sql);
    $ativo = "s";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/estilo2.css">
        <title>LISTA USUARIOS</title>
    </head>
    <body>
        <div id="background ">
            <div class="container">
                <table border="1">
                    <tr>
                        <th>NOME</th>
                        <th>SENHA</th>
                        <th>EMAIL</th>
                        <th>PERFIL</th>
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
                            <!-- AO CLICAR NO BOTÃO ELE JÁ TRARÁ O ID DO USUÁRIO PARA A PÁGINA DO ALTERUSUARIO -->
                            <td><?= $tbl[2]?></td>
                            <td><?= $tbl[5]?></td>
                            <td><a href="perfil_usuario.php?id=<?=$tbl[0] ?>"><input type="button" value="PERFIL"></a></td>

                            <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>