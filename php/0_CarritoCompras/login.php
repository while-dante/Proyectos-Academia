<?php

session_start();

$usuariosValidos = array(
    "fulano" => "mengano",
    "weedmaster420" => "blazeit"
);

foreach ($usuariosValidos as $usuario => $clave){
    if ($usuario === $_POST["usuario"] and $clave === $_POST["clave"]){
        $_SESSION["log"] = True;
    }
}

if ($_SESSION["log"] === True){
    header("Location: ./listaProductos.php");
}else{
    header("Location: ./indexFail.php");
}