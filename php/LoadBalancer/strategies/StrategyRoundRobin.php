<?php

namespace Strategies;

use \Interfaces\Strategy as Strategy;

class StrategyRoundRobin implements Strategy{

    private $calls = 0;

    public function pick(array $servers){

        $servers = array_values($servers);

        if($this->calls >= count($servers)){
            $this->calls = 0;
        }

        $server = $servers[$this->calls];
        $this->calls += 1;
    
        return $server;
    }
}