<?php

namespace Servers;

use \Interfaces\Server as Server;

class ServerDoomsdayClock implements Server{

    private $serverName;
    private $countdown;

    public function __construct(string $serverName, int $countdown){
        $this->serverName = $serverName;
        $this->countdown = $countdown;
    }

    public function getName(){
        return $this->serverName;
    }

    public function call(){

        if ($this->countdown > 1){
            $this->countdown -=1;
            return 200;
        }elseif($this->countdown == 1){
            $this->countdown -=1;
            return 500;
        }
        return 0;
    }
}