<?php

namespace Carro;

class Registro implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        if(empty($session["reg"])){
            $session["reg"] = False;
        }
        
        if ($session["log"]["logged"]){
            header("Location: ./index.php?page=listaProductos");
        }
        
        $teIndex = new \Library\TemplateEngine("../templates/registro.template");
        
        $teIndex->addVariable("titulo","Medias Punk!!!");
        $teIndex->addVariable("mensaje","¿Todavia no sos PANK?");
        $teIndex->addVariable("login","¿Ya sos socio, MAQUINA?");
        
        if (!$session["reg"]){
            return $teIndex->render();
        }else{
            $teIndex->addVariable("fallo","Usuario ya tomado, te la hicieron.");
            return $teIndex->render();
        }
    }

    public function post($get,$post,&$session){

        if (empty($session["usuarios"])){
            $session["usuarios"] = array();
        }
        
        if ($session["log"]["logged"]){
            header("Location: ./index.php?page=listaProductos");
        }else{
            if (!array_key_exists($post["usuario"],$session["usuarios"])){
                $session["usuarios"][$post["usuario"]] = $post["clave"];
                $session["reg"]=False;
                $session["log"]["attempt"] = True;
                header("Location: ./index.php?page=login");
            }else{
                $session["reg"] = True;
                header("Location: ./index.php");
            }
        }
        return "";
    }
}

?>
