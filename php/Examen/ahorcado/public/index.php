<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteContext;

use Library\TemplateEngine;
use Library\Ahorcado;

require __DIR__ . '/../../vendor/autoload.php';

session_start();

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get("/", function(Request $request, Response $response){
    $inicioPagina = new TemplateEngine("../templates/inicio.html");
    $inicioPagina->addVariable("cabecera","Inicio");
    $inicioPagina->addVariable("titulo","Preparar Ahorcado");

    $response->getBody()->write($inicioPagina->render());
    return $response;
});

$app->post("/cargar", function(Request $request, Response $response){
    $_SESSION["palabra"] = $_POST["palabra"];
    $_SESSION["intentos"] = $_POST["intentos"];
    $_SESSION["letrasJugadas"] = array();

    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/principal");

    return $response;
});

$app->get("/principal", function(Request $request, Response $response){
    $ahorcado = new Ahorcado($_SESSION["palabra"],$_SESSION["intentos"]);
    $principalPagina = new TemplateEngine("../templates/principal.html");

    foreach($_SESSION["letrasJugadas"] as $letra){
        $ahorcado->jugar($letra);
    }

    $principalPagina->addVariable("cabecera","Jugar");

    $gano = $ahorcado->gano();
    $perdio = $ahorcado->perdio();
    $termino = $ahorcado->termino();

    if(!$termino){
        $abc = array(
            "a","b","c","d","e","f","g","h","i","j","k","l"
        );
        $xyz = array(
            "m","n","o","p","q","r","s","t","u","v","w","x","y","z"
        );
    
        $fila1 = "";
        $fila2 = "";
        
        foreach($abc as $letra){
            $linkLetra = new TemplateEngine("../templates/letra.html");
            $linkLetra->addVariable("letra",$letra);
            $fila1 .= $linkLetra->render();
        }
        foreach($xyz as $letra){
            $linkLetra = new TemplateEngine("../templates/letra.html");
            $linkLetra->addVariable("letra",$letra);
            $fila2 .= $linkLetra->render();
        }
        
        $principalPagina->addVariable("fila1",$fila1);
        $principalPagina->addVariable("fila2",$fila2);
        $principalPagina->addVariable("reinicio","Reiniciar");
    }else{
        $principalPagina->addVariable("reinicio","Volver a jugar.");
        if($gano){
            $principalPagina->addVariable("mensaje","GANASTE");
        }elseif($perdio){
            $principalPagina->addVariable("mensaje","PERDISTE");
        }
    }

    $palabra = $ahorcado->mostrar();
    $intentos = $ahorcado->intentosRestantes();
    $principalPagina->addVariable("palabra",$palabra);
    $principalPagina->addVariable("intentos",$intentos);

    $response->getBody()->write($principalPagina->render());
    return $response;
});

$app->get("/jugar/{letra}", function(Request $request, Response $response, array $args){
    $letra = $args["letra"];
    $_SESSION["letrasJugadas"][] = $letra;

    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/principal");

    return $response;
});

$app->run();