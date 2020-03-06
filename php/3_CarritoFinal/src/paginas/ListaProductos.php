<?php

namespace Carro;

class ListaProductos implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        $teListaProductos = new \Library\TemplateEngine("../templates/listaProductos.template");
        $teDetalleProducto = new \Library\TemplateEngine("../templates/detalleProducto.template");
        $stock = new \Carro\Productos();
        
        $teListaProductos->addVariable("titulo","Medias");
        $teListaProductos->addVariable("salida","Cerrar Sesion.");
        $teListaProductos->addVariable("carro","Ver Carrito");
        
        $productos = $stock->verProductos();
        
        $contenido = "";
        
        foreach($productos as $id => $producto){
            $enCarro = False;
            $cantidad = 0;
        
            foreach($session["carro"] as $idGuardada){
        
                if($idGuardada == $id){
                    $enCarro = True;
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
        
        return $teListaProductos->render();
    }

    public function post($get,$post,&$session){
        return "";
    }
}

?>
