<?php

namespace Library;

class AdminCheck implements \Interfaces\Controler{

    private $page;

    public function __construct($page){
        $this->page = $page;
    }

    public function get($get,$post,&$session){
        if($session["usuarioActual"] == "Administrador"){
            $this->page->get($get,$post,$session);
        }else{
            header("Location: index.php?page=listaProductos");
        }
        return "";
    }

    public function post($get,$post,&$session){
        return "";
    }
}