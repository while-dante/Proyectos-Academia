<?php 

namespace Objeto;

use Interfaz\Movible;

class Rey implements Movible{

    private $blanco;
    private $nombre;

    public function __construct(Bool $blanco){
        $this->blanco = $blanco;
        $this->nombre = "R ";
    }

    public function mover($x1,$y1,$x2,$y2,Tablero $tablero){
        $distX = abs($x1-$x2);
        $distY = abs($y1-$y2);

        $destino = $tablero->dame($x2,$y2);

        $condicionMovimiento = (($distX == 1 and $distY == 1)
            or ($distX == 0 and $distY == 1)
            or ($distX == 1 and $distY == 0));

        $condicionDestino = (is_subclass_of($destino,"\Objeto\Peon")
            or ($destino->esBlanco() != $this->esBlanco()));

        if($condicionMovimiento and $condicionDestino){
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