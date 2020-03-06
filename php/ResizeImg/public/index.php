<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteContext;

use Library\TemplateEngine;
use Library\UserService;

session_start();

if (PHP_SAPI == "cli-server"){
    $url = parse_url($_SERVER["REQUEST_URI"]);
    $file = __DIR__.$url["path"];
    if (is_file($file)) return False;
}

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->get("/", function(Request $request, Response $response){
    $indexPage = new TemplateEngine("../templates/index.html");
    $indexPage->addVariable("head","Load an image");
    $indexPage->addVariable("title","Save your favourite photos");
    $indexPage->addVariable("url","URL");
    $indexPage->addVariable("submit","Submit");

    $response->getBody()->write($indexPage->render());
    return $response;
});

$app->post("/resize", function(Request $request, Response $response){

    $images = new UserService;

    $url = $_POST["image"];
    $urlParts = explode("/",$url);
    $imgName = $urlParts[count($urlParts)-1];
    $imgPath = "./imgs/img.$imgName";
    file_put_contents($imgPath,file_get_contents($url));

    $imgData = getimagesize($imgPath);
    $width = $imgData[0];
    $height = $imgData[1];
    $newWidth = 500;
    $newHeight = 500;
    $sourceImg = imagecreatefromjpeg($imgPath);
    $targetImg = imagecreatetruecolor($newWidth,$newHeight);

    imagecopyresized($targetImg,$sourceImg,0,0,0,0,$newWidth,$newHeight,$width,$height);

    $newImgName = "resized.".$imgName;
    $images->saveUser($newImgName);
    $newImgPath = "./imgs/img.$newImgName";

    imagejpeg($targetImg,$newImgPath);

    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/show/$newImgName");
    return $response; 
});

$app->get("/show/{name}", function(Request $request, Response $response, array $args){
    $imgName = $args["name"];
    $showPage = new TemplateEngine("../templates/show.html");
    $showPage->addVariable("name",$imgName);
    $showPage->addVariable("list","See all images");
    $showPage->addVariable("back","Save another image");

    $response->getBody()->write($showPage->render());
    return $response;
});

$app->get("/allResized", function(Request $request, Response $response){
    $allResizedPage = new TemplateEngine("../templates/allResized.html");
    $listElement = new TemplateEngine("../templates/listElement.html");
    $allResizedPage->addVariable("header","Images");
    $allResizedPage->addVariable("title","All our resized images");
    $allResizedPage->addVariable("back","Save another image");

    $images = new UserService;
    $imagesNames = $images->getAllUsers();

    $list = "";

    foreach($imagesNames as $name){
        $listElement->addVariable("name",$name);
        $list .= $listElement->render();
    }

    $allResizedPage->addVariable("list",$list);

    $response->getBody()->write($allResizedPage->render());
    return $response;
});

$app->run();