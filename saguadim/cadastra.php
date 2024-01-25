<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    $key = rand(100000, 999999);

    # Verifica se o email já existe
    $sql_select = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = ?";
    $stmt_select = mysqli_prepare($link, $sql_select);
    mysqli_stmt_bind_param($stmt_select, "s", $email);
    mysqli_stmt_execute($stmt_select);
    mysqli_stmt_bind_result($stmt_select, $resultado);
    mysqli_stmt_fetch($stmt_select);
    mysqli_stmt_close($stmt_select);

    ## GRAVA LOG
    $sqllog_select = "INSERT INTO tab_log (tab_query, tab_data) VALUES (?, NOW())";
    $stmtlog_select = mysqli_prepare($link, $sqllog_select);
    mysqli_stmt_bind_param($stmtlog_select, "s", $sql_select);
    mysqli_stmt_execute($stmtlog_select);
    mysqli_stmt_close($stmtlog_select);

    # Verifica se o email já existe
    if ($resultado >= 1) {
        echo "<script>window.alert('EMAIL JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        # Insere novo usuário
        $sql_insert = "INSERT INTO usuarios (usu_senha, usu_status, usu_key, usu_email) VALUES (?, 's', ?, ?)";
        $stmt_insert = mysqli_prepare($link, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "sss", $senha, $key, $email);
        mysqli_stmt_execute($stmt_insert);
        mysqli_stmt_close($stmt_insert);

        ## GRAVA LOG
        $sqllog_insert = "INSERT INTO tab_log (tab_query, tab_data) VALUES (?, NOW())";
        $stmtlog_insert = mysqli_prepare($link, $sqllog_insert);
        mysqli_stmt_bind_param($stmtlog_insert, "s", $sql_insert);
        mysqli_stmt_execute($stmtlog_insert);
        mysqli_stmt_close($stmtlog_insert);

        echo "<script>window.alert('USUÁRIO CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>
