<?php
// incluir conexão com o banco de dados
include("conectaDB.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // processar o formulário
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    $total = $_POST['total'];
    $codigo = $_POST['codigo'];

    // inserir pedido no banco de dados
    $sql_pedido = "INSERT INTO vendas (ven_data, fk_cli_id, ven_total, fk_iv_codigo, pro_id) VALUES (NOW(), '1', '$total', '$codigo', '$id_produto')";
    $resultado_pedido = mysqli_query($link, $sql_pedido);

    // verificar se o pedido foi inserido com sucesso
    if ($resultado_pedido) {
        // redirecionar para a página de pagamento
        header("Location: pagamento.php?id=" . mysqli_insert_id($link));
        exit();
    } else {
        echo "Erro ao adicionar o produto ao carrinho!";
    }
}
?>
