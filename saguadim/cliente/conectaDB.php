<?php
#CONECTA COM O SERVIDOR (XAMPP)
$servidor = "localhost";
#nome do banco
$banco = "saguadim";
#nome do usuário
$usuario = "root";
#senha do usuario
$senha = "";
#link de conexão com o banco
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
?>