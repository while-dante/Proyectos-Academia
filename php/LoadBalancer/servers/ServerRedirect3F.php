<?php

namespace Servers;

use \Interfaces\Server as Server;

class ServerRedirect3F implements Server{

    private $name;
    private $calls = 1;

    public function __construct(string $serverName){
        $this->name = $serverName;
    }

    public function getName(){
        return $this->name;
    }

    public function call(){

        if($this->calls%3==0){
            $this->calls += 1;
            return 500;
        }
        $this->calls += 1;
        return 300;
    }
}