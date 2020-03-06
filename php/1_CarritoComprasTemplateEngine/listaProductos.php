<?php

session_start();

if ($_SESSION["log"] != True){
    header("Location: ./loginFail.php");
}

require_once("./productos.php");
require_once("./TemplateEngine.php");

$teListaProductos = new TemplateEngine("./listaProductos.template");
$teDetalleProducto = new TemplateEngine("./detalleProducto.template");

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
