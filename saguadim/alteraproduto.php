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
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $validade = $_POST['validade'];
    $status = $_POST['novo_status'];
    


    // Atualiza os dados do produto no banco de dados
    $sql = "UPDATE produtos SET pro_nome='$nome', pro_descricao= '$descricao', pro_custo='$custo', pro_preco='$preco', 
    pro_quantidade='$quantidade', pro_validade='$validade', pro_status='$status' WHERE pro_id=$produto_id";
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
        <link rel="stylesheet" href="./css/estilo2.css">
        <title>ALTERAR PRODUTO</title>
    </head>
    <body>
        <div id="background">
            <form action="alteraproduto.php?id=<?=$produto_id?>" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?=$produto['pro_nome']?>" required>
                <br>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" rows="5" cols="30"><?=$produto['pro_descricao']?></textarea>
                <br>
                <label for="custo">Custo (R$):</label>
                <input type="number" step="0.01" name="custo" value="<?=$produto['pro_custo']?>">
                <br>
                <label for="preco">Preço:</label>
                <input type="number" name="preco" step="0.01" value="<?=$produto['pro_preco']?>" required>
                <br>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" value="<?=$produto['pro_quantidade']?>">
                <br>
                <label for="validade">Validade:</label>
                <input type="date" name="validade" value="<?=$produto['pro_validade']?>">
                <br>
                <label for="novo_status">Status:</label>
                <select id="novo_status" name="novo_status" required>
                    <option value="s" <?= isset($produto['pro_status']) && 
                    $produto['pro_status'] == 's' ? 'selected' : '' ?>>Sim</option>
                    <option value="n" <?= isset($produto['pro_status']) && 
                    $produto['pro_status'] == 'n' ? 'selected' : '' ?>>Não</option>
                </select>
                <br>
                <input type="submit" value="ALTERAR">
            </form>
        </div>
    </body>
</html>
