<?php

session_start();

require_once("../src/productos.php");
require_once("../lib/TemplateEngine.php");

$teCarro = new TemplateEngine("../templates/carro.template");
$teDetalleCarro = new TemplateEngine("../templates/detalleCarro.template");

$teCarro->addVariable("cabecera","Carrito-Chan uwu");
$teCarro->addVariable("titulo","Su Carro");
$teCarro->addVariable("salida","Cerrar sesion.");
$teCarro->addVariable("volver","Seguir comprando.");

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

    if ($productoEsta === True){
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

echo $teCarro->render();

?>
