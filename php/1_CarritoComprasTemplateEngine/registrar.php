<?php

session_start();

if (empty($_SESSION["usuarios"])){
    $_SESSION["usuarios"] = array();
}

if ($_SESSION["log"]["logged"]){
    header("Location: ./listaProductos.php");
}else{
    if (!array_key_exists($_POST["usuario"],$_SESSION["usuarios"])){
        $_SESSION["usuarios"][$_POST["usuario"]] = $_POST["clave"];
        $_SESSION["reg"]=False;
        $_SESSION["log"]["attempt"] = True;
        header("Location: ./login.php");
    }else{
        $_SESSION["reg"] = True;
        header("Location: ./index.php");
    }
}

?>