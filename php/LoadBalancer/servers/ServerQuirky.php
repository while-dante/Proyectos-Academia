<?php

namespace Servers;

use \Interfaces\Server as Server;

class ServerQuirky implements Server{

    private $serverName;
    private $response = array(0,200,300,400,500);

    public function __construct(string $serverName){
        $this->serverName = $serverName;
    }

    public function getName(){
        return $this->serverName;
    }

    public function call(){
        return $this->response[array_rand($this->response)];
    }
}
