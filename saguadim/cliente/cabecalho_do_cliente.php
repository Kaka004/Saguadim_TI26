<?php 
include("conectaDB.php");
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
isset($_SESSION['nomecliente']) ? $nomecliente = $_SESSION['nomecliente'] : "";
$nomecliente = $_SESSION['nomecliente'];
?>
<link rel="shortcut icon" href="./img/coxinhaaa.png" type="image/x-icon"> 
<div>
    <ul class="menu">
        <li><a href="home.php">HOME</a></li>
        <li><a href="produtos.php">PRODUTOS</a></li>

        <li class="menuloja"><a href="logout cliente.php">SAIR</a></li>
        
        <?php 
        if($nomecliente != null) {
        ?>
        <li class="profile">OLÁ <?=strtoupper($nomecliente) ?></li>
        <?php
        }
         else {
            echo "<script>window.alert('CLIENTE NÃO AUTENTICADO')
            window.location.href='login cliente.html';</script>";
        }
        ?>
    </ul>
</div>