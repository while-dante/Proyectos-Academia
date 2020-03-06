<?php

namespace Decorator;

class ContadorAltasGanancias{
    
    private $concesionaria;
    private $ganancias;
    private $piso = 0;

    public function __construct($concesionaria, $piso){
        $this->concesionaria = $concesionaria;
        $this->piso = $piso;
    }

    public function agregarAutos($idReferencia, $marca, $modelo, $anio, $precio){
        return $this->concesionaria->agregarAutos($idReferencia, $marca, $modelo, $anio, $precio);
    }

    public function mostrarAutosDeMarca($marca){
        return $this->concesionaria->mostrarAutosDeMarca($marca);
    }

    public function venderAutoMarca($marca){
        $totalViejo = $this->totalGanado();
        $venta = $this->concesionaria->venderAutoMarca($marca);
        $totalNuevo = $this->totalGanado();

        $dif = $totalNuevo - $totalViejo;
        if ($dif >= $this->piso){
            if(empty($this->ganancias[$marca])){
                $this->ganancias[$marca] = array();
            }
            $this->ganancias[$marca][] = $dif;
        }
        return $venta;
    }

    public function totalGanado(){
        return $this->concesionaria->totalGanado();
    }

    public function getData(){
        $data = $this->ganancias;
        $data[] = $this->concesionaria->getData();
        return $data;
    }
}