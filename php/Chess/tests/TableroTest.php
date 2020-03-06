<?php

namespace Tests;

use Objeto\Caballo;
use PHPUnit\Framework\TestCase;
use Objeto\Tablero;
use Objeto\NullPieza;
use Objeto\Peon;
use Objeto\Rey;

final class TableroTest extends TestCase{

    private $tablero;

    protected function setUp(): void{
        $this->tablero = new Tablero;
    }
    
    public function testexisteTablero(){
        $this->assertTrue(class_exists("\Objeto\Tablero"));
    }

    public function testGetTableroVacio(){
        $tablero = new Tablero;
        $esperado = array();
        for($i=0;$i<8;$i++){
            $esperado[] = array();
            for($j=0;$j<8;$j++){
                $esperado[$i][] = new NullPieza(True);
            }
        }
        $obtenido = $tablero->getTablero();
        $this->assertEquals($esperado,$obtenido);
    }

    public function testMostrarTableroVacio(){
        $esperado = "";
        
        for($i=0;$i<8;$i++){
            for($j=0;$j<8;$j++){
                $esperado.= "|  |";
            }
            $esperado.= "\n";
        }
        $obtenido = $this->tablero->mostrar();
        $this->assertEquals($esperado,$obtenido);
    }

    public function testReturnColocarPieza(){
        $peon = new Peon(True);
        $caballo = new Caballo(True);
        $confirmo = $this->tablero->colocarPieza(0,0,$peon);
        $this->assertTrue($confirmo);
        $niego = $this->tablero->colocarPieza(0,0,$caballo);
        $this->assertFalse($niego);
        $confirmo = $this->tablero->colocarPieza(0,1,$peon);
        $this->assertTrue($confirmo);
    }

    public function testReturnDame(){
        $peon = new Peon(True);
        $nullPieza = new NullPieza(True);
        $this->tablero->colocarPieza(0,0,$peon);
        $pieza = $this->tablero->dame(0,0);
        $this->assertEquals($peon,$pieza);
        $pieza = $this->tablero->dame(4,4);
        $this->assertEquals($nullPieza,$pieza);
    }

    public function testColocarPiezaMostrarTablero(){
        $peon = new Peon(True);
        $caballo = new Caballo(True);

        $this->tablero->colocarPieza(0,0,$peon);
        $this->tablero->colocarPieza(0,1,$peon);
        $this->tablero->colocarPieza(0,2,$caballo);
        $this->tablero->colocarPieza(0,3,$peon);
        $this->tablero->colocarPieza(0,4,$peon);

        $esperado = "|P ||P ||C ||P ||P ||  ||  ||  |\n";
        for($i=0;$i<7;$i++){
            for($j=0;$j<8;$j++){
                $esperado.= "|  |";
            }
            $esperado.= "\n";
        }

        $obtenido = $this->tablero->mostrar();
        
        $this->assertEquals($esperado,$obtenido);
    }

    public function testMoverPieza(){
        $tablero = new Tablero;
        $rey = new Rey(True);
        $tablero->colocarPieza(4,4,$rey);
        $confirmo = $tablero->mover(4,4,5,5);
        $this->assertTrue($confirmo);
    }
}