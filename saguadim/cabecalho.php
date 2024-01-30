<?php 
include("conectadb.php");
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];
?>
<link rel="shortcut icon" href="./img/coxinhaaa.png" type="image/x-icon"> 
<div>
    <ul class="menu">
        <li><a href="cadastra2.php">CADASTRAR USUARIO</a></li>
        <li><a href="listausuario.php">LISTAR USUARIO</a></li>
        <li><a href="cadastraproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listaproduto.php">LISTAR PRODUTO</a></li>
        <!--<li><a href="login-cliente.php">LOGIN CLIENTE</a></li>-->
        <!--<li><a href="cadastro-cliente.php">LISTA CLIENTE</a></li>-->
        <li><a href="fornecedor.php">FORNECEDOR</a></li>
        <li><a href="backoffice.php">HOME</a></li>
        <!--<li><a href="encomendas.php">ENCOMENDAS</a></li>-->

        <li class="menuloja"><a href="logout.php">SAIR</a></li>
        
        <?php 
        if($nomeusuario != null) {
        ?>
        <li class="profile">OLÁ <?=strtoupper($nomeusuario) ?></li>
        <?php
        }
         else {
            echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO')
            window.location.href='login.php';</script>";
        }
        ?>
    </ul>
</div>

