<?php

session_start();

$_SESSION["palabra"] = $_POST["palabra"];

$_SESSION["letras"] = array();

$_SESSION["vidas"] = $_POST["vidas"]
?>

<a href="http://localhost:8080/jugar.php">Jugar</a>