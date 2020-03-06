<?php

session_start();

if(empty($_SESSION["carro"])){

    $_SESSION["carro"] = array();
}

$_SESSION["carro"][] = $_GET["idProducto"];

header("Location: ./index.php?page=listaProductos");

?>
