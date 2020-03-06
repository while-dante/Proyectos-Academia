<?php

namespace Tests;

use Objeto\Peon;
use Objeto\Tablero;
use PHPUnit\Framework\TestCase;

final class PeonTest extends TestCase{

    public function testExistePeon(){
        $this->assertTrue(class_exists("\Objeto\Peon"));
    }
    
    public function testReturnNombre(){
        $peon = new Peon(True);
        $esperado = "P ";
        $nombre = $peon->nombre();
        $this->assertEquals($esperado,$nombre);
    }

    public function testEsBlanco(){
        $peonBlanco = new Peon(True);
        $peonNegro = new Peon(False);
        $this->assertTrue($peonBlanco->esBlanco());
        $this->assertFalse($peonNegro->esBlanco());
    }

    public function testMoverYComer(){
        $peonBlanco = new Peon(True);
        $peonNegro = new Peon(False);
        $tablero = new Tablero;

        $tablero->colocarPieza(2,2,$peonBlanco);
        $tablero->colocarPieza(6,3,$peonNegro);

        $niego = $peonBlanco->mover(2,2,1,2,$tablero);
        $this->assertFalse($niego);
        $niego = $peonBlanco->mover(2,2,3,1,$tablero);
        $this->assertFalse($niego);
        $niego = $peonBlanco->mover(2,2,3,3,$tablero);
        $this->assertFalse($niego);

        $niego = $peonNegro->mover(6,3,7,3,$tablero);
        $this->assertFalse($niego);
        $niego = $peonNegro->mover(6,3,5,2,$tablero);
        $this->assertFalse($niego);
        $niego = $peonNegro->mover(6,3,5,4,$tablero);
        $this->assertFalse($niego);

        $confirmo = $peonBlanco->mover(2,2,3,2,$tablero);
        $this->assertTrue($confirmo);
        $confirmo = $peonNegro->mover(6,3,5,3,$tablero);
        $this->assertTrue($confirmo);
    }

    public function testComer(){
        $peonBlanco = new Peon(True);
        $peonNegro = new Peon(False);
        $tablero = new Tablero;
        $tablero->colocarPieza(3,1,$peonNegro);
        $tablero->colocarPieza(4,2,$peonBlanco);
        $tablero->colocarPieza(5,3,$peonNegro);

        $niego = $peonBlanco->mover(4,2,3,1,$tablero);
        $this->assertFalse($niego);
        $confirmo = $peonNegro->mover(5,3,4,2,$tablero);
        $this->assertTrue($confirmo);
    }
}