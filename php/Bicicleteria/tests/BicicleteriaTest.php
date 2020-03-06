<?php
/**
 * 
 * Tareas:
 *  - Bajar composer
 *  - Instalar phpunit
 *  - Revisar los tests
 *  - Leer la explicación de la clase
 *  - Que pasen los tests
 *  - Conquistar el mundo
 *  - Aprobar el curso!
 * 
 */
include './vendor/autoload.php';
include './lib/Bicicleteria.php';

use PHPUnit\Framework\TestCase;

final class BicicleteriaTest extends TestCase
{
  public function testArrancaVacio() {
    $bici = new Bicicleteria();
    $this->assertEquals(0, $bici->cantidadBicicletas());
  }

  public function testArmaUnaBicicleta() {
    $bici = new Bicicleteria();
    $bici->agregarRuedas(2);
    $bici->agregarVolante(1);
    $bici->agregarCuadro(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());
  }

  public function testArmaUnaBicicletaYsacaCuadro() {
    $bici = new Bicicleteria();
    $bici->agregarRuedas(2);
    $bici->agregarVolante(1);
    $bici->agregarCuadro(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());

    $bici->sacarCuadro(1);
    $this->assertEquals(0, $bici->cantidadBicicletas());
  }
  
  public function testArmaUnaBicicletaYsacaRueda() {
    $bici = new Bicicleteria();
    $bici->agregarRuedas(2);
    $bici->agregarVolante(1);
    $bici->agregarCuadro(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());

    $bici->sacarRuedas(1);
    $this->assertEquals(0, $bici->cantidadBicicletas());
  }
  
  public function testArmaUnaBicicletaYsacaVolante() {
    $bici = new Bicicleteria();
    $bici->agregarRuedas(2);
    $bici->agregarVolante(1);
    $bici->agregarCuadro(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());

    $bici->sacarVolante(1);
    $this->assertEquals(0, $bici->cantidadBicicletas());
  }

  public function testArmaMasDeUnaBicicleta() {
    $bici = new Bicicleteria();
    $bici->agregarRuedas(4);
    $bici->agregarVolante(2);
    $bici->agregarCuadro(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());
    $bici->agregarCuadro(2);
    $this->assertEquals(2, $bici->cantidadBicicletas());

    $bici->sacarVolante(1);
    $this->assertEquals(1, $bici->cantidadBicicletas());
  }

}