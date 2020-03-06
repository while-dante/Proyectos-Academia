<?php

namespace Tests;

use Objeto\Dama;
use Objeto\Tablero;
use PHPUnit\Framework\TestCase;

final class DamaTest extends TestCase{

    public function testExisteDama(){
        $this->assertTrue(class_exists("\Objeto\Dama"));
    }

    public function testReturnNombre(){
        $dama = new Dama(True);
        $esperado = "D ";
        $obtenido = $dama->nombre();
        $this->assertEquals($esperado,$obtenido);
    }

    public function testEsBlanco(){
        $damaBlanca = new Dama(True);
        $damaNegra = new Dama(False);
        $this->assertTrue($damaBlanca->esBlanco());
        $this->assertFalse($damaNegra->esBlanco());
    }

    public function testMoverLibre(){
        $dama = new Dama(True);
        $tablero = new Tablero;
        $tablero->colocarPieza(4,4,$dama);

        $niego = $dama->mover(4,4,5,6,$tablero);
        $this->assertFalse($niego);
        $niego = $dama->mover(4,4,2,5,$tablero);
        $this->assertFalse($niego);
        $niego = $dama->mover(4,4,3,1,$tablero);
        $this->assertFalse($niego);

        $afirmo = $dama->mover(4,4,4,7,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,4,0,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,0,4,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,7,4,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,7,7,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,0,0,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,7,1,$tablero);
        $this->assertTrue($afirmo);
        $afirmo = $dama->mover(4,4,1,7,$tablero);
        $this->assertTrue($afirmo);
    }

    public function testMoverSobreOtraPieza(){
        
    }
}