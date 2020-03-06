<?php

//Clase Calculadora que nos paso Dario
//Hay que testearla

class Calculadora {
  
  function sumar($a, $b) {
    return $a + $b;
  }
  
  function restar($a, $b) {
    return $this->sumar($a, (-1)*$b);
  }
  
  function dividir($a, $b) {
    $resultado = 0;
    
    if (($a < 0 and $b > 0) or ($a > 0 and $b < 0)){
      $a = abs($a);
      $b = abs($b);

      while(($a - $b) >= 0) {
        $a = $a - $b;
        $resultado = $resultado + 1;
      }
      return (-1)*$resultado;
    }

    $a = abs($a);
    $b = abs($b);

    while(($a - $b) >= 0) {
      $a = $a - $b;
      $resultado = $resultado + 1;
    }
    return $resultado;
  }
  
  function multiplicar($a, $b) {
    $resultado = 0;

    if (($a < 0 and $b > 0) or ($a > 0 and $b < 0)){
      $a = abs($a);
      $b = abs($b);

      while ($b>0) {
        $resultado = $resultado+$a;
        $b = $b-1;
      }
      return (-1)*$resultado;
    }
    
    $a = abs($a);
    $b = abs($b);

    while ($b>0) {
      $resultado = $resultado+$a;
      $b = $b-1;
    }
    return $resultado;
  }
}

