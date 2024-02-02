<?php
session_start();

session_destroy();
header("Location: login cliente.html");
exit;
?>