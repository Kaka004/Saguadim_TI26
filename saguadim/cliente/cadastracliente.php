<?php
include("cabecalho_do_cliente.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($link, $_POST['nome']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $telefone = mysqli_real_escape_string($link, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($link, $_POST['cpf']);
    $curso = mysqli_real_escape_string($link, $_POST['curso']);
    $sala = mysqli_real_escape_string($link, $_POST['sala']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    $key = rand(100000, 999999);

    # Verifica se o email já existe
    $sql_select = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = ?";
    $stmt_select = mysqli_prepare($link, $sql_select);

    if ($stmt_select) {
        mysqli_stmt_bind_param($stmt_select, "s", $email);
        mysqli_stmt_execute($stmt_select);
        mysqli_stmt_bind_result($stmt_select, $resultado);
        mysqli_stmt_fetch($stmt_select);
        mysqli_stmt_close($stmt_select);
    } else {
        die("Erro na preparação da consulta: " . mysqli_error($link));
    }

    # Verifica se o email já existe
    if ($resultado >= 1) {
        echo "<script>window.alert('EMAIL JÁ EXISTENTE');</script>";
        return;
    } else {
        # Insere novo cliente
        $sql_insert = "INSERT INTO clientes (cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala, cli_status, cli_saldo, cli_senha) 
        VALUES (?, ?, ?, ?, ?, ?, 's', 0, ?)";
        $stmt_insert = mysqli_prepare($link, $sql_insert);

        if ($stmt_insert) {
            mysqli_stmt_bind_param($stmt_insert, 'ssssssi', $nome, $email, $telefone, $cpf, $curso, $sala, $senha);
            mysqli_stmt_execute($stmt_insert);
            mysqli_stmt_close($stmt_insert);

            echo "<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
            echo "<script>window.location.href='login cliente.html';</script>";
        } else {
            die("Erro na preparação da consulta: " . mysqli_error($link));
        }
    }
}
?>
