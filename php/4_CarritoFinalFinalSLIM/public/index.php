<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();

$app->addRoutingMiddleware();

$logCheckMW = function (Request $request, RequestHandler $handler){

    if($_SESSION["log"]["logged"]){
        $response = $handler->handle($request);
        return $response;
    }
    $response = new Slim\Psr7\Response();
    $response = $response->withStatus(302);
    $response = $response->withHeader('Location', '/login');

    return $response;
};

$app->get('/', function (Request $request, Response $response, array $args) {

    if(empty($_SESSION["reg"])){
        $_SESSION["reg"] = False;
    }

    if(empty($_SESSION["log"])){
        $_SESSION["log"] = array(
            "logged" => False,
            "attempt" => True
        );
    }
    
    if ($_SESSION["log"]["logged"]){
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/listaProductos');
    }
    
    $teIndex = new \Library\TemplateEngine("../templates/registro.template");
    
    $teIndex->addVariable("titulo","Medias Punk!!!");
    $teIndex->addVariable("mensaje","¿Todavia no sos PANK?");
    $teIndex->addVariable("login","¿Ya sos socio, MAQUINA?");
    
    if ($_SESSION["reg"]){
        $teIndex->addVariable("fallo","Usuario ya tomado, te la hicieron.");
    }

    $response->getBody()->write($teIndex->render());
    return $response;
});

$app->post('/registro', function (Request $request, Response $response, array $args) {

    if (empty($_SESSION["usuarios"])){
        $_SESSION["usuarios"] = array();
    }
    
    if ($_SESSION["log"]["logged"]){
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/listaProductos');
    }else{
        if (!array_key_exists($_POST["usuario"],$_SESSION["usuarios"])){
            $_SESSION["usuarios"][$_POST["usuario"]] = $_POST["clave"];
            $_SESSION["reg"] = False;
            $_SESSION["log"]["attempt"] = True;
            $response = $response->withStatus(302);
            $response = $response->withHeader('Location', '/login');
        }else{
            $_SESSION["reg"] = True;
            $response = $response->withStatus(302);
            $response = $response->withHeader('Location', '/');
        }
    }
    return $response;
});

$app->get('/login', function (Request $request, Response $response, array $args) {

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
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/listaProductos');
        return $response;
    }
    
    $teLogIn = new \Library\TemplateEngine("../templates/login.template");
    
    $teLogIn->addVariable("titulo","Medias Punk!!!");
    $teLogIn->addVariable("mensaje","Adelante fiera");
    $teLogIn->addVariable("registro","¿Que haces no registrado, LINCE?");
    
    if ($_SESSION["log"]["attempt"]){
        if(!$_SESSION["reg"]){
            $teLogIn->addVariable("fallo","Usuario registrado correctamente");
        }
        $_SESSION["reg"] = False;

    }else{
        $teLogIn->addVariable("fallo","Proba de nuevo fiera");
        $_SESSION["log"]["attempt"] = True;
        $_SESSION["reg"] = False;
    }

    $response->getBody()->write($teLogIn->render());
    return $response;
});

$app->post('/login', function (Request $request, Response $response, array $args) {

    foreach ($_SESSION["usuarios"] as $usuario => $clave){
        if ($usuario === $_POST["usuario"] and $clave === $_POST["clave"]){
            $_SESSION["log"]["logged"] = True;
        }
    }
    
    if ($_SESSION["log"]["logged"]){
        $_SESSION["usuarioActual"] = $_POST["usuario"];
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/listaProductos');
    }else{
        $_SESSION["log"]["attempt"] = False;
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/login');
    }
    return $response;
});

