<?php

namespace Objeto;

use Objeto\Peon;

class NullPieza extends Peon{
    
    public function mover($x1, $y1, $x2, $y2,Tablero $tablero){
        return False;
    }

    public function nombre(){
        return "  ";
    }
}