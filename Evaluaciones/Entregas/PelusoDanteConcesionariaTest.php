<?php

require_once("Concesionaria.php");
require_once("./vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class ConcesionariaTest extends TestCase{

    function testAndaTodo(){
        $this->assertTrue(True);
    }

    function testExisteClaseConcesionaria(){
        $this->assertTrue(class_exists("Concesionaria"));
    }

    function testExisteConcesionaria(){
        $consecionaria = new Concesionaria();
        $this->assertTrue(!empty($consecionaria));
    }

    function testSePuedeAgregarUnAuto(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("id","audi",2,2007,500000);
        $this->assertTrue(True);
    }

    function testAgregarUnAuto(){
        $consecionaria = new Concesionaria();
        $confirmacion = $consecionaria->agregarAutos("id","audi",2,2007,500000);
        $this->assertTrue($confirmacion);
    }

    function testAgregarAutosMismaId(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("id","audi",2,2007,500000);
        $confirmacion = $consecionaria->agregarAutos("id","audi",2,2007,500000);

        $this->assertFalse($confirmacion);
    }

    function testAgregarAutosDistintaId(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("id","audi",2,2007,500000);
        $confirmacion = $consecionaria->agregarAutos("id pero distinta","audi",2,2007,500000);

        $this->assertTrue($confirmacion);
    }

    function testSePuedenMostrarAutos(){
        $consecionaria = new Concesionaria();
        $consecionaria->mostrarAutosDeMarca("marca");
        $this->assertTrue(True);
    }

    function testMostrarUnAutoQueEsta(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("01","audi",2,2007,500000);

        $autosEsperados = array(array(
        'id' => "01",
        'marca' => "audi",
        'modelo' => 2,
        'anio' => 2007,
        'precio' => 500000,
        ));
        $autosDevueltos = $consecionaria->mostrarAutosDeMarca("audi");

        $this->assertEquals($autosEsperados,$autosDevueltos);
    }

    function testMostrarUnAutoQueNoEsta(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("03","ford",2,2007,500000);

        $autosEsperados = array();
        $autosDevueltos = $consecionaria->mostrarAutosDeMarca("audi");

        $this->assertEquals($autosEsperados,$autosDevueltos);
    }

    function testMostarAutosDeUnaMarca(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("01","audi",2,2007,500000);
        $consecionaria->agregarAutos("02","audi",2,2007,500000);
        $consecionaria->agregarAutos("03","ford",2,2007,500000);

        $autosEsperados = array(array(
        'id' => "01",
        'marca' => "audi",
        'modelo' => 2,
        'anio' => 2007,
        'precio' => 500000,
        ),array(
        'id' => "02",
        'marca' => "audi",
        'modelo' => 2,
        'anio' => 2007,
        'precio' => 500000,
        ));
        $autosDevueltos = $consecionaria->mostrarAutosDeMarca("audi");

        $this->assertEquals($autosEsperados,$autosDevueltos);
    }

    function testSePuedenVenderAutos(){
        $consecionaria = new Concesionaria();
        $consecionaria->venderAutoMarca("marca");
        $this->assertTrue(True);
    }

    function testVenderUnAuto(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("01","audi",2,2007,500000);
        $consecionaria->agregarAutos("02","audi",2,2007,600000);
        $consecionaria->agregarAutos("03","ford",2,2007,500000);

        $precio = 600000;
        $venta = $consecionaria->venderAutoMarca("audi");
        $this->assertEquals($precio,$venta); //Este lo pasa
        $this->assertTrue($precio === $venta); //Este no <NOTA>

        /*<NOTA>: ver el siguiente test (testVenderUnAutoQueNoHay)
        para la explicacion.*/

        $autosEsperadosAudi = array(array(
            'id' => "01",
            'marca' => "audi",
            'modelo' => 2,
            'anio' => 2007,
            'precio' => 500000,
            ));
        $autosDevueltosAudi = $consecionaria->mostrarAutosDeMarca("audi");
        $this->assertEquals($autosEsperadosAudi,$autosDevueltosAudi);

        $autosEsperadosFord = array(array(
            'id' => "03",
            'marca' => "ford",
            'modelo' => 2,
            'anio' => 2007,
            'precio' => 500000,
            ));
        $autosDevueltosFord = $consecionaria->mostrarAutosDeMarca("ford");
        $this->assertEquals($autosEsperadosFord,$autosDevueltosFord);
    }

    function testVenderUnAutoQueNoHay(){
        $consecionaria = new Concesionaria();
        $consecionaria->agregarAutos("01","audi",2,2007,500000);
        $consecionaria->agregarAutos("02","audi",2,2007,600000);
        $consecionaria->agregarAutos("03","ford",2,2007,500000);

        $precio = 0;
        $venta = $consecionaria->venderAutoMarca("toyota");
        $this->assertEquals($precio,$venta); //Este test lo pasa
        $this->assertTrue($precio === $venta); //Este no

        /*
        Al parecer el Equals considera que un False y un 0 son lo mismo.
        La funcion venderAutoMarca falla en dar un 0 si no quedan autos de
        una marca para vender, devuelve un False en su lugar.

        Implemento el ultimo assertTrue en el test anterior.
        */
    }

    function testRespuestasDeAssertEquals(){
        $a = 0;
        $b = 3;
        $c = -1;

        $this->assertEquals(False,$a);
        $this->assertEquals(True,$b);
        $this->assertEquals(True,$c);

        /*Pasa los tres tests, si se cambia un booleano por su
        opuesto falla. Parece que Equals considera enteros no nulos como True
        y 0 como False*/
    }

    function testSePuedeVerElTotalDeGanancias(){
        $consecionaria = new Concesionaria();
        $consecionaria->totalGanado();
        $this->assertTrue(True);
    }

    function testTotalGanado(){
        $consecionaria = new Concesionaria();
        $totalEsperado = 0;
        $totalDevuelto = $consecionaria->totalGanado();
        $this->assertEquals($totalEsperado,$totalDevuelto);

        $consecionaria->agregarAutos("01","audi",2,2007,500000);
        $consecionaria->agregarAutos("02","audi",2,2007,600000);
        $consecionaria->agregarAutos("03","ford",2,2007,500000);
        
        $consecionaria->venderAutoMarca("audi");

        $totalEsperado = 600000;
        $totalDevuelto = $consecionaria->totalGanado();
        $this->assertEquals($totalEsperado,$totalDevuelto);

        $consecionaria->venderAutoMarca("ford");

        $totalEsperado = 600000 + 500000;
        $totalDevuelto = $consecionaria->totalGanado();
        $this->assertEquals($totalEsperado,$totalDevuelto);
    }
}
