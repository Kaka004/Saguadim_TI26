<?php
session_start();
include("conectadb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' AND usu_senha = '$senha' AND usu_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $retorno = mysqli_fetch_array($retorno)[0];

    $sql = '"' . $sql . '"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    if ($retorno == 0) {
        echo "<script>window.alert('EMAIL OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
        $sql = "SELECT * FROM usuarios 
        WHERE usu_email = 'admin@admin.com'
        AND usu_senha = '1234'
        AND usu_status = 's'
        AND usu_nivel_acesso = '2'"; // Ajustado para o nível de acesso correspondente

        $retorno = mysqli_query($link, $sql);

        $sql = '"' . $sql . '"';
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);

        while ($tbl = mysqli_fetch_array($retorno)) {
            $_SESSION['idusuario'] = $tbl[0];
            $_SESSION['nomeusuario'] = $tbl[1];
            $_SESSION['nivel_acesso'] = $tbl['usu_nivel_acesso'];
        }

        if ($_SESSION['nivel_acesso'] == '2') { // Ajustado para o nível de acesso correspondente
            echo "<script>window.location.href='backoffice.php';</script>";
        } elseif ($_SESSION['nivel_acesso'] == 'cliente') {
            echo "<script>window.location.href='pagina_cliente.php';</script>";
        } else {
            echo "<script>window.alert('NÍVEL DE ACESSO INVÁLIDO');</script>";
            echo "<script>window.location.href='login.html';</script>";
        }
    }
}
?>
