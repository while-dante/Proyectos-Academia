<?php

namespace Carro;

class Login implements \Interfaces\Controler{

    public function get($get,$post,&$session){

        if (empty($session["log"])){
            $session["log"] = array(
                "logged" => False,
                "attempt"=> True,
            );
        }
        
        if (empty($session["reg"])){
            $session["reg"] = True;
        }
        
        if ($session["log"]["logged"]){
            header("Location: ./index.php?page=listaProductos");
        }
        
        $teLogIn = new \Library\TemplateEngine("../templates/login.template");
        
        $teLogIn->addVariable("titulo","Medias Punk!!!");
        $teLogIn->addVariable("mensaje","Adelante fiera");
        $teLogIn->addVariable("registro","¿Que haces no registrado, LINCE?");
        
        if ($session["log"]["attempt"]){
            if(!$session["reg"]){
                $teLogIn->addVariable("fallo","Usuario registrado correctamente");
            }
            $session["reg"] = False;
            return $teLogIn->render();

        }else{
            $teLogIn->addVariable("fallo","Proba de nuevo fiera");
            $session["log"]["attempt"] = True;
            $session["reg"] = False;
            return $teLogIn->render();
        }
    }

    public function post($get,$post,&$session){

        foreach ($session["usuarios"] as $usuario => $clave){
            if ($usuario === $post["usuario"] and $clave === $post["clave"]){
                $session["log"]["logged"] = True;
            }
        }
        
        if ($session["log"]["logged"]){
            $session["usuarioActual"] = $post["usuario"];
            header("Location: ./index.php?page=listaProductos");
        }else{
            $session["log"]["attempt"] = False;
            header("Location: ./index.php?page=login");
        }

        return "";
    }
}

?>
