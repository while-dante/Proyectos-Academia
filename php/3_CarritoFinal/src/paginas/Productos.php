<?php

namespace Carro;

class Productos {

    private $productos = array(
        0 => array("nombre" => "Calaveras", "precio" => "10"),
        1000 => array("nombre" => "Paltas", "precio" => "15"),
        666 => array("nombre" => "Diablitos", "precio" => "10"),
        420 => array("nombre" => "Cannabis", "precio" => "13"),
        0105 => array("nombre" => "Anarquia", "precio" => "5")
    );

    public function verProductos(){
        return $this->productos;
    }
}

?>
