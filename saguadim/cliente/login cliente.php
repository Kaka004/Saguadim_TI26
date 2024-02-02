<?php
session_start();
include("conectaDB.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    $stmt = $link->prepare("SELECT cli_id, cli_nome, cli_senha FROM clientes WHERE cli_email = ? AND cli_status = 's'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if($row && password_verify($senha, $row['cli_senha'])){
        $_SESSION['idcliente'] = $row['cli_id'];
        $_SESSION['nomecliente'] = $row['cli_nome'];
        header("Location: home.php");
        exit();
    } else{
        echo "<script>window.alert('E-MAIL OU SENHA INCORRETOS');</script>";
        echo "<script>window.alert('FAÇA SEU CADASTRO');</script>";
        echo "<script>window.location.href='login cliente.html';</script>";
        exit();
    }
}
?>
