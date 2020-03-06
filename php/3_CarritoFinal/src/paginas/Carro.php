<?php

namespace Carro;

class Carro implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        if(empty($session["carro"])){

            $session["carro"] = array();
        }
        
        $session["carro"][] = $get["idProducto"];
        
        header("Location: ./index.php?page=listaProductos");

        return "";
    }

    public function post($get,$post,&$session){
        return "";
    }
}

?>
