<?php

session_start();

require_once("../src/productos.php");
require_once("../lib/TemplateEngine.php");

$teListaProductos = new TemplateEngine("../templates/listaProductos.template");
$teDetalleProducto = new TemplateEngine("../templates/detalleProducto.template");

$teListaProductos->addVariable("titulo","Medias");
$teListaProductos->addVariable("salida","Cerrar Sesion.");
$teListaProductos->addVariable("carro","Ver Carrito");

$contenido = "";

foreach($productos as $id => $producto){
    $enCarro = False;
    $cantidad = 0;

    foreach($_SESSION["carro"] as $idGuardada){

        if($idGuardada == $id){
            $enCarro = True;
            $cantidad += 1;
        }
    }

    if($enCarro){
        $teDetalleProducto->addVariable("cantidad",$cantidad);
    }else{
        $teDetalleProducto->addVariable("cantidad",0);
    }

    $teDetalleProducto->addVariable("nombre",$producto["nombre"]);
    $teDetalleProducto->addVariable("precio",$producto["precio"]);
    $teDetalleProducto->addVariable("agregar","Agregar al carro");
    $teDetalleProducto->addVariable("id",$id);

    $contenido .= $teDetalleProducto->render();

}

$teListaProductos->addVariable("contenido",$contenido);

echo $teListaProductos->render();

?>
