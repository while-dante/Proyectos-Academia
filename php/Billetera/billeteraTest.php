<?php

require_once("./vendor/autoload.php"); //Incluye todo lo necesario para poder usar PHPUnit

include("billetera.php"); //Incluye nuestro archivo para poder usarlo

use PHPUnit\Framework\TestCase;  //use es un "namespace" que separa codigo y tedeja tener clases iguales
final class BilleteraTest extends TestCase{
    
    function testExisteBilletera(){
        $billetera = new Billetera();

        $this->assertTrue(!empty($billetera));
    }

    function testAgregarPlata(){
        $billetera = new Billetera();
        $billetera->agregarPlata(100,5);

        $this->assertTrue(True);
    }

    function testTieneTotal(){
        $billetera = new Billetera();
        $total = $billetera->total();

        $this->assertTrue($total === 0);
    }

    function testAgregarPlataYVerificarTotal(){
        $billetera = new Billetera();
        $billetera->agregarPlata(100,5);
        $total = $billetera->total();

        $this->assertTrue($total === 500);
    }

    function testAgregarDosVecesPlata(){
        $billetera = new Billetera();
        $billetera->agregarPlata(100,5);
        $billetera->agregarPlata(20,10);
        $total = $billetera->total();

        $this->assertEquals(700,$total);
    }

    function testAgregarDosVecesLoMismo(){
        $billetera = new Billetera();
        $billetera->agregarPlata(100,5);
        $billetera->agregarPlata(100,5);
        $total = $billetera->total();

        $this->assertEquals(1000,$total);
    }

    function testExisteSacarPlata(){
        $billetera = new Billetera();
        $billetera->sacarPlata(100,1);
        $total = $billetera->total();

        $this->assertEquals(0,$total);
    }

    function testSacarPlata(){
        $billetera = new Billetera();
        $billetera->agregarPlata(100,5);
        $billetera->sacarPlata(100,1);
        $total = $billetera->total();

        $this->assertEquals(400,$total);
    }

    function testSacarDosVecesLoMismo(){
        $billetera = new Billetera;
        $billetera->agregarPlata(100,5);
        $billetera->sacarPlata(100,3);
        $billetera->sacarPlata(100,2);
        $total = $billetera->total();

        $this->assertEquals(0,$total);
    }

    function testSacarDeMas(){
        $billetera = new Billetera;
        $billetera->agregarPlata(100,5);
        $billetera->sacarPlata(100,6);
        $total = $billetera->total();

        $this->assertEquals(500,$total);
    }
}
