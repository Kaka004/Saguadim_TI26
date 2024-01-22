<?php
    include("cabecalho.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilo2.css">
    <title>backoffice</title>
</head>
<body>
    <div id="container">
        <form action="cadastraproduto.php" method="post">
            <label for="">NOME PRODUTO</label>
            <input type="text" name="nome" id="nome">
            <label for="">DESCRIÇÃO</label>
            <textarea name="descricao" id="descricao"></textarea>
            <label for="">CUSTO</label>
            <input type="number" step="0.01" name="custo" id="custo">
            <label for="">PREÇO</label>
            <input type="decimal" name="preco" id="preco">
            <label for="">QUANTIDADE</label>
            <input type="number" name="quantidade" id="quantidade">
            <label for="">VALIDADE</label>
            <input type="date" name="validade" id="validade">

            <input type="submit" name="cadastrar" value="CADASTRAR">
        </form>
    </div>
</body>
</html>