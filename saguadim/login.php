<?php
session_start();
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    // Verificar as credenciais do usuário
    $sql = "SELECT usu_id, usu_login FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    // Log da consulta SQL
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ('" . mysqli_real_escape_string($link, $sql) . "', NOW())";
    mysqli_query($link, $sqllog);

    if ($row) {
        // Credenciais corretas
        $_SESSION['idusuario'] = $row['usu_id'];
        $_SESSION['nomeusuario'] = $row['usu_login'];

        header("Location: backoffice.php");
        exit();
    } else {
        // Credenciais incorretas
        echo "<script>window.alert('E-MAIL OU SENHA INCORRETOS');</script>";
        echo "<script>window.alert('FAÇA SEU CADASTRO');</script>";
        echo "<script>window.location.href='login.html';</script>";
        exit();
    }
}
?>