<?php
session_start();
include("conectaDB.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Verificar se o cliente já possui esse produto no carrinho
    $sql_verifica_produto = "SELECT * FROM item_venda WHERE fk_pro_id = '$produto_id' AND iv_status = 'pendente'";
    $resultado_verifica = mysqli_query($link, $sql_verifica_produto);
    if (mysqli_num_rows($resultado_verifica) > 0) {
        // O cliente já possui esse produto no carrinho, então vamos atualizar a quantidade
        $row = mysqli_fetch_assoc($resultado_verifica);
        $nova_quantidade = $row['iv_quantidade'] + $quantidade;
        $sql_update_quantidade = "UPDATE item_venda SET iv_quantidade = '$nova_quantidade' WHERE iv_id = '" . $row['iv_id'] . "'";
        $resultado_update_quantidade = mysqli_query($link, $sql_update_quantidade);
        if ($resultado_update_quantidade) {
            echo "Quantidade do produto atualizada no carrinho com sucesso!";
        } else {
            echo "Erro ao atualizar a quantidade do produto no carrinho!";
        }
    } else {
        // O cliente não possui esse produto no carrinho, então vamos inseri-lo
        $sql_insert_item_venda = "INSERT INTO item_venda (iv_quantidade, iv_total, iv_codigo, fk_pro_id) VALUES ('$quantidade', NULL, NULL, '$produto_id')";
        $resultado_insert = mysqli_query($link, $sql_insert_item_venda);
        if ($resultado_insert) {
            echo "Produto adicionado ao carrinho com sucesso!";
        } else {
            echo "Erro ao adicionar o produto ao carrinho!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Selecionar Quantidade</title>
</head>
<body>
    <form id="form_carrinho" action="adicionar_carrinho.php" method="post">
        <h1>Selecione a Quantidade</h1>
        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" value="1" required>
        <!-- Adicionando o código PHP para passar o ID do produto -->
        <?php
        if (isset($_GET['produto_id'])) {
            $produto_id = $_GET['produto_id'];
            echo '<input type="hidden" name="produto_id" value="' . $produto_id . '">';
        }
        ?>
        <input type="submit" value="Adicionar">
    </form>

    <script>
        // Função para redirecionar para pagamento.php após o envio do formulário
        document.getElementById("form_carrinho").addEventListener("submit", function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário
            this.submit(); // Envio manual do formulário
            window.location.href = "pagamento.php"; // Redirecionamento para pagamento.php
        });
    </script>
</body>
</html>

