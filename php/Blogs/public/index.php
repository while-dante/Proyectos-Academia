<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();

$app->addRoutingMiddleware();

$loginCheck = function (Request $request, RequestHandler $handler){

    if (empty($_SESSION["logged"])){
        $_SESSION["logged"] = False;
    }

    if ($_SESSION["logged"]){
        $response = $handler->handle($request);
    }else{
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location", "/");
    }
    return $response;
};

$app->get("/", function(Request $request, Response $response){

    if(empty($_SESSION["logFail"])){
        $_SESSION["logFail"] = False;
    }
    if(empty($_SESSION["newUser"])){
        $_SESSION["newUser"] = False;
    }

    $loginPage = new \Library\TemplateEngine("../templates/login.html");

    $loginPage->addVariable("cabecera","Floggueate");
    $loginPage->addVariable("titulo","FloggSpot");
    $loginPage->addVariable("eslogan","Porque ser Flogger es como ser un RockStar!!!");
    $loginPage->addVariable("nick","Tu Nick");
    $loginPage->addVariable("registro","¿No estás registrad@?");
    $loginPage->addVariable("invitado","Pasa tranca, no somos gorrudxs");

    if($_SESSION["logFail"]){
        $loginPage->addVariable("fallo","Nadie lo juna a ese");
        $_SESSION["logFail"] = False;
    }elseif($_SESSION["newUser"]){
        $loginPage->addVariable("fallo","Ya sos parte ;)");
        $_SESSION["newUser"] = False;
    }

    $response->getBody()->write($loginPage->render());
    return $response;
});

$app->post("/", function(Request $request, Response $response){

    $uService = new \Library\UserService;

    if($uService->userExists($_POST["user"])){
        $_SESSION["activeUser"] = $_POST["user"];
        $_SESSION["logged"] = True;
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location","/itMe");
    }else{
        $_SESSION["logFail"] = True;
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location","/");
    }
    return $response;
});

$app->get("/register",function(Request $request, Response $response){

    if(empty($_SESSION["newUser"])){
        $_SESSION["newUser"] = False;
    }

    $registerPage = new \Library\TemplateEngine("../templates/register.html");

    $registerPage->addVariable("cabecera","Anotate");
    $registerPage->addVariable("titulo","FloggPost");
    $registerPage->addVariable("eslogan","Hacete amigo");
    $registerPage->addVariable("nick","Nuevo nick");
    $registerPage->addVariable("logueo","¿Ya sos parte? - Floggueate!");

    if($_SESSION["newUser"]){
        $registerPage->addVariable("fallo","Nick en uso, recomendamos ser original.");
        $_SESSION["newUser"] = False;
    }

    $response->getBody()->write($registerPage->render());
    return $response;
});

$app->post("/register", function(Request $request, Response $response){

    $uService = new \Library\UserService;

    if(!$uService->userExists($_POST["user"])){
        $uService->saveUser($_POST["user"]);
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location","/");
    }else{
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location","/register");
    }
    $_SESSION["newUser"] = True;
    
    return $response;
});

$app->get("/itMe", function(Request $request, Response $response){

    $bService = new \Library\BlogService;
    $postList = $bService->getAllPosts($_SESSION["activeUser"]);

    $blog = new \Library\TemplateEngine("../templates/blog.html");
    $postForm = new \Library\TemplateEngine("../templates/postForm.html");
    $postDetail = new \Library\TemplateEngine("../templates/post.html");
    
    $postForm->addVariable("nuevo","Nuevo posteo:");
    $blog->addVariable("usuario",$_SESSION["activeUser"]);
    $blog->addVariable("nuevo",$postForm->render());

    if (empty($postList)){
        $blog->addVariable("posts","No tengas vergüenza, postea algo... o no.");
        $response->getBody()->write($blog->render());
        return $response;
    }else{
        $content = "";
        $i = 0;
        foreach($postList as $post){
            $postDetail->addVariable("post",$post);
            $postDetail->addVariable("id",$i);
            $postDetail->addVariable("borrar","Borrar Post");
            $i += 1;
            $content .= $postDetail->render();
        }
    
        $blog->addVariable("posts",$content);
        
        $response->getBody()->write($blog->render());
        
        return $response;
    }
    
})->add($loginCheck);

$app->post("/itMe", function(Request $request, Response $response){

    $bService = new \Library\BlogService;
    $bService->savePost($_POST["post"],$_SESSION["activeUser"]);

    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/itMe");

    return $response;
    
})->add($loginCheck);

$app->get("/usuarios", function(Request $request, Response $response){

    $uService = new \Library\UserService;
    $usuarios = $uService->getAllUsers();

    $paginaUsuarios = new Library\TemplateEngine("../templates/usuarios.html");
    $listaUsuarios = new Library\TemplateEngine("../templates/listaUsuarios.html");

    $paginaUsuarios->addVariable("cabecera","Kaposs");
    $paginaUsuarios->addVariable("titulo","Todos los Rockstars");

    $content = "";

    foreach($usuarios as $usuario){
        if ($usuario != ""){
            $listaUsuarios->addVariable("usuario",$usuario);
            $content .= $listaUsuarios->render();
        }
    }

    $paginaUsuarios->addVariable("usuarios",$content);

    $response->getBody()->write($paginaUsuarios->render());

    return $response;
});

$app->get("/user/{nombre}.html", function(Request $request, Response $response, array $args){

    $nombre = $args["nombre"];

    if ($nombre == $_SESSION["activeUser"]){
        $response = new Slim\Psr7\Response();
        $response = $response->withStatus(302);
        $response = $response->withHeader("Location","/itMe");
        return $response;
    }

    $bService = new \Library\BlogService;
    $postList = $bService->getAllPosts($nombre);

    $blog = new \Library\TemplateEngine("../templates/blog.html");
    $postDetail = new \Library\TemplateEngine("../templates/post.html");

    $blog->addVariable("usuario",$nombre);

    if (empty($postList)){
        $blog->addVariable("posts","Este usuario no tiene posts, re careta.");
        $response->getBody()->write($blog->render());
        return $response;
    }

    $content = "";

    foreach($postList as $post){
        $postDetail->addVariable("post",$post);
        $content .= $postDetail->render();
    }

    $blog->addVariable("posts",$content);
    
    $response->getBody()->write($blog->render());
    
    return $response;
});

$app->get("/delete/{postID}", function(Request $request, Response $response, array $args){

    $id = $args["postID"];

    $fileStore = new \Library\FileStore("../files/".$_SESSION["activeUser"].".posts");
    $bService = new \Library\BlogService;

    $posts = $bService->getAllPosts($_SESSION["activeUser"]);
    $newPosts = array();

    foreach($posts as $post){
        if ($post != $posts[$id]){
            $newPosts[] = $post;
        }
    }

    $fileStore->save($newPosts);

    $response = new \Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/itMe");

    return $response;

})->add($loginCheck);

$app->get("/logout", function(Request $request, Response $response){
    session_destroy();

    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader("Location","/");

    return $response;
});

$app->run();