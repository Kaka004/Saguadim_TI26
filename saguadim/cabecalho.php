<?php 
include("conectadb.php");
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$nomeusuario = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : ""; // Corrigido o operador ternário
?>
<link rel="shortcut icon" href="./img/coxinhaaa.png" type="image/x-icon"> 
<div>
    <ul class="menu">
        <li><a href="perfil_usuario.php">PERFIL</a></li>
        <li><a href="cadastraproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
        <li><a href="lista_clientes.php">LISTA CLIENTE</a></li>
        <!--<li><a href="encomendas.php">ENCOMENDAS</a></li>-->
        <li><a href="fornecedor.php">FORNECEDOR</a></li>
        <li><a href="backoffice.php">HOME</a></li>

        <li class="menuloja"><a href="logout.php">SAIR</a></li>
        
        <?php 
        if($nomeusuario != "") { // Corrigido o teste de nome de usuário
        ?>
        <li class="profile">OLÁ <?=strtoupper($nomeusuario) ?></li>
        <?php
        }
         else {
            echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO')</script>";
            echo "<script>window.location.href='login.html';</script>";
        }
        ?>
    </ul>
</div>
