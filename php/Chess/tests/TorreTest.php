<?php

namespace Tests;

use Objeto\Caballo;
use Objeto\Peon;
use Objeto\Tablero;
use Objeto\Torre;
use PHPUnit\Framework\TestCase;

final class TorreTest extends TestCase{

    public function testExisteTorre(){
        $this->assertTrue(class_exists("\Objeto\Torre"));
    }

    public function testReturnNombre(){
        $torre = new Torre(True);
        $esperado = "T ";
        $nombre = $torre->nombre();
        $this->assertEquals($esperado,$nombre);
    }

    public function testEsBlanco(){
        $torreBlanca = new Torre(True);
        $torreNegra = new Torre(False);
        $this->assertTrue($torreBlanca->esBlanco());
        $this->assertFalse($torreNegra->esBlanco());
    }

    public function testMoverLibre(){
        $torre = new Torre(True);
        $tablero = new Tablero;
        $tablero->colocarPieza(3,3,$torre);
        
        $niego = $torre->mover(3,3,6,1,$tablero);
        $this->assertFalse($niego);
        $niego = $torre->mover(3,3,5,7,$tablero);
        $this->assertFalse($niego);
        $niego = $torre->mover(3,3,4,4,$tablero);
        $this->assertFalse($niego);

        $afirmo = $torre->mover(3,3,3,7,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $torre->mover(3,3,3,0,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $torre->mover(3,3,5,3,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $torre->mover(3,3,1,3,$tablero);
        $this->assertTrue($afirmo);
    }

    public function testMoverSobreOtraPieza(){
        $torreBlanca = new Torre(True);
        $caballoNegro = new Caballo(False);
        $caballoBlanco = new Caballo(True);
        $tablero = new Tablero;

        $tablero->colocarPieza(3,3,$torreBlanca);
        $tablero->colocarPieza(0,3,$caballoNegro);
        $tablero->colocarPieza(3,7,$caballoBlanco);

        $afirmo = $torreBlanca->mover(3,3,0,3,$tablero);
        $this->assertTrue($afirmo);
        $niego = $torreBlanca->mover(3,3,3,7,$tablero);
        $this->assertFalse($niego);
    }

    public function testMoverPasandoUnaPieza(){
        $torreBlanca = new Torre(True);
        $torreNegra = new Torre(False);
        $peonBlanco = new Peon(True);
        $caballoNegro = new Caballo(False);
        $tablero = new Tablero;

        $tablero->colocarPieza(3,1,$torreBlanca);
        $tablero->colocarPieza(3,5,$torreNegra);
        $tablero->colocarPieza(1,1,$peonBlanco);
        $tablero->colocarPieza(5,1,$caballoNegro);
        $tablero->colocarPieza(5,5,$peonBlanco);
        $tablero->colocarPieza(1,5,$caballoNegro);

        $niego = $torreBlanca->mover(3,1,3,7,$tablero);
        $this->assertFalse($niego);
        $niego = $torreBlanca->mover(3,1,0,1,$tablero);
        $this->assertFalse($niego);
        $niego = $torreBlanca->mover(3,1,7,1,$tablero);
        $this->assertFalse($niego);
        $niego = $torreNegra->mover(3,5,3,0,$tablero);
        $this->assertFalse($niego);
        $niego = $torreNegra->mover(3,5,0,5,$tablero);
        $this->assertFalse($niego);
        $niego = $torreNegra->mover(3,5,7,5,$tablero);
        $this->assertFalse($niego);
    }
}