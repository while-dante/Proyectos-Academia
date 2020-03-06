<?php

namespace Carro;

class VerCarro implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        $teCarro = new \Library\TemplateEngine("../templates/carro.template");
        $teDetalleCarro = new \Library\TemplateEngine("../templates/detalleCarro.template");
        $stock = new \Carro\Productos();
        
        $teCarro->addVariable("cabecera","Carrito-Chan uwu");
        $teCarro->addVariable("titulo","Su Carro");
        $teCarro->addVariable("salida","Cerrar sesion.");
        $teCarro->addVariable("volver","Seguir comprando.");
        
        $productos = $stock->verProductos();
        
        $total = 0;
        foreach ($productos as $id => $producto){
            
            $productoEsta = False;
            $cantidad = 0;
        
            foreach ($session["carro"] as $idProducto){
        
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
        
        return $teCarro->render();
    }

    public function post($get,$post,&$session){
        return "";
    }
}

?>
