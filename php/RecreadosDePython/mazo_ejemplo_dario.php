<?php
function crear_mazo($n) {
  $mazo = array();
  $k = 0;
  while ($k<$n){
    $i = 1;
    while ($i<=13) {
      $j = 1;
      while ($j <= 4) {
        $mazo[] = $i;
        $j=$j+1;
      }
      $i=$i+1;
    }
    $k = $k+1;
  }
  return $mazo;
}
$mazos = crear_mazo(5);
print_r($mazos);
