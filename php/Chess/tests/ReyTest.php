<?php

namespace Tests;

use Objeto\Caballo;
use Objeto\Rey;
use Objeto\Tablero;
use PHPUnit\Framework\TestCase;

final class ReyTest extends TestCase{

    public function testExisteRey(){
        $this->assertTrue(class_exists("\Objeto\Rey"));
    }

    public function testReturnNombre(){
        $rey = new Rey(True);
        $esperado = "R ";
        $nombre = $rey->nombre();
        $this->assertEquals($esperado,$nombre);
    }

    public function testEsBlanco(){
        $reyBlanco = new Rey(True);
        $reyNegro = new Rey(False);
        $this->assertTrue($reyBlanco->esBlanco());
        $this->assertFalse($reyNegro->esBlanco());
    }

    public function testMoverLibre(){
        $rey = new Rey(True);
        $tablero = new Tablero;

        $tablero->colocarPieza(4,4,$rey);

        $confirmo = $rey->mover(4,4,5,5,$tablero);
        $this->assertTrue($confirmo);
        $confirmo = $rey->mover(4,4,4,5,$tablero);
        $this->assertTrue($confirmo);
        $confirmo = $rey->mover(4,4,5,4,$tablero);
        $this->assertTrue($confirmo);

        $niego = $rey->mover(4,4,7,7,$tablero);
        $this->assertFalse($niego);
        $niego = $rey->mover(4,4,0,6,$tablero);
        $this->assertFalse($niego);
        $niego = $rey->mover(4,4,4,4,$tablero);
        $this->assertFalse($niego);
    }

    public function testMoverSobreOtraPieza(){
        $reyNegro = new Rey(False);
        $caballoNegro = new Caballo(False);
        $caballoBlanco = new Caballo(True);
        $tablero = new Tablero;
        
        $tablero->colocarPieza(4,4,$reyNegro);
        $tablero->colocarPieza(5,5,$caballoNegro);
        $tablero->colocarPieza(4,3,$caballoBlanco);

        $niego = $reyNegro->mover(4,4,5,5,$tablero);
        $this->assertFalse($niego);
        $confirmo = $reyNegro->mover(4,4,4,3,$tablero);
        $this->assertTrue($confirmo);
    }
}