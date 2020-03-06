<?php

namespace Tests;

use Objeto\Alfil;
use Objeto\Caballo;
use Objeto\Tablero;
use Objeto\Torre;
use PHPUnit\Framework\TestCase;

final class AlfilTest extends TestCase{

    public function testExisteAlfil(){
        $this->assertTrue(class_exists("\Objeto\Alfil"));
    }

    public function testReturnNombre(){
        $alfil = new Alfil(True);
        $esperado = "A ";
        $obtenido = $alfil->nombre();
        $this->assertEquals($esperado,$obtenido);
    }

    public function testEsBlanco(){
        $alfilBlanco = new Alfil(True);
        $alfilNegro = new Alfil(False);

        $this->assertTrue($alfilBlanco->esBlanco());
        $this->assertFalse($alfilNegro->esBlanco());
    }

    public function testMoverLibre(){
        $alfil = new Alfil(True);
        $tablero = new Tablero;
        $tablero->colocarPieza(0,2,$alfil);

        $niego = $alfil->mover(0,2,0,2,$tablero);
        $this->assertFalse($niego);
        $niego = $alfil->mover(0,2,0,6,$tablero);
        $this->assertFalse($niego);
        $niego = $alfil->mover(0,2,5,2,$tablero);
        $this->assertFalse($niego);
        $niego = $alfil->mover(0,2,1,4,$tablero);
        $this->assertFalse($niego);

        $afirmo = $alfil->mover(0,2,3,5,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $alfil->mover(0,2,2,0,$tablero);
        $this->assertTrue($afirmo);
    }

    public function testMoverSobreOtraPieza(){
        $alfilBlanco = new Alfil(True);
        $alfilNegro = new Alfil(False);
        $torreBlanca = new Torre(True);
        $caballoNegro = new Caballo(False);
        $tablero = new Tablero;

        $tablero->colocarPieza(0,2,$alfilBlanco);
        $tablero->colocarPieza(7,5,$alfilNegro);
        $tablero->colocarPieza(2,0,$torreBlanca);
        $tablero->colocarPieza(5,7,$caballoNegro);

        $niego = $alfilBlanco->mover(0,2,2,0,$tablero);
        $this->assertFalse($niego);
        $niego = $alfilNegro->mover(7,5,5,7,$tablero);
        $this->assertFalse($niego);

        $afirmo = $alfilBlanco->mover(0,2,5,7,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $alfilNegro->mover(7,5,2,0,$tablero);
        $this->assertTrue($afirmo);
    }

    public function testMoverPasandoOtraPieza(){
        $alfilBlanco = new Alfil(True);
        $alfilNegro = new Alfil(False);
        $torreBlanca = new Torre(True);
        $caballoNegro = new Caballo(False);
        $tablero = new Tablero;

        $tablero->colocarPieza(1,5,$caballoNegro);
        $tablero->colocarPieza(2,1,$torreBlanca);
        $tablero->colocarPieza(4,2,$alfilNegro);
        $tablero->colocarPieza(4,3,$alfilBlanco);
        $tablero->colocarPieza(5,1,$torreBlanca);
        $tablero->colocarPieza(6,5,$caballoNegro);

        $niego = $alfilNegro->mover(4,2,0,6,$tablero);
        $this->assertFalse($niego);
        $niego = $alfilNegro->mover(4,2,6,0,$tablero);
        $this->assertFalse($niego);
        $niego = $alfilBlanco->mover(4,3,1,0,$tablero);
        $this->assertFalse($niego);
        $niego = $alfilBlanco->mover(4,3,7,6,$tablero);
    }
}