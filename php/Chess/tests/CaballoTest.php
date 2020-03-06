<?php

namespace Tests;

use Objeto\Caballo;
use Objeto\Peon;
use Objeto\Tablero;
use PHPUnit\Framework\TestCase;

final class CaballoTest extends TestCase{

    public function testExisteCaballo(){
        $this->assertTrue(class_exists("\Objeto\Caballo"));
    }

    public function testReturnNombre(){
        $caballo = new Caballo(True);
        $esperado = "C ";
        $nombre = $caballo->nombre();
        $this->assertEquals($esperado,$nombre);
    }

    public function testEsBlanco(){
        $caballoBlanco = new Caballo(True);
        $caballoNegro = new Caballo(False);
        $this->assertTrue($caballoBlanco->esBlanco());
        $this->assertFalse($caballoNegro->esBlanco());
    }

    public function testMoverLibre(){
        $caballo = new Caballo(True);
        $tablero = new Tablero;
        $tablero->colocarPieza(0,0,$caballo);

        $niego = $caballo->mover(0,0,0,0,$tablero);
        $this->assertFalse($niego);
        $niego = $caballo->mover(0,0,0,1,$tablero);
        $this->assertFalse($niego);
        $niego = $caballo->mover(0,0,1,1,$tablero);
        $this->assertFalse($niego);
        $confirmo = $caballo->mover(0,0,1,2,$tablero);
        $this->assertTrue($confirmo);
        $confirmo = $caballo->mover(0,0,2,1,$tablero);
        $this->assertTrue($confirmo);
    }

    public function testMoverSobreOtraPieza(){
        $caballoBlanco = new Caballo(True);
        $peonBlanco = new Peon(True);
        $peonNegro = new Peon(False);
        $tablero = new Tablero;

        $tablero->colocarPieza(0,0,$caballoBlanco);
        $tablero->colocarPieza(1,2,$peonBlanco);
        $tablero->colocarPieza(2,1,$peonNegro);

        $niego = $caballoBlanco->mover(0,0,1,2,$tablero);
        $this->assertFalse($niego);
        $afirmo = $caballoBlanco->mover(0,0,2,1,$tablero);
        $this->assertTrue($afirmo);
    }
}