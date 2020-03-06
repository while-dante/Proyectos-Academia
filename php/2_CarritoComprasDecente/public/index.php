<?php

session_start();

require_once("../lib/Router.php");

if (empty($_SESSION["log"])){
    $_SESSION["log"] = array(
        "logged" => False,
        "attempt"=> True,
    );
}

$router = new Router();

$router->addRoute("registrar","../src/registrar.php");
$router->addRoute("login","../src/login.php");
$router->addRoute("logout","../src/logout.php");
$router->addRoute("log","../src/log.php");
$router->addRoute("listaProductos","../src/listaProductos.php");
$router->addRoute("verCarro","../src/verCarro.php");
$router->addRoute("carroSacar","../src/carroSacar.php");
$router->addRoute("carro","../src/carro.php");

if(empty($_GET["page"])){
    require_once("../src/registro.php");
}else{
    require_once($router->match($_GET["page"]));
}
