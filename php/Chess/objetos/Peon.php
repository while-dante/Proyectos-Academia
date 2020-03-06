<?php

namespace Objeto;

use Interfaz\Movible;
use Objeto\Tablero;

class Peon implements Movible{

    private $blanco;
    private $nombre;
    private $primerMovimiento;

    public function __construct(Bool $blanco){
        $this->blanco = $blanco;
        $this->nombre = "P ";
        $this->primerMovimiento = True;
    }

    public function mover($x1, $y1, $x2, $y2,Tablero $tablero){
        $distX = $x1-$x2;
        $distY = $y1-$y2;

        $destino = $tablero->dame($x2,$y2);

        $condicionDireccion = (($this->esBlanco() and $distX == -1)
            or (!$this->esBlanco() and $distX == 1));

        $condicionMovimiento = ((is_subclass_of($destino,"\Objeto\Peon")
            and $distY == 0) or (!is_subclass_of($destino,"\Objeto\Peon")
            and abs($distY) == 1
            and ($this->esBlanco() != $destino->esBlanco())));

        if($condicionDireccion and $condicionMovimiento){
            return True;
        }
        return False;
    }

    public function esBlanco(){
        return $this->blanco;
    }

    public function nombre(){
        return $this->nombre;
    }
}