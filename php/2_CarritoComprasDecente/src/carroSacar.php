<?php

session_start();

require_once("../src/productos.php");

foreach($_SESSION["carro"] as $key => $idProducto){

    if ($idProducto == $_GET["idProducto"]){
        unset($_SESSION["carro"][$key]);
        break;
    }
}

header("Location: ./index.php?page=verCarro");

?>
