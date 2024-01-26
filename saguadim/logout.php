<?php
session_start();

session_destroy();
header("Location: login.html"); // Use o caminho correto para login.html
exit;
?>
