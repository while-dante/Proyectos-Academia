<?php

namespace LB;

use \Interfaces\Server as Server;
use \Interfaces\LoadBalancer as LB;

use \Interfaces\Strategy as Strategy;

class LoadBalancer implements Server, LB{

    private $name;
    private $servers = array();
    private $strat;

    public function __construct(string $name, Strategy $strat){
        $this->name = $name;
        $this->strat = $strat;
    }

    public function getName(){
        return $this->name;
    }

    public function addServer(Server $server){

        if(!in_array($server,$this->servers)){
            $this->servers[$server->getName()] = $server;
            return True;
        }
        return False;
    }

    public function removeServer(string $serverName){
        
        if (array_key_exists($serverName,$this->servers)){
            unset($this->servers[$serverName]);
            return True;
        }
        return False;
    }

    public function getList(){
        return $this->servers;
    }

    public function call(){
        $server = $this->strat->pick($this->servers);
        $serverCall = $server->call();
        return $serverCall;
    }
}