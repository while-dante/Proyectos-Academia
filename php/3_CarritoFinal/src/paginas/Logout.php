<?php

namespace Carro;

class Logout implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        foreach($session as $key => $value){
            if ($key != "usuarios" and $_key != "reg"){
                unset($session[$key]);
            }
        }
        
        header("Location: ./index.php?page=login");

        return "";
    }

    public function post($get,$post,&$session){
        return "";
    }
}



?>
