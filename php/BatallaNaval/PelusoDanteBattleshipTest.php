<?php 

//Test Batalla Naval

require_once("BatallaNaval.php");
require_once("./vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class TestBattleship extends TestCase{

    function testAndaTodo(){
        $this->assertTrue(True);
    }

    function testExisteClaseBattleship(){
        $this->assertTrue(class_exists("Battleship"));
    }

    function testExisteBattleship(){
        $battleship = new Battleship(20,20,10);
        $this->assertTrue(!empty($battleship));
    }

    function testExisteMostrarTableros(){
        $battleship = new Battleship(20,20,10);
        $battleship->mostrarTableroJugador1();
        $battleship->mostrarTableroJugador2();
        $this->assertTrue(True);
    }

    function testExistenTableros(){
        $battleship = new Battleship(20,20,10);
        $tableroJugador1 = $battleship->mostrarTableroJugador1();
        $tableroJugador2 = $battleship->mostrarTableroJugador1();

        $this->assertTrue(!empty($tableroJugador1));
        $this->assertTrue(!empty($tableroJugador2));
    }

    function testTablerosVacios(){
        $battleship = new Battleship(2,2,0);
        $tableroVacio1 = $battleship->mostrarTableroJugador1();
        $tableroVacio2 = $battleship->mostrarTableroJugador2();
        $tableroEsperado = array(array(0,0),array(0,0));
        
        $this->assertEquals($tableroEsperado,$tableroVacio1);
        $this->assertEquals($tableroEsperado,$tableroVacio2);
    }

    function testPuedenColocarNaves(){
        $battleship = new BAttleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $this->assertTrue(True);
    }

    function testNaveColocada(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);
        
        $tablero1 = $battleship->mostrarTableroJugador1();
        $tablero2 = $battleship->mostrarTableroJugador2();
        $tableroEsperado1 = array(array(1,0),array(0,0));
        $tableroEsperado2 = array(array(0,0),array(0,1));

        $this->assertEquals($tableroEsperado1,$tablero1);
        $this->assertEquals($tableroEsperado2,$tablero2);
    }

    function testPonerNavesDeMas(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador1(1,1);

        $tableroEsperado = array(array(1,0),array(0,0));
        $tablero = $battleship->mostrarTableroJugador1();

        $this->assertEquals($tableroEsperado,$tablero);
    }

    function testNavesRestantes(){
        $battleship = new Battleship(2,2,2);
        $naves1 = $battleship->mostrarNavesRestantes1();
        $naves2 = $battleship->mostrarNavesRestantes2();

        $this->assertEquals(2,$naves1);
        $this->assertEquals(2,$naves2);

        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(0,0);

        $naves1 = $battleship->mostrarNavesRestantes1();
        $naves2 = $battleship->mostrarNavesRestantes2();
        
        $this->assertEquals(1,$naves1);
        $this->assertEquals(1,$naves2);
    }

    function testPonerNaveEnMismoLugar(){
        $battleship = new Battleship(2,2,2);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador1(0,0);

        $naves1 = $battleship->mostrarNavesRestantes1();
        $this->assertEquals(1,$naves1);
    }

    function testPuedenDisparar(){
        $battleship = new Battleship(2,2,1);
        $battleship->disparoTurnoJugador1(0,0);
        $battleship->disparoTurnoJugador2(0,0);

        $this->assertTrue(True);
    }

    function testDisparoAgua(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(0,1);
        $resultadoEsperado1 = array(array(0,0),array(0,1));
        $resultado1 = $battleship->mostrarTableroJugador2();

        $battleship->disparoTurnoJugador2(0,1);
        $resultadoEsperado2 = array(array(1,0),array(0,0));
        $resultado2 = $battleship->mostrarTableroJugador1();

        $this->assertEquals($resultadoEsperado1,$resultado1);
        $this->assertEquals($resultadoEsperado2,$resultado2);
    }

    function testDisparoNave(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(1,1);
        $resultadoEsperado1 = array(array(0,0),array(0,2));
        $resultado1 = $battleship->mostrarTableroJugador2();

        $battleship->disparoTurnoJugador2(0,0);
        $resultadoEsperado2 = array(array(2,0),array(0,0));
        $resultado2 = $battleship->mostrarTableroJugador1();

        $this->assertEquals($resultadoEsperado1,$resultado1);
        $this->assertEquals($resultadoEsperado2,$resultado2);
    }

    function testPuedenGanar(){
        $battleship = new Battleship(2,2,1);
        $battleship->ganoJugador1();
        $battleship->ganoJugador2();

        $this->assertTrue(True);
    }

    function testNoGanoNadieTodavia(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);
        
        $this->assertTrue(is_null($battleship->ganoJugador1()));
        $this->assertTrue(is_null($battleship->ganoJugador2()));

        $battleship->disparoTurnoJugador1(0,1);
        $this->assertTrue(is_null($battleship->ganoJugador1()));
        $this->assertTrue(is_null($battleship->ganoJugador2()));

        $battleship->disparoTurnoJugador2(0,1);
        $this->assertTrue(is_null($battleship->ganoJugador1()));
        $this->assertTrue(is_null($battleship->ganoJugador2()));
    }

    function testGanoJugador1(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(1,1);
        $mensaje = $battleship->ganoJugador1();

        $this->assertEquals("Ganador: Jugador 1",$mensaje);
        $this->assertTrue(is_null($battleship->ganoJugador2()));
    }

    function testGanoJugador2(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(1,0);
        $battleship->disparoTurnoJugador2(0,0);
        $mensaje = $battleship->ganoJugador2();

        $this->assertTrue(is_null($battleship->ganoJugador1()));
        $this->assertEquals("Ganador: Jugador 2",$mensaje);
    }

    function testElJuegoTermina(){
        $battleship = new Battleship(2,2,1);
        $battleship->terminoElJuego();

        $this->assertTrue(True);
    }

    function testTerminoElJuego(){
        $battleship = new Battleship(2,2,1);
        $mensaje = $battleship->terminoElJuego();

        $this->assertEquals("Fin del Juego",$mensaje);
    }

    function testNoTerminoTodavia(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);
        $this->assertTrue(is_null($battleship->terminoEljuego()));

        $battleship->disparoTurnoJugador1(0,1);
        $this->assertTrue(is_null($battleship->terminoEljuego()));

        $battleship->disparoTurnoJugador2(0,1);
        $this->assertTrue(is_null($battleship->terminoEljuego()));

        $battleship->disparoTurnoJugador1(0,0);
        $this->assertTrue(is_null($battleship->terminoEljuego()));

        $battleship->disparoTurnoJugador2(0,0);
        $mensaje = $battleship->terminoElJuego();
        $mensaje2 = $battleship->ganoJugador2();

        $this->assertTrue(is_null($battleship->ganoJugador1()));
        $this->assertEquals("Ganador: Jugador 2",$mensaje2);
        $this->assertEquals("Fin del Juego",$mensaje);
    }

    function testSePuedenVerTurnos(){
        $battleship = new Battleship(2,2,1);
        $battleship->cuantosTurnosPasaron();
        
        $this->assertTrue(True);
    }

    function testCuantosTurnosPasaron(){
        $battleship = new Battleship(2,2,1);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(0,0);
        $turnos = $battleship->cuantosTurnosPasaron();
        $this->assertEquals(1,$turnos);

        $battleship->disparoTurnoJugador2(1,0);
        $turnos = $battleship->cuantosTurnosPasaron();
        $this->assertEquals(2,$turnos);
    }

    function testNoDispararMasDeUnaVez(){
        $battleship = new Battleship(2,2,2);
        $battleship->colocarNaveJugador2(0,0);
        $battleship->colocarNaveJugador2(1,1);

        $battleship->disparoTurnoJugador1(0,0);
        $battleship->disparoTurnoJugador1(1,1);

        $tableroEsperado = array(array(2,0),array(0,1));
        $tablero = $battleship->mostrarTableroJugador2();

        $this->assertEquals($tableroEsperado,$tablero);

        $battleship = new Battleship(2,2,2);
        $battleship->colocarNaveJugador1(0,0);
        $battleship->colocarNaveJugador1(1,1);

        $battleship->disparoTurnoJugador2(0,0);
        $battleship->disparoTurnoJugador2(1,1);

        $tableroEsperado = array(array(2,0),array(0,1));
        $tablero = $battleship->mostrarTableroJugador1();

        $this->assertEquals($tableroEsperado,$tablero);
    }
}