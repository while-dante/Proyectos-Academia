<?php

namespace LB;

use \Interfaces\Server as Server;

class Counter implements Server{

    private $server;
    private $totalCalls = 0;
    private $callTypes = array();

    public function __construct(Server $server){
        $this->server = $server;
    }

    public function getName(){
        $server = $this->server;
        $name = $server->getName();
        return $name;
    }

    public function call(){
        $server = $this->server;
        $serverCall = $server->call();

        if(!array_key_exists($serverCall,$this->callTypes)){
            $this->callTypes[$serverCall] = 1;
            $this->totalCalls += 1;
            return $serverCall;
        }
        $this->callTypes[$serverCall] += 1;
        $this->totalCalls += 1;
        return $serverCall;
    }
    
    public function getCalls(){
        return $this->callTypes;
    }
    
    public function getTotalCalls(){
        return $this->totalCalls;
    }

    public function getData(){
        $data = array(
            "name" => $this->getName(),
            "calls" => $this->getCalls(),
            "total" => $this->getTotalCalls()
        );
        return $data;
    }
}