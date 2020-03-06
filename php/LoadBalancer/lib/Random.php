<?php

namespace LB;

use \Interfaces\Server as Server;
use \Interfaces\LoadBalancer as LB;

class Random implements Server, LB{

    private $name;
    private $servers = array();

    public function __construct(string $name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }
    
    public function addServer(Server $server){

        $serverName = $server->getName();

        if(!in_array($server,$this->servers)){
            $this->servers[$serverName] = $server;
            return True; 
        }
        return False;
    }

    public function removeServer(string $serverName){

        if(!empty($this->servers[$serverName])){
            unset($this->servers[$serverName]);
            return True;
        }
        return False;
    }

    public function call(){
        
        if(empty($this->servers)){
            throw new \Exception();
        }

        $key = array_rand($this->servers);
        $server = $this->servers[$key];
        $serverCall = $server->call();
        return $serverCall;
    }

    public function getList(){
        return $this->servers;
    }
}