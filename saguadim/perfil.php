<?php
// Inclua o cabeçalho comum
include("cabecalho.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usu_id'])) {
}

// Recupera o ID do usuário da sessão
$usu_id = $_SESSION['usu_id'];

// Consulta o banco de dados para obter os dados do usuário
$sql = "SELECT * FROM usuarios WHERE usu_id = $usu_id";
$resultado = mysqli_query($link, $sql);

// Verifica se a consulta foi bem-sucedida e se encontrou o usuário
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Obtém os dados do usuário
    $usuario = mysqli_fetch_assoc($resultado);
} else {
    // Se não encontrar o usuário, exiba uma mensagem de erro ou redirecione
    echo "Erro: Usuário não encontrado.";
    exit();
}

// Feche a conexão com o banco de dados
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <!-- Adicione os estilos CSS aqui -->
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <p>Seja bem-vindo, <?php echo $usuario['usu_login']; ?>!</p>
    <p>Seu e-mail: <?php echo $usuario['usu_email']; ?></p>
    <p>Status da conta: <?php echo $usuario['usu_status'] == 'ativo' ? 'Ativo' : 'Inativo'; ?></p>

    <!-- Adicione mais informações do perfil conforme necessário -->

    <a href="editar_perfil.php">Editar Perfil</a>
    <a href="logout.php">Sair</a>

    <!-- Adicione o rodapé comum -->
    <?php include("rodape.php"); ?>
</body>
</html>
