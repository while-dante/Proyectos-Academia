<?php

session_start();
include_once("./TemplateEngine.php");

if(empty($_SESSION["reg"])){
    $_SESSION["reg"] = False;
}

if ($_SESSION["log"]["logged"]){
    header("Location: ./listaProductos.php");
}

$teIndex = new TemplateEngine("./index.template");

$teIndex->addVariable("titulo","Medias Punk!!!");
$teIndex->addVariable("mensaje","¿Todavia no sos PANK?");
$teIndex->addVariable("login","¿Ya sos socio, MAQUINA?");

if (!$_SESSION["reg"]){
    echo $teIndex->render();
}else{
    $teIndex->addVariable("fallo","Usuario ya tomado, te la hicieron.");
    echo $teIndex->render();
}

?>
