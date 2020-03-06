<?php

session_start();

foreach ($_SESSION["usuarios"] as $usuario => $clave){
    if ($usuario === $_POST["usuario"] and $clave === $_POST["clave"]){
        $_SESSION["log"]["logged"] = True;
    }
}

if ($_SESSION["log"]["logged"]){
    header("Location: ./listaProductos.php");
}else{
    $_SESSION["log"]["attempt"] = False;
    header("Location: ./login.php");
}

?>
