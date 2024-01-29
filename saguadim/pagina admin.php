<?php
session_start();

include("cabecalho.php");

if (!isset($_SESSION['usuario_autenticado']) || $_SESSION['usuario_autenticado'] !== true || $_SESSION['nivel_acesso'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilo2.css">
    <title>Página Restrita - Admin</title>
</head>
<body>
    <h2>Bem-vindo à Página Restrita - Admin</h2>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
