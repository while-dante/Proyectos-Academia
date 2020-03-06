<?php

namespace Decorator;

class AutosEntrantes{

    private $concesionaria;
    private $brand = "";
    private $entrantes = 0;

    public function __construct($concesionaria, string $brand){
        $this->concesionaria = $concesionaria;
        $this->brand = $brand;
    }

    public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio){
        if ($marca == $this->brand){
            $this->entrantes += 1;
        }
        return $this->concesionaria->agregarAutos($idReferencia, $marca, $modelo, $anio, $precio);
    }

    public function mostrarAutosDeMarca($marca){
        return $this->concesionaria->mostrarAutosDeMarca($marca);
    }

    public function venderAutoMarca($marca){
        return $this->concesionaria->venderAutoMarca($marca);
    }

    public function totalGanado(){
        return $this->concesionaria->totalGanado();
    }

    public function getData(){
        return $this->entrantes;
    }
}