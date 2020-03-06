<?php

namespace Carro;

class CarroSacar implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        foreach($session["carro"] as $key => $idProducto){

            if ($idProducto == $get["idProducto"]){
                unset($session["carro"][$key]);
                break;
            }
        }
        
        header("Location: ./index.php?page=verCarro");

        return "";
    }

    public function post($get,$post,&$session){
        return "";
    }
}

?>
