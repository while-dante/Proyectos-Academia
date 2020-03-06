<?php

namespace Tests;

use Objeto\NullPieza;
use Objeto\Tablero;
use PHPUnit\Framework\TestCase;

final class NullPiezaTest extends TestCase{

    public function testExisteNullPieza(){
        $this->assertTrue(class_exists("\Objeto\NullPieza"));
    }

    public function testMover(){
        $nullPieza = new NullPieza(True);
        $tablero = new Tablero;
        $niego = $nullPieza->mover(1,2,3,4,$tablero);
        $this->assertFalse($niego);
    }
}