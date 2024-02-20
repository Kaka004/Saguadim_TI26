<?php
session_start();
include("conectaDB.php");

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Aqui você pode fazer o update na tabela item_venda para indicar que o pagamento foi efetuado
    $id_pedido = $_POST['id_pedido'];
    $sql_update_item_venda = "UPDATE item_venda SET iv_status='comprado' WHERE iv_id='$id_pedido'";
    $resultado_update = mysqli_query($link, $sql_update_item_venda);
    if ($resultado_update) {
        echo "Pagamento efetuado com sucesso!";
        echo "<script>window.alert('home.php')</script>";
    } else {
        echo "Erro ao processar o pagamento!";
    }
}
if(isset($_SESSION['email_usuario'])){
    $email_usuario = $_SESSION['email_usuario'];
} else{
    $email_usuario = 'kayo.vinicius034@gmail.com';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Pagamento</title>
</head>
<body>
    <form action="pagamento.php" method="post">
    <h1>Pagamento</h1>
        <label for="chave_pix">Chave PIX:</label><br>
        <input type="text" id="chave_pix" name="chave_pix" value="<?php echo htmlspecialchars($email_usuario); ?>" readonly>
        <br>
        <input type="hidden" name="id_pedido" value="<?php echo isset($_POST['id_pedido']) ? $_POST['id_pedido'] : ''; ?>">
        <input type="submit" value="Efetuar Pagamento">
    </form>
</body>
</html>
