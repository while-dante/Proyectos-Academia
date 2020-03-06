<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Library\Ahorcado;

final class AhorcadoTest extends TestCase{

    public function testExisteAhorcado(){
        $this->assertTrue(class_exists("Library\Ahorcado"));
        $ahorcado = new Ahorcado("test",5);
        $this->assertFalse(empty($ahorcado));
    }

    public function testMostrar(){
        $ahorcado = new Ahorcado("test",5);
        $esperado = " _  _  _  _ ";
        $mostrado = $ahorcado->mostrar();
        $this->assertEquals($esperado,$mostrado);
    }

    public function testIntentosRestantes(){
        $ahorcado = new Ahorcado("test",5);
        $esperado = 5;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);
    }

    public function testJugarBien(){
        $ahorcado = new Ahorcado("test",5);
        $this->assertTrue($ahorcado->jugar("t"));
        $esperado = "t _  _ t";
        $mostrado = $ahorcado->mostrar();
        $this->assertEquals($esperado,$mostrado);
        $esperado = 5;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);
        
        $gano = $ahorcado->gano();
        $perdio = $ahorcado->perdio();
        $termino = $ahorcado->termino();

        $this->assertFalse($gano);
        $this->assertFalse($perdio);
        $this->assertFalse($termino);
    }

    public function testJugarMal(){
        $ahorcado = new Ahorcado("test",5);
        $this->assertTrue($ahorcado->jugar("a"));
        $esperado = " _  _  _  _ ";
        $mostrado = $ahorcado->mostrar();
        $this->assertEquals($esperado,$mostrado);
        $esperado = 4;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);

        $gano = $ahorcado->gano();
        $perdio = $ahorcado->perdio();
        $termino = $ahorcado->termino();

        $this->assertFalse($gano);
        $this->assertFalse($perdio);
        $this->assertFalse($termino);
    }

    public function testJugarMismaLetra(){
        $ahorcado = new Ahorcado("test",5);
        $this->assertTrue($ahorcado->jugar("a"));
        $esperado = 4;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);
        $this->assertFalse($ahorcado->jugar("a"));
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);

        $ahorcado = new Ahorcado("test",5);
        $this->assertTrue($ahorcado->jugar("t"));
        $this->assertFalse($ahorcado->jugar("t"));
        $esperado = 5;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);
    }

    public function testGanar(){        
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("a");
        $ahorcado->jugar("e");
        $ahorcado->jugar("t");
        $ahorcado->jugar("l");
        $ahorcado->jugar("s");
        
        $esperado = "test";
        $mostrado = $ahorcado->mostrar();
        $this->assertEquals($esperado,$mostrado);

        $esperado = 3;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);

        $gano = $ahorcado->gano();
        $perdio = $ahorcado->perdio();
        $termino = $ahorcado->termino();

        $this->assertTrue($gano);
        $this->assertFalse($perdio);
        $this->assertTrue($termino);
    }

    public function testPerder(){
        $ahorcado = new Ahorcado("test",3);
        $ahorcado->jugar("a");
        $ahorcado->jugar("e");
        $ahorcado->jugar("t");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        
        $esperado = "te _ t";
        $mostrado = $ahorcado->mostrar();
        $this->assertEquals($esperado,$mostrado);

        $esperado = 0;
        $intentos = $ahorcado->intentosRestantes();
        $this->assertEquals($esperado,$intentos);

        $gano = $ahorcado->gano();
        $perdio = $ahorcado->perdio();
        $termino = $ahorcado->termino();

        $this->assertFalse($gano);
        $this->assertTrue($perdio);
        $this->assertTrue($termino);
    }
}