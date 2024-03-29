<?php
include("cabecalho.php");

// Verifica se o $id do cliente foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Recupera os dados do cliente com base no $id
    $sql = "SELECT * FROM clientes WHERE cli_id = $id";
    $resultado = mysqli_query($link, $sql);

    // Verifica se encontrou o cliente
    if ($resultado && $cliente = mysqli_fetch_assoc($resultado)) {
        // Exibe os dados do cliente no formulário
        $nome = isset($cliente['cli_nome']) ? $cliente['cli_nome'] : '';
        $login = isset($cliente['cli_email']) ? $cliente['cli_email'] : '';
        $telefone = isset($cliente['cli_telefone']) ? $cliente['cli_telefone'] : '';
        $cpf = isset($cliente['cli_cpf']) ? $cliente['cli_cpf'] : '';
        $curso = isset($cliente['cli_curso']) ? $cliente['cli_curso'] : '';
        $sala = isset($cliente['cli_sala']) ? $cliente['cli_sala'] : '';
        $senha = isset($cliente['cli_senha']) ? $cliente['cli_senha'] : '';
        $status = isset($cliente['cli_status']) ? $cliente['cli_status'] : '';

    } else {
        // Cliente não encontrado, redireciona ou exibe uma mensagem de erro
        header("Location: lista_clientes.php");
        exit();
    }
} else {
    // $id do cliente não fornecido, redireciona ou exibe uma mensagem de erro
    header("Location: lista_clientes.php");
    exit();
}

// Processa os dados do formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera os dados do formulário
    $novoNome = mysqli_real_escape_string($link, $_POST['novo_nome']);
    $novoEmail = mysqli_real_escape_string($link, $_POST['novo_login']);
    $novoTelefone = mysqli_real_escape_string($link, $_POST['novo_telefone']);
    $novoCpf = mysqli_real_escape_string($link, $_POST['novo_cpf']);
    $novoCurso = mysqli_real_escape_string($link, $_POST['novo_curso']);
    $novaSala = mysqli_real_escape_string($link, $_POST['nova_sala']);
    $novaSenha = mysqli_real_escape_string($link, $_POST['nova_senha']);
    $novoStatus = mysqli_real_escape_string($link, $_POST['novo_status']);

    // Atualiza os dados do cliente no banco de dados
    $sql = "UPDATE clientes SET cli_nome = '$novoNome', cli_email = '$novoEmail',cli_telefone = '$novoTelefone',
    cli_cpf = '$novoCpf', cli_curso = '$novoCurso', cli_sala = '$novaSala', cli_senha = '$novaSenha', cli_status = '$novoStatus' WHERE cli_id = $id";
    mysqli_query($link, $sql);

    // Redireciona para a lista de clientes após a atualização
    header("Location: lista_clientes.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>Área Cliete</title>
</head>
<body>
    
    <form action="alteracliente.php?id=<?= $id ?>" method="post">
    <h1>Alterar Dados do Cliente</h1>
        <label for="novo_nome"> Nome Completo: </label>
        <input type="text" id="novo_nome" name="novo_nome" value="<?= $nome ?>" required>
        <label for="novo_login">Novo login:</label>
        <input type="text" id="novo_login" name="novo_login" value="<?= $login ?>" required>
        <label for="novo_telefone">Telefone</label>
        <input type="tel" name="novo_telefone" id="novo_telefone" value="<?= $telefone ?>">
        <label for="novo_cpf">CPF:</label>
        <input type="text" name="novo_cpf" id="novo_cpf" value="<?=  $cpf ?>" required>
        <label for="novo_curso">Curso:</label>
        <input type="text" name="novo_curso" id="novo_curso"  value="<?= $curso ?>" required>
        <label for="nova_sala">Sala:</label>
        <input type="number" name="nova_sala" id="nova_sala" value="<?= $sala ?>" required>
        <label for="nova_senha">Senha:</label>
        <input type="password" id="nova_senha" pattern=".{5,}" name="nova_senha" placeholder="*****" required>

        <label for="novo_status">status:</label>
        <select id="novo_status" name="novo_status" required>
            <option value="s" <?= $status == 's' ? 'selected' : '' ?>>Sim</option>
            <option value="n" <?= $status == 'n' ? 'selected' : '' ?>>Não</option>
        </select>

        <button type="submit">Salvar Alterações</button>
    </form>
    <script>
        function toggleForm(show, hide) {
            document.getElementById(show).style.display = 'block';
            document.getElementById(hide).style.display = 'none';
        };
    </script>
</body>
</html>
