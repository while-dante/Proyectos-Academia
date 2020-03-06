<?php

//Vemos constructores

//Hagamos una clase "Auto"

class Auto{

    private $color;
    private $km;

    public function __construct($color,$km){
        $this->color = $color;
        $this->km = $km;
    }
}

//Creo a herbie con el constructor

$herbie = new Auto("Rosa",300000);

print_r($herbie);