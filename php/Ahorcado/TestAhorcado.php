<?php

//Testeo del Ahorcado

require_once("./vendor/autoload.php");

require_once("Ahorcado.php");

use PHPUnit\Framework\TestCase;

final class AhorcadoTest extends TestCase{
    
    function testAndaTodo(){
        $this->assertTrue(True);
    }

    function testExisteAhorcado(){
        $this->assertTrue(class_exists("Ahorcado"));
    }

    function testExisteMostrar(){
        $ahorcado = new Ahorcado("test",5);
        $pista = $ahorcado->mostrar();
        $this->assertTrue(!empty($pista));
    }

    function testMostrarLargo(){
        $ahorcado = new Ahorcado("test",5);
        $palabra = $ahorcado->mostrar();
        $largo = strlen("t e s t");
        $largo_palabra = strlen($palabra);

        $this->assertEquals($largo,$largo_palabra);
    }

    function testMostrarGuiones(){
        $ahorcado = new Ahorcado("test",5);
        $palabra = $ahorcado->mostrar();
        $palabraOculta = "_ _ _ _";

        $this->assertEquals($palabraOculta,$palabra);
    }

    function testExistenVidasRestantes(){
        $ahorcado = new Ahorcado("test",5);
        $vidas = $ahorcado->vidasRestantes();

        $this->assertTrue(!empty($vidas));
    }

    function testVidasRestantesIniciales(){
        $ahorcado = new Ahorcado("test",5);
        $vidas = $ahorcado->vidasRestantes();
        
        $this->assertEquals(5,$vidas);
    }

    function testExisteJugar(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("");

        $this->assertTrue(True);
    }

    function testLetraIncorrectaMostrar(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("a");
        $palabra = $ahorcado->mostrar();
        $palabraOculta = "_ _ _ _";

        $this->assertEquals($palabraOculta,$palabra);
    }

    function testLetraIncorrectaVidas(){
        $ahorcado = new Ahorcado("test",5);
        $vidasInicio = $ahorcado->vidasRestantes();
        $ahorcado->jugar("a");
        $vidas = $ahorcado->vidasRestantes();

        $this->assertEquals($vidasInicio - 1,$vidas);
    }

    function testDosLetrasInconrrectasVidas(){
        $ahorcado = new Ahorcado("test",5);
        $vidasInicio = $ahorcado->vidasRestantes();
        $ahorcado->jugar("a");
        $ahorcado->jugar("o");
        $vidas = $ahorcado->vidasRestantes();

        $this->assertEquals($vidasInicio - 2,$vidas);
    }

    function testDosLetrasIncorrectasMostrar(){
        $ahorcado = new Ahorcado("test",5);
        $palabraOculta = "_ _ _ _";
        $ahorcado->jugar("a");
        $ahorcado->jugar("o");
        $palabra = $ahorcado->mostrar();

        $this->assertEquals($palabraOculta,$palabra);
    }

    function testLetraCorrectaVidas(){
        $ahorcado = new Ahorcado("test",5);
        $vidasInicio = $ahorcado->vidasRestantes();
        $ahorcado->jugar("e");
        $vidas = $ahorcado->vidasRestantes();

        $this->assertEquals($vidasInicio,$vidas);
    }

    function testLetraCorrectaMostrar(){
        $ahorcado = new Ahorcado("test",5);
        $palabraOculta = "_ e _ _";
        $ahorcado->jugar("e");
        $palabra = $ahorcado->mostrar();

        $this->assertEquals($palabraOculta,$palabra);
    }

    function testLetraCorrectaMultiple(){
        $ahorcado = new Ahorcado("test",5);
        $palabraOculta = "t _ _ t";
        $vidasInicio = $ahorcado->vidasRestantes();
        $ahorcado->jugar("t");
        $palabra = $ahorcado->mostrar();
        $vidas = $ahorcado->vidasRestantes();

        $this->assertEquals($palabraOculta,$palabra);
        $this->assertEquals($vidasInicio,$vidas);
    }

    function testPuedoGanar(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->gane();
        $this->assertTrue(True);
    }

    function testGane(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("t");
        $ahorcado->jugar("e");
        $ahorcado->jugar("s");

        $this->assertTrue($ahorcado->gane());
    }

    function testNoGane(){
        $ahorcado = new Ahorcado("test",5);
        $this->assertFalse($ahorcado->gane());
    }

    function testPerdi(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("a");
        $ahorcado->jugar("a");
        $ahorcado->jugar("a");
        $ahorcado->jugar("a");
        $ahorcado->jugar("a");

        $this->assertTrue($ahorcado->perdi());
    }

    function testNoPerdi(){
        $ahorcado = new Ahorcado("test",5);
        $this->assertFalse($ahorcado->perdi());
    }

    function testTerminoNoJueguesMas(){
        $ahorcado = new Ahorcado("test",1);
        $ahorcado->jugar("a");
        $this->assertFalse($ahorcado->jugar("e"));
    }

    function testTerminoNoJueguesMasGanaste(){
        $ahorcado = new Ahorcado("test",5);
        $ahorcado->jugar("t");
        $ahorcado->jugar("e");
        $ahorcado->jugar("s");

        $this->assertFalse($ahorcado->jugar("a") and !$ahorcado->gane());
    }

    function testTerminoNoJueguesMasPerdiste(){
        $ahorcado = new Ahorcado("test",1);
        $ahorcado->jugar("a");

        $this->assertFalse($ahorcado->jugar("a") and !$ahorcado->perdi());
    }
}
