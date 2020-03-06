<?php

namespace Interfaz;

use \Objeto\Tablero;

interface Movible{
    public function mover($x1, $y1, $x2, $y2,Tablero $tablero);
}