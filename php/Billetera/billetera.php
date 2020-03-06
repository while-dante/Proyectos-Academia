<?php

class Billetera{

    private $billetes = array();

    function agregarPlata($billete,$cantidad){

        if (!isset($this->billetes[$billete])){
            $this->billetes[$billete] = 0; //Si no existia el billete antes, lo asigna ahora.
        }
        $this->billetes[$billete] += $cantidad;
    }

    function total(){
        $total = 0;

        foreach ($this->billetes as $billete => $cantidad){
            $total = $total + $billete*$cantidad;
        }
        return $total;
    }

    function sacarPlata($billete,$cantidad){

        if (isset($this->billetes[$billete]) and $this->billetes[$billete] >= $cantidad){
            $this->billetes[$billete] -= $cantidad;
        }
    }
}
