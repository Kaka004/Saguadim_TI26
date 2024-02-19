<?php
session_start();
include("cabecalho.php");

// Verifica se o $id do usuário foi passado via GET
if (isset($_SESSION['idusuario'])) {
    $id = $_SESSION['idusuario'];

    // if (isset($_SESSION['idcliente'])) {
    //     $id = $_SESSION['idcliente'];

    // Escapar o ID para evitar SQL Injection
    $id = mysqli_real_escape_string($link, $id);

    // Recupera os dados do usuário com base no $id
    $sql = "SELECT * FROM usuarios WHERE usu_id = $id";
    $resultado = mysqli_query($link, $sql);

    // Verifica se encontrou o usuário
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Exibe os dados do usuário no formulário
        $usuario = mysqli_fetch_assoc($resultado);
        $nome = isset($usuario['usu_login']) ? $usuario['usu_login'] : '';
        $senha = isset($usuario['usu_senha']) ? $usuario['usu_senha'] : '';
        $email = isset($usuario['usu_email']) ? $usuario['usu_email'] : '';

    } else {
        echo "<script>window.alert('DADOS INVÁLIDOS');</script>";
        header("Location: usuario_altera_usuario.php");
        exit();
    }
}

// Processa os dados do formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados do formulário
    $novoNome = mysqli_real_escape_string($link, $_POST['novo_nome']);
    $novasenha = mysqli_real_escape_string($link, $_POST['nova_senha']);
    $novoEmail = mysqli_real_escape_string($link, $_POST[ 'novo_email' ] );

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET usu_login = '$novoNome', usu_senha = '$novasenha' , usu_email = '$novoEmail' WHERE usu_id = $id";
    mysqli_query($link, $sql);

    // Redireciona para a lista de usuários após a atualização
    header("Location: backoffice.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>PERFIL</title>
</head>
<body>
    
    <form action="usuario_altera_usuario.php?<?= $id ?>" method="post">
    <h1>Perfil admin</h1>
        <label for="novo_nome">Nome:</label>
        <input type="text" id="novo_nome" name="novo_nome" value="<?= $nome ?>" required>
        <label for="nova_senha">Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" pattern=".{5,}"  required>
        <label for="novo_email">Email:</label>
        <input type="text" name="novo_email" id="novo_email"  value="<?= $email ?>"required><br/>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
