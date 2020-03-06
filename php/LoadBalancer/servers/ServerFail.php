<?php

namespace Servers;

use \Interfaces\Server as Server;

class ServerFail implements Server{

    private $serverName;

    public function __construct(string $serverName){
        $this->serverName = $serverName;
    }

    public function getName(){
        return $this->serverName;
    }

    public function call(){
        return 500;
    }
}