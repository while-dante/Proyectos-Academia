<?php

namespace Models;

class Map
{
    private $map = array();

    public function __construct($map){
        $this->map = $map;
    }

    public function getMap(){
        return $this->map;
    }

    public function showAddresses(){
        $addresses = "";
        foreach($this->map as $address => $people){
            $addresses += $address.", ";
        }
        return $addresses;
    }

    public function addAddress(string $address){

        if(!array_key_exists($address,$this->map)){
            $this->map[$address] = array();
            return True;
        }
        return False;
    }

    public function addPerson(string $name, string $direction){

        foreach($this->map as $address => $people){
            if($address === $direction and !in_array($name,$this->map[$address])){
                $this->map[$address][] = $name;
                return True;
            }
            return False;
        }
    }
}