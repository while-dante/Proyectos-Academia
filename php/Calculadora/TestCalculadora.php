<?php

require_once("./vendor/autoload.php");

require_once("Calculadora.php");

use PHPUnit\Framework\TestCase;

final Class TestCalculadora extends TestCase{

    function testAndaTodo(){
        $this->assertTrue(True);
    }

    function testExisteCalculadora(){
        $this->assertTrue(class_exists("Calculadora"));
    }

    function testSumarPositivos(){
        $calculadora = new Calculadora();
        $res = $calculadora->sumar(1,2);

        $this->assertEquals(3,$res);
    }

    function testSumarMismoNumero(){
        $calculadora = new Calculadora();
        $res = $calculadora->sumar(2,2);

        $this->assertEquals(4,$res);
    }

    function testConmutatividadSuma(){
        $calculadora = new Calculadora();
        $res1 = $calculadora->sumar(1,2);
        $res2 = $calculadora->sumar(2,1);

        $this->assertEquals($res1,$res2);
    }

    function testSumarNegativos(){
        $calculadora = new Calculadora();
        $res = $calculadora->sumar(-1,-2);
        $resConmutado = $calculadora->sumar(-2,-1);

        $this->assertEquals(-3,$res);
        $this->assertEquals(-3,$resConmutado);
    }

    function testSumarNegativoYPositivo(){
        $calculadora = new Calculadora();
        $res = $calculadora->sumar(4,-3);
        $resConmutado = $calculadora->sumar(-3,4);

        $this->assertEquals(1,$res);
        $this->assertEquals(1,$resConmutado);
    }

    function testSumarCero(){
        $calculadora = new Calculadora();
        $res0 = $calculadora->sumar(0,0);
        $res1 = $calculadora->sumar(7,0);
        $res1Conmutado = $calculadora->sumar(0,7);

        $this->assertEquals(0,$res0);
        $this->assertEquals(7,$res1);
        $this->assertEquals(7,$res1Conmutado);
    }

    function testRestarPositivos(){
        $calculadora = new Calculadora();
        $res = $calculadora->restar(10,3);
        $resConmutado = $calculadora->restar(3,10);

        $this->assertEquals(7,$res);
        $this->assertEquals(-7,$resConmutado);
    }

    function testRestarMismoNumero(){
        $calculadora = new Calculadora();
        $res = $calculadora->restar(314,314);

        $this->assertEquals(0,$res);
    }

    function testRestarNegativos(){
        $calculadora = new Calculadora();
        $res = $calculadora->restar(-2,-5);
        $resConmutado = $calculadora->restar(-5,-2);

        $this->assertEquals(3,$res);
        $this->assertEquals(-3,$resConmutado);
    }

    function testRestarNegativoYPositivo(){
        $calculadora = new Calculadora();
        $res = $calculadora->restar(-7,3);
        $resConmutado = $calculadora->restar(3,-7);

        $this->assertEquals(-10,$res);
        $this->assertEquals(10,$resConmutado);
    }

    function testRestarCero(){
        $calculadora = new Calculadora();
        $res = $calculadora->restar(8,0);
        $resConmutado = $calculadora->restar(0,8);

        $this->assertEquals(8,$res);
        $this->assertEquals(-8,$resConmutado);
    }

    function testDividirNumeroGrandePorNumeroChicoMismoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(10,2);
        $resNegativos = $calculadora->dividir(-10,-2);

        $this->assertEquals(5,$res);
        $this->assertEquals(5,$resNegativos);
    }

    function testDividirNumeroChicoPorNumeroGrandeMismoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(2,10);
        $resNegativos = $calculadora->dividir(-2,-10);

        $this->assertEquals(0,$res);
        $this->assertEquals(0,$resNegativos);
    }

    function testDividirNumeroGrandePorNumeroChicoDistintoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(-10,5);
        $resConmutado = $calculadora->dividir(10,-5);

        $this->assertEquals(-2,$res);
        $this->assertEquals(-2,$resConmutado);
    }

    function testDividirNumeroChicoPorNumeroGrandeDistintoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(-5,10);
        $resConmutado = $calculadora->dividir(5,-10);

        $this->assertEquals(0,$res);
        $this->assertEquals(0,$resConmutado);
    }

    function testDividirCero(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(0,1000);
        
        $this->assertEquals(0,$res);
    }

    function testDividirMismoNumero(){
        $calculadora = new Calculadora();
        $res = $calculadora->dividir(42,42);
        $resNegativos = $calculadora->dividir(-42,-42);

        $this->assertEquals(1,$res);
        $this->assertEquals(1,$resNegativos);
    }

    function testMultiplicarMismoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->multiplicar(5,7);
        $resConmutado = $calculadora->multiplicar(7,5);
        $resNegativos = $calculadora->multiplicar(-5,-7);
        $resNegativosConmutado = $calculadora->multiplicar(-7,-5);

        $this->assertEquals(35,$res);
        $this->assertEquals(35,$resConmutado);
        $this->assertEquals(35,$resNegativos);
        $this->assertEquals(35,$resNegativosConmutado);
    }

    function testMultiplicarDistintoSigno(){
        $calculadora = new Calculadora();
        $res = $calculadora->multiplicar(5,-7);
        $resConmutado = $calculadora->multiplicar(-7,5);
        $resSignosCambiados = $calculadora->multiplicar(-5,7);
        $resSignosCambiadosConmutado = $calculadora->multiplicar(7,-5);

        $this->assertEquals(-35,$res);
        $this->assertEquals(-35,$resConmutado);
        $this->assertEquals(-35,$resSignosCambiados);
        $this->assertEquals(-35,$resSignosCambiadosConmutado);
    }

    function testMultiplicarPorCero(){
        $calculadora = new Calculadora();
        $res0 = $calculadora->multiplicar(0,0);
        $res1 = $calculadora->multiplicar(5,0);
        $res1Conmutado = $calculadora->multiplicar(0,5);

        $this->assertEquals(0,$res0);
        $this->assertEquals(0,$res1);
        $this->assertEquals(0,$res1Conmutado);
    }
}