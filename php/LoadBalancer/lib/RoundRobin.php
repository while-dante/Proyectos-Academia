<?php

namespace LB;

use \Interfaces\Server as Server;
use \Interfaces\LoadBalancer as LB;

class RoundRobin implements Server, LB{

    private $name;
    private $servers = array();
    private $serverNames = array();
    private $calls = 0;

    public function __construct(string $name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function addServer(Server $server){

        $serverName = $server->getName();

        if(!in_array($serverName,$this->serverNames)){
            $this->servers[$serverName] = $server;
            $this->serverNames[] = $serverName;
            return True; 
        }
        return False;
    }

    public function removeServer(string $serverName){

        if(!empty($this->servers[$serverName])){
            unset($this->servers[$serverName]);

            $this->serverNames = array();

            foreach($this->servers as $serverName => $server){
                $this->serverNames[] = $serverName;
            }
            return True;
        }
        return False;
    }

    public function call(){

        if(!empty($this->servers)){
            $key = $this->serverNames[$this->calls];
            $server = $this->servers[$key];
            $this->calls += 1;
            $serverCall = $server->call();
    
            if($this->calls >= count($this->servers)){
                $this->calls = 0;
            }
    
            return $serverCall;
        }
        throw new \Exception();
    }

    public function getList(){
        return $this->servers;
    }

}