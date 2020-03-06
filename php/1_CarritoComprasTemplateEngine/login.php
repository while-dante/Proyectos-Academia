<?php

session_start();
include_once("./TemplateEngine.php");

if (empty($_SESSION["log"])){
    $_SESSION["log"] = array(
        "logged" => False,
        "attempt"=> True,
    );
}

if (empty($_SESSION["reg"])){
    $_SESSION["reg"] = True;
}

if ($_SESSION["log"]["logged"]){
    header("Location: ./listaProductos.php");
}

$teLogIn = new TemplateEngine("./login.template");

$teLogIn->addVariable("titulo","Medias Punk!!!");
$teLogIn->addVariable("mensaje","Adelante fiera");
$teLogIn->addVariable("registro","¿Que haces no registrado, LINCE?");

if ($_SESSION["log"]["attempt"]){
    if(!$_SESSION["reg"]){
        $teLogIn->addVariable("fallo","Usuario registrado correctamente");
    }
    echo $teLogIn->render();
}else{
    $teLogIn->addVariable("fallo","Proba de nuevo fiera");
    echo $teLogIn->render();
    $_SESSION["log"]["attempt"] = True;
}

?>
