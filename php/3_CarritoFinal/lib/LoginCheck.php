<?php

namespace Library;

class LoginCheck implements \Interfaces\Controler{

    private $page;

    public function __construct($page){
        $this->page = $page;
    }

    public function get($get,$post,&$session){
        if($session["log"]["logged"]){
            return $this->page->get($get,$post,$session);
        }else{
            header("Location: ./index.php");
            return "";
        }
    }

    public function post($get,$post,&$session){
        if($session["log"]["logged"]){
            return $this->page->post($get,$post,$session);
        }else{
            header("Location: ./index.php");
            return "";
        }
    }
}