<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);
    $login = mysqli_real_escape_string($link, $_POST['login']);

    $key = rand(100000, 999999);

    # INSERIR INSTRUÇÕES NO BANCO
    $sql = "SELECT COUNT(usu_id) FROM usuarios
            WHERE usu_email = '$email' OR usu_login = '$login'";
    
    $resultado = mysqli_query($link, $sql);

    if (!$resultado) {
        die('Erro na consulta SQL: ' . mysqli_error($link));
    }

    $resultado = mysqli_fetch_array($resultado)[0];

    ## GRAVA LOG
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
               VALUES ('$sql', NOW())";
    mysqli_query($link, $sqllog);

    # VERIFICA SE EXISTE
    if ($resultado >= 1) {
        echo "<script>window.alert('EMAIL OU LOGIN JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        $sql = "INSERT INTO usuarios
                (usu_login, usu_senha, usu_status, usu_key, usu_email)
                VALUES ('$login', '$senha', 's', '$key', '$email')";
        
        if (!mysqli_query($link, $sql)) {
            die('Erro na inserção de usuário: ' . mysqli_error($link));
        }

        ## GRAVA LOG
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data)
                   VALUES ('$sql', NOW())";
        mysqli_query($link, $sqllog);

        echo "<script>window.alert('USUÁRIO CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>
