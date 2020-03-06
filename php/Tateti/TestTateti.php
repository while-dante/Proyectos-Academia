<?php

require_once("./vendor/autoload.php");
require_once("Tateti.php");

use PHPUnit\Framework\TestCase;

final class TatetiTest extends TestCase{

    function testAndaTodo(){
        $this->assertTrue(True);
    }

    function testExisteClaseTateti(){
        $this->assertTrue(class_exists("Tateti"));
    }

    function testExisteTateti(){
        $tateti = new Tateti();
        $this->assertTrue(!empty($tateti));
    }

    function testMostrarEsArray(){
        $tateti = new Tateti();
        $this->assertTrue(is_array($tateti->mostrar()));
    }

    function testMostrarTablero(){
        $tateti = new Tateti();
        $tablero = $tateti->mostrar();
        $tableroEsperado = array(array(" "," "," "),array(" "," "," "),array(" "," "," "));
        $this->assertEquals($tableroEsperado,$tablero);
    }

    function testPuedoJugar(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $this->assertTrue(True);
    }

    function testJugarX(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $tableroEsperado = array(array("X"," "," "),array(" "," "," "),array(" "," "," "));
        $this->assertEquals($tableroEsperado,$tateti->mostrar());
    }

    function testJugarO(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $tateti->jugar(0,1);
        $tableroEsperado = array(array("X","O"," "),array(" "," "," "),array(" "," "," "));
        $this->assertEquals($tableroEsperado,$tateti->mostrar());
    }

    function testJugarMismaPosicion(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $tateti->jugar(0,0);
        $tableroEsperado = array(array("X"," "," "),array(" "," "," "),array(" "," "," "));
        $this->assertEquals($tableroEsperado,$tateti->mostrar());
    }

     function testPuedeGanarX(){
        $tateti = new Tateti();
        $tateti->ganoX();
        $this->assertTrue(True);
    }
    
    function testPuedeGanarO(){
        $tateti = new Tateti();
        $tateti->ganoO();
        $this->assertTrue(True);
    }

    function testPuedenEmpatar(){
        $tateti = new Tateti;
        $tateti->empate();
        $this->assertTrue(True);
    }

    function testNoGanoNadieTodavia(){
        $tateti = new Tateti();
        $tateti->jugar(1,1);
        $tateti->jugar(0,2);

        $this->assertTrue(is_null($tateti->ganoX()));
        $this->assertTrue(is_null($tateti->ganoO()));
        $this->assertTrue(is_null($tateti->empate()));
    }

    function testGanoAlguien(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $tateti->jugar(1,1);
        $tateti->jugar(0,1);
        $tateti->jugar(2,0);
        $tateti->jugar(0,2);

        $resultado = "Ganador: X";

        $this->assertTrue(is_null($tateti->ganoO()));
        $this->assertTrue(is_null($tateti->empate()));
        $this->assertEquals($resultado,$tateti->ganoX());

        $tateti = new Tateti();
        $tateti->jugar(1,1);
        $tateti->jugar(0,0);
        $tateti->jugar(0,1);
        $tateti->jugar(1,0);
        $tateti->jugar(2,1);

        $resultado = "Ganador: X";

        $this->assertTrue(is_null($tateti->ganoO()));
        $this->assertTrue(is_null($tateti->empate()));
        $this->assertEquals($resultado,$tateti->ganoX());

        $tateti = new Tateti();
        $tateti->jugar(1,1);
        $tateti->jugar(0,0);
        $tateti->jugar(1,2);
        $tateti->jugar(1,0);
        $tateti->jugar(0,2);
        $tateti->jugar(2,0);

        $resultado = "Ganador: O";

        $this->assertTrue(is_null($tateti->ganoX()));
        $this->assertTrue(is_null($tateti->empate()));
        $this->assertEquals($resultado,$tateti->ganoO());

        $tateti = new Tateti();
        $tateti->jugar(0,1);
        $tateti->jugar(1,1);
        $tateti->jugar(0,2);
        $tateti->jugar(0,0);
        $tateti->jugar(2,0);
        $tateti->jugar(2,2);

        $resultado = "Ganador: O";

        $this->assertTrue(is_null($tateti->ganoX()));
        $this->assertTrue(is_null($tateti->empate()));
        $this->assertEquals($resultado,$tateti->ganoO());

        $tateti = new Tateti();
        $tateti->jugar(1,1);
        $tateti->jugar(1,2);
        $tateti->jugar(2,0);
        $tateti->jugar(2,2);
        $tateti->jugar(0,2);

        $resultado = "Ganador: X";

        $this->assertTrue(is_null($tateti->ganoO()));
        $this->assertTrue(is_null($tateti->empate()));
        $this->assertEquals($resultado,$tateti->ganoX());
    }

    function testEmpataron(){
        $tateti = new Tateti();
        $mensaje = "Empate, gano la Vieja";

        $tateti->jugar(1,1);
        $tateti->jugar(0,2);
        $tateti->jugar(0,0);
        $tateti->jugar(2,2);
        $tateti->jugar(1,2);
        $tateti->jugar(1,0);
        $tateti->jugar(2,1);
        $tateti->jugar(0,1);
        $tateti->jugar(2,0);

        $this->assertTrue(is_null($tateti->ganoX()));
        $this->assertTrue(is_null($tateti->ganoO()));
        $this->assertEquals($mensaje,$tateti->empate());
    }

    function testTerminoNoPonerMasLetras(){
        $tateti = new Tateti();
        $tateti->jugar(1,1);
        $tateti->jugar(1,2);
        $tateti->jugar(2,0);
        $tateti->jugar(2,2);
        $tateti->jugar(0,2);

        $tableroFinal = $tateti->mostrar();

        $tateti->jugar(0,1);
        $this->assertEquals($tableroFinal,$tateti->mostrar());

        $tateti = new Tateti();

        $tateti->jugar(1,1);
        $tateti->jugar(0,2);
        $tateti->jugar(0,0);
        $tateti->jugar(2,2);
        $tateti->jugar(1,2);
        $tateti->jugar(1,0);
        $tateti->jugar(2,1);
        $tateti->jugar(0,1);
        $tateti->jugar(2,0);
        
        $tableroFinal = $tateti->mostrar();

        $tateti->jugar(1,1);
        $this->assertEquals($tableroFinal,$tateti->mostrar());

        $tateti = new Tateti();
        $tateti->jugar(0,1);
        $tateti->jugar(1,1);
        $tateti->jugar(0,2);
        $tateti->jugar(0,0);
        $tateti->jugar(2,0);
        $tateti->jugar(2,2);

        $tableroFinal = $tateti->mostrar();

        $tateti->jugar(1,0);
        $this->assertEquals($tableroFinal,$tateti->mostrar());
    }

    function testMostrarLindo(){
        $tateti = new Tateti();
        $tateti->mostrarLindo();

        $this->assertTrue(True);
    }

    function testMostrarTableroLindo(){
        $tateti = new Tateti();
        $tablero = $tateti->mostrarLindo();

        $this->assertEquals("| || || |\n| || || |\n| || || |",$tablero);
    }

    function testMostrarTableroJugado(){
        $tateti = new Tateti();
        $tateti->jugar(0,0);
        $tablero = $tateti->mostrarLindo();

        $this->assertEquals("|X|| || |\n| || || |\n| || || |",$tablero);
    }
}