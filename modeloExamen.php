<?php
/**
 * =====================================
 * 1 - Cuanto vale $a en los tres casos:
 * =====================================
 */
//a
$a = 10;
function ej1_a() {
  $a = 11;
}
ej1_a();
//cuanto vale a?

/*$a vale 10.*/

//b
$b = 10;
function ej1_b() {
  global $b;
  $b = 11;
}
ej1_b();
//cuanto vale b?

/*$b vale 11*/

//c
$c = 10;
function ej1_c() {
  $c = 11;
  global $c;
}
ej1_c();
//cuanto vale c?

/*$c vale 10*/ 

//d
$d = 10;
function ej1_d() {
  global $d;
  $d = 11;
}
//cuanto vale d?

/*$d vale 10*/

//e
$e = 11;
function ej1_e1() {
  ej1_e2();
  $e = 12;
}

function ej1_e2() {
  global $e;
}
ej1_e1();
//cuanto vale $e?

/*$e vale 11*/

/**
 * =====================================
 * 2 - imprimir secuencias con bucles
 * =====================================
 */
//a - Escribir un bucle for y un while donde se
//    imprimen solo los valores impares desde 0 a 20

for($i = 0; $i <= 20; $i = $i + 1){
    if($i%2 != 0){
        print "$i";
    }
}

$i = 0;
while ($i <= 20){
    if($i%2 != 0){
        print "$i";
    }
    $i = $i + 1;
}

//b - Igual al punto a pero en orden inverso salteando de a uno
//    (imprime la mitad de numeros)

for($i = 20; $i >= 0; $i = $i - 2){
        print "$i";
}

$i = 20;
while ($i >= 0){
    print "$i";
    $i = $i - 2;
}

for($i = 19; $i >= 0; $i = $i - 4){
    print "$i";
}

$i = 19;
while ($i >= 0){
    print "$i";
    $i = $i - 4;
}

//c - Crear un arreglo de 10 elementos y recorrerlo
//    con un foreach en ambos sentidos
//    (hint: puede usar funciones de array antes de entrar al foreach)

$arreglo10 = array();

for ($i = 0; $i < 10; $i = $i + 1){
    $arreglo10[] = $i;
}

foreach ($arreglo10 as $key => $value){
    $arreglo10[$key];
}

$arreglo10 = array_reverse($arreglo10);

foreach ($arreglo10 as $key => $value){
    $arreglo10[$key];
}

//d - Crear un arreglo de 10 elementos y recorrerlo de ambos sentidos
//    con un for y un while

$arreglo10 = array();

for ($i = 0; $i < 10; $i = $i + 1){
    $arreglo10[] = $i;
}

for ($i = 0; $i < count($arreglo10); $i = $i + 1){
    $arreglo10[$i];
}

for ($i = count($arreglo10) - 1; $i >= 0; $i = $i - 1){
    $arreglo10[$i];
}

$i = 0;
while ($i < count($arreglo10)){
    $arreglo10[$i];
    $i = $i + 1;
}

$i = count($arreglo10) - 1;
while ($i >= 0){
    $arreglo10[$i];
    $i = $i - 1;
}

/**
 * =====================================
 * 3 - Arreglos
 * =====================================
 */
//a - Crear un arreglo de una dimensión de mil elementos
//    con claves consecutivas

$arreglo1000 = array();

$i = 0;
while ($i < 1000){
    $arreglo1000[] = "xd";
}

//b - Crea un arreglo de 100 elementos con claves numericas pero pares
//    Ej: $a[0], $a[2], $a[4] deben existir, $a[1], $a[3] no deben existir

$arreglo100 = array();

$i = 0;
while ($i < 100){
    $arreglo100[2*$i] = $i;
    $i = $i + 1;
}

//c - Si nos pasan un arreglo y no sabemos el contenido, cual suele ser la mejor
//    forma de recorrerlo? Se puede de más formas?

/* Con un foreach. Si quisieramos usar for o while deberiamos guardar el contenido del arreglo en un arreglo nuevo con claves consecutivas*/
 
/**
 * =====================================
 * 4 - funciones
 * =====================================
 */
//a - Crear una funcion que dado un arreglo/array duplica todos los valores
$ar = array(1, 2, 3);
function ej4_a($ar){
    foreach ($ar as $pos => $valor){
        $ar[$pos] = 2*$valor;
    }
    return $ar;
} // tiene que modificar todos los valores y duplicarlos

//b - Crea una funcion que dado un arreglo/array te devuelve un nuevo arreglo
//    con los valores duplicados pero no modifica el original (debe crear un
//    nuevo arreglo)

$ar = array(1, 2, 3);
$newArray = array();

function createNewArray($ar, $newArray){
    foreach ($ar as $pos => $valor){
        $newArray[] = 2*$valor;
    }
    return $newArray;
}

$newArray = createNewArray($ar,$newArray);

//c - De un ejemplo de función recursiva

function recursin($str){
    if ($str === "hola"){
        return "hola";
    }
    else{
        recursin("hola");
    }
}

//d - En este psuedo codigo, puede decirme si anda si lo programaramos en PHP?
//    Que devuelve? Que estamos calculando?
/**
f1( $var1 ) {
  if $var1 > 1{
    return $var1 * f2($var1 - 1)
  }
  return $var1
}
f2( $var2 ) {
  if $var2 > 1{
    return $var2 * f1($var2 - 1)
  }
  return $var2
}
f1(5) // cuanto devuelve?
      // que esta calculando?
*/

/* Devuelve 120, estamos calculando el factorial */

/**
 * =====================================
 * 5 - A desarrollar
 * =====================================
 */

//a - Arregle el siguiente codigo
$a = array(1,2,3);
$b = array(4,5,6);

echo "Las keys del arreglo a son: \n";

foreach ($a as $k => $v){
  echo $k . "\n";
}

echo "\n\n";

// duplico todos los elementos sin agregar nuevos

foreach ($b as $k => $v){
  $b[$k] = $v*2;
}