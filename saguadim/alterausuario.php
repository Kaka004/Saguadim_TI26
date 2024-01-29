<?php
include("cabecalho.php");

// Verifica se o $id do usuário foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera os dados do usuário com base no $id
    $sql = "SELECT * FROM usuarios WHERE usu_id = $id";
    $resultado = mysqli_query($link, $sql);

    // Verifica se encontrou o usuário
    if ($resultado && $usuario = mysqli_fetch_assoc($resultado)) {
        // Exibe os dados do usuário no formulário
        $login = isset($usuario['usu_login']) ? $usuario['usu_login'] : ''; // Verifica se a chave 'usu_login' existe
        $status = isset($usuario['usu_status']) ? $usuario['usu_status'] : ''; // Adapte conforme necessário
    } else {
        // Usuário não encontrado, redireciona ou exibe uma mensagem de erro
        header("Location: listausuario.php"); // Você pode ajustar o redirecionamento conforme necessário
        exit();
    }
} else {
    // $id do usuário não fornecido, redireciona ou exibe uma mensagem de erro
    header("Location: listausuario.php"); // Você pode ajustar o redirecionamento conforme necessário
    exit();
}

// Processa os dados do formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados do formulário
    $novologin = mysqli_real_escape_string($link, $_POST['novo_login']);
    $novostatus = mysqli_real_escape_string($link, $_POST['novo_status']);

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET usu_login = '$novologin', usu_status = '$novostatus' WHERE usu_id = $id";
    mysqli_query($link, $sql);

    // Redireciona para a lista de usuários após a atualização
    header("Location: listausuario.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>Alterar Usuário</title>
</head>
<body>
    
    <form action="alterausuario.php?id=<?= $id ?>" method="post">
    <h1>Alterar Dados do Usuário</h1>
        <label for="novo_login">Novo login:</label>
        <input type="text" id="novo_login" name="novo_login" value="<?= $login ?>" required>

        <label for="novo_status">status:</label>
        <select id="novo_status" name="novo_status" required>
            <option value="s" <?= $status == 's' ? 'selected' : '' ?>>Sim</option>
            <option value="n" <?= $status == 'n' ? 'selected' : '' ?>>Não</option>
        </select>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
