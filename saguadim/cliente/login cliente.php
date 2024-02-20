<?php
session_start();
include("conectaDB.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    // credenciais do cliente
    $sql = "SELECT cli_id, cli_nome FROM clientes WHERE cli_email = '$email' AND cli_senha = '$senha' AND cli_status = 's'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    // consulta SQL na tabela clientes 
    $sqlLog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ('" .  mysqli_real_escape_string($link, $sql) . "', NOW())";
    mysqli_query($link, $sqlLog);

    if($row){
        $_SESSION['idcliente'] = $row['cli_id']; // Correção aqui
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