$app->group('', function() use ($app){

    $app->get('/listaProductos', function (Request $request, Response $response, array $args) {

        $teListaProductos = new \Library\TemplateEngine("../templates/listaProductos.template");
        $teDetalleProducto = new \Library\TemplateEngine("../templates/detalleProducto.template");
        $stock = new \Library\Productos();
        
        $teListaProductos->addVariable("titulo","Medias");
        $teListaProductos->addVariable("salida","Cerrar Sesion.");
        $teListaProductos->addVariable("carro","Ver Carrito");
        
        $productos = $stock->verProductos();
        
        $contenido = "";
        
        foreach($productos as $id => $producto){
            $cantidad = 0;
        
            foreach($_SESSION["carro"] as $idGuardada){
        
                if($idGuardada == $id){
                    $cantidad += 1;
                }
            }
        
            $teDetalleProducto->addVariable("cantidad",$cantidad);
    
            $teDetalleProducto->addVariable("nombre",$producto["nombre"]);
            $teDetalleProducto->addVariable("precio",$producto["precio"]);
            $teDetalleProducto->addVariable("agregar","Agregar al carro");
            $teDetalleProducto->addVariable("id",$id);
        
            $contenido .= $teDetalleProducto->render();
        
        }
        
        $teListaProductos->addVariable("contenido",$contenido);
    
        $response->getBody()->write($teListaProductos->render());
    
        return $response;
    });
    
    $app->get('/carro/{id}', function (Request $request, Response $response, array $args) {
    
        if(empty($_SESSION["carro"])){
    
            $_SESSION["carro"] = array();
        }
        
        $_SESSION["carro"][] = $args["id"];
        
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/listaProductos');
    
        return $response;
    
    });
    
    $app->get('/verCarro', function (Request $request, Response $response, array $args){
    
        $teCarro = new \Library\TemplateEngine("../templates/carro.template");
        $teDetalleCarro = new \Library\TemplateEngine("../templates/detalleCarro.template");
        $stock = new \Library\Productos();
        
        $teCarro->addVariable("cabecera","Carrito-Chan uwu");
        $teCarro->addVariable("titulo","Su Carro");
        $teCarro->addVariable("salida","Cerrar sesion.");
        $teCarro->addVariable("volver","Seguir comprando.");
        
        $productos = $stock->verProductos();
        
        $total = 0;
        foreach ($productos as $id => $producto){
            
            $productoEsta = False;
            $cantidad = 0;
        
            foreach ($_SESSION["carro"] as $idProducto){
        
                if($idProducto == $id){
                    $productoEsta = True;
                    $cantidad += 1;
                }
            }
            
            if ($productoEsta){
                $subTotal = $producto["precio"]*$cantidad;
        
                $teDetalleCarro->addVariable("nombre",$producto["nombre"]);
                $teDetalleCarro->addVariable("cantidad",$cantidad);
                $teDetalleCarro->addVariable("subtotal",$subTotal);
                $teDetalleCarro->addVariable("sacar","Sacar del carro");
                $teDetalleCarro->addVariable("id",$id);
        
                $contenido .= $teDetalleCarro->render();
        
                $total += $producto["precio"]*$cantidad;
            }
        }
        
        if($total>0){
            $teCarro->addVariable("total",$total);
        }else{
            $teCarro->addVariable("total",0);
        }
        
        $teCarro->addVariable("contenido",$contenido);
    
        $response->getBody()->write($teCarro->render());
        
        return $response;
    });
    
    $app->get('/carroSacar/{id}', function (Request $request, Response $response, array $args){
    
        foreach($_SESSION["carro"] as $key => $idProducto){
    
            if ($idProducto == $args["id"]){
                unset($_SESSION["carro"][$key]);
                break;
            }
        }
        
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/verCarro');
    
        return $response;
    });
    
    $app->get('/logout', function (Request $request, Response $response, array $args){
    
        foreach($_SESSION as $key => $value){
            if ($key != "usuarios" and $_key != "reg"){
                unset($_SESSION[$key]);
            }
        }
        
        $response = $response->withStatus(302);
        $response = $response->withHeader('Location', '/login');
    
        return $response;
    });
})->add($logCheckMW);

$app->run();

