<?php

session_start();

include_once("../vendor/autoload.php");

if (empty($_SESSION["log"])){
    $_SESSION["log"] = array(
        "logged" => False,
        "attempt" => True,
    );
}

$_SESSION["usuarioActual"] = "";

$router = new \Library\Router();

$router->addRoute("registro",new \Carro\Registro());
$router->addRoute("login",new \Carro\Login());

$router->addRoute("listaProductos",new \Library\LoginCheck(
        new \Carro\ListaProductos()
    )
);
$router->addRoute("verCarro",new \Library\LoginCheck(
        new \Carro\VerCarro()
    )
);
$router->addRoute("carroSacar",new \Library\LoginCheck(
        new \Carro\CarroSacar()
    )
);
$router->addRoute("carro",new \Library\LoginCheck(
        new \Carro\Carro()
    )
);
$router->addRoute("logout",new \Library\LoginCheck(
        new \Carro\Logout()
    )
);

// $router->addRoute("adminPage", new \Library\AdminCheck(
//         new \Library\LoginCheck(
//             new \Carro\AdminPage()
//         )
//     )
// );

if(empty($_GET["page"])){
    $pagina = new \Carro\Registro();
    echo $pagina->get($_GET,$_POST,$_SESSION);

}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    $pagina = $router->match($_GET["page"]);
    echo $pagina->post($_GET,$_POST,$_SESSION);

}else{
    $pagina = $router->match($_GET["page"]);
    echo $pagina->get($_GET,$_POST,$_SESSION);
}
