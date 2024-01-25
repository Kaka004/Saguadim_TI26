<?php
include("cabecalho.php");

// Verifica se o ID do produto foi fornecido na URL
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Busca os dados do produto no banco de dados
    $sql = "SELECT * FROM produtos WHERE pro_id = $produto_id";
    $resultado = mysqli_query($link, $sql);

    if ($resultado) {
        $produto = mysqli_fetch_assoc($resultado);
    } else {
        // Trate o erro conforme necessário
        die("Erro ao buscar o produto no banco de dados: " . mysqli_error($link));
    }
} else {
    // Se o ID do produto não foi fornecido, redirecione para a página de lista de produtos
    header("Location: listaproduto.php");
    exit();
}

// Se o formulário foi enviado, atualize os dados do produto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome']; // Substitua 'nome' pelo nome do campo correspondente
    $preco = $_POST['preco']; // Substitua 'preco' pelo nome do campo correspondente

    // Adicione as demais variáveis conforme necessário

    // Atualiza os dados do produto no banco de dados
    $sql = "UPDATE produtos SET pro_nome='$nome', pro_preco='$preco' WHERE pro_id=$produto_id";
    $atualizacao = mysqli_query($link, $sql);

    if ($atualizacao) {
        // Redirecione para a página de lista de produtos após a atualização
        header("Location: listaproduto.php");
        exit();
    } else {
        // Trate o erro conforme necessário
        die("Erro ao atualizar o produto no banco de dados: " . mysqli_error($link));
    }
}
?>

<html>
    <head>
        <!-- Adicione os cabeçalhos necessários aqui -->
        <title>ALTERAR PRODUTO</title>
    </head>
    <body>
        <div id="background">
            <form action="alteraproduto.php?id=<?=$produto_id?>" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?=$produto['nome']?>" required>
                <br>
                <label for="preco">Preço:</label>
                <input type="text" name="preco" value="<?=$produto['preco']?>" required>
                <br>
                <!-- Adicione os demais campos do formulário conforme necessário -->

                <input type="submit" value="ALTERAR">
            </form>
        </div>
    </body>
</html>
