<?php

session_start();

foreach ($_SESSION["usuarios"] as $usuario => $clave){
    if ($usuario === $_POST["usuario"] and $clave === $_POST["clave"]){
        $_SESSION["log"]["logged"] = True;
    }
}

if ($_SESSION["log"]["logged"]){
    header("Location: ./index.php?page=listaProductos");
}else{
    $_SESSION["log"]["attempt"] = False;
    header("Location: ./index.php?page=login");
}

?>
