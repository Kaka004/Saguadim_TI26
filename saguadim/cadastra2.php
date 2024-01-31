<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);
    $login = mysqli_real_escape_string($link, $_POST['login']);

    $key = rand(100000, 999999);

    # INSERIR INSTRUÇÕES NO BANCO
    $sql = "SELECT COUNT(usu_id) FROM usuarios
            WHERE usu_email = '$email' OR usu_login = '$login'";
    
    $resultado = mysqli_query($link, $sql);

    if (!$resultado) {
        die('Erro na consulta SQL: ' . mysqli_error($link));
    }

    $resultado = mysqli_fetch_array($resultado)[0];

    ## GRAVA LOG
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
               VALUES ('$sql', NOW())";
    echo($sqllog);           
    #mysqli_query($link, $sqllog);

    # VERIFICA SE EXISTE
    if ($resultado >= 1) {
        echo "<script>window.alert('EMAIL OU LOGIN JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        $sql = "INSERT INTO usuarios
                (usu_login, usu_senha, usu_status, usu_key, usu_email)
                VALUES ('$login', '$senha', 's', '$key', '$email')";
        
        if (!mysqli_query($link, $sql)) {
            die('Erro na inserção de usuário: ' . mysqli_error($link));
        }

        ## GRAVA LOG
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
                   VALUES ('$sql', NOW())";
        mysqli_query($link, $sqllog);

        echo "<script>window.alert('USUÁRIO CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
<div id="cadastra">
        <form action="cadastra.php" method="post">
                <label>NOME</label>
                <input type="text" name="login" placeholder="Nome Completo" required />
                <label>EMAIL</label>
                <input type="email" name="email" placeholder="nome.sala@curso.com" required />
                <label>TELEFONE</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(16) 91234-5678" required>
                <label>CPF</label>
                <input type="text" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
                <label>CURSO</label>
                <input type="text" name="curso" placeholder="Qual seu curso?" required/>
                <label>SALA</label>
                <input type="text" name="sala" id="sala" placeholder="Sala do Senac">
                <label>SENHA</label>
                <input type="password" name="senha" placeholder="*****" required />

                <input type="submit" value="CADASTRAR" />
          </form>
        </div>
    </div>
</body>
</html>