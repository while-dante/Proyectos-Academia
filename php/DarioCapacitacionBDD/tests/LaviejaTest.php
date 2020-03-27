<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Juego\Lavieja;

final class LaviejaTest extends TestCase
{
    private $vieja;

    protected function setUp(): void
    {
        $this->vieja = new Lavieja;
    }

    public function testMostrar()
    {
        $tablero = $this->vieja->mostrar();
        $esperado = [
            [' ',' ',' ',],
            [' ',' ',' ',],
            [' ',' ',' ',],
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testJugarUnaVez()
    {
        $this->vieja->jugar(0,0);
        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['X',' ',' ',],
            [' ',' ',' ',],
            [' ',' ',' ',],
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testJugarDosVeces()
    {
        $this->vieja->jugar(0,0);
        $this->vieja->jugar(0,1);
        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['X','O',' ',],
            [' ',' ',' ',],
            [' ',' ',' ',],
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testJugarPosicionOcupada()
    {
        $this->vieja->jugar(0,0);
        $this->vieja->jugar(0,0);
        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['X',' ',' ',],
            [' ',' ',' ',],
            [' ',' ',' ',],
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testJugarReturn()
    {
        $this->assertTrue($this->vieja->jugar(0,0));
        $this->assertFalse($this->vieja->jugar(0,0));
        $this->assertTrue($this->vieja->jugar(0,1));
    }

    public function testEmpate()
    {
        $empate = $this->vieja->empate();
        $this->assertFalse($empate);

        $this->vieja->jugar(0,0);
        $this->vieja->jugar(0,2);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(1,0);
        $this->vieja->jugar(1,1);
        $this->vieja->jugar(2,2);
        $this->vieja->jugar(1,2);
        $this->vieja->jugar(2,1);

        $empate = $this->vieja->empate();
        $this->assertFalse($empate);

        $this->vieja->jugar(2,0);

        $empate = $this->vieja->empate();
        $this->assertTrue($empate);
        
        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['X','X','O'],
            ['O','X','X'],
            ['X','O','O']
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testGanoFilaX()
    {
        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(1,1);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(1,2);
        $this->vieja->jugar(0,0);

        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(1,0);
        $respuesta = $this->vieja->xGana();
        $this->assertTrue($respuesta);

        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['O','O',' '],
            ['X','X','X'],
            [' ',' ',' ']
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testGanoColumnaX()
    {
        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(1,2);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(0,2);
        $this->vieja->jugar(0,0);

        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(2,2);
        $respuesta = $this->vieja->xGana();
        $this->assertTrue($respuesta);

        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['O','O','X'],
            [' ',' ','X'],
            [' ',' ','X']
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testGanoDiagonalX()
    {
        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(1,1);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(0,2);
        $this->vieja->jugar(0,0);

        $respuesta = $this->vieja->xGana();
        $this->assertFalse($respuesta);
        
        $this->vieja->jugar(2,0);
        $respuesta = $this->vieja->xGana();
        $this->assertTrue($respuesta);

        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['O','O','X'],
            [' ','X',' '],
            ['X',' ',' ']
        ];
        $this->assertEquals($esperado,$tablero);
    }

    public function testTermino()
    {
        $termino = $this->vieja->termino();
        $this->assertFalse($termino);

        $this->vieja->jugar(1,1);
        $this->vieja->jugar(0,0);
        $this->assertFalse($this->vieja->termino());
        $this->vieja->jugar(2,1);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(2,2);
        $this->assertFalse($this->vieja->termino());
        $this->vieja->jugar(0,2);
        $this->assertTrue($this->vieja->termino());
        $this->assertFalse($this->vieja->empate());
        $this->assertFalse($this->vieja->xGana());
        $this->assertTrue($this->vieja->oGana());
    }

    public function testJugarDespuesDeTerminar()
    {
        $this->vieja->jugar(1,1);
        $this->vieja->jugar(0,0);
        $this->vieja->jugar(2,1);
        $this->vieja->jugar(0,1);
        $this->vieja->jugar(2,2);
        $this->vieja->jugar(0,2);
        $this->assertFalse($this->vieja->jugar(1,0));
        $tablero = $this->vieja->mostrar();
        $esperado = [
            ['O','O','O'],
            [' ','X',' '],
            [' ','X','X']
        ];
        $this->assertEquals($esperado,$tablero);
    }
}