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

/*a vale 10*/

//b
$b = 10;
function ej1_b() {
  global $b;
  $b = 11;
}
ej1_b();
//cuanto vale b?

/*b vale 11*/

//c
$c = 10;
function ej1_c() {
  $c = 11;
  global $c;
}
ej1_c();
//cuanto vale c?

/*c vale 10*/

//d
$d = 10;
function ej1_d() {
  global $d;
  $d = 11;
}
//cuanto vale d?

/*d vale 10*/

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

/*e vale 11*/

//f
for($i=0;$i<2;$i++) {
}
echo $i;
// cuanto vale i?

/*i vale 2*/

//g
// Si dentro de una función queremos acceder
// al valor de una variable que esta fuera, como
// debermos hacerlo? Que diferencia tiene con el
// uso de global?

/*debemos pasarla como parametro, si usamos global cambiamos el scope de la variable.*/

/**
 * =====================================
 * 2 - imprimir secuencias con bucles
 * =====================================
 */
//a - Escribir un bucle for y un while donde se
//    imprimen solo los valores impares desde 20 a 0
//    Es decir, 19, 17, 15, 13

for($i = 20; $i > 0; $i-=1){
  if($i%2 != 0){
    print "$i";
  }
}

$i = 20;
while($i > 0){
  if($i%2 != 0){
    print "$i";
  }
  $i = $i - 1;
}

//b - Igual al punto a pero en orden inverso salteando de a uno
//    (imprime la mitad de numeros)

for($i = 1; $i < 20; $i+=4){
  print "$i";
}

$i = 1;
while($i < 20){
  print "$i";
  $i = $i + 4;
}

//c - Crear un arreglo de 10 elementos y recorrerlo
//    con un foreach en ambos sentidos
//    (hint: puede usar funciones de array antes de entrar al foreach)

$arreglo = array();

for($i = 0; $i < 10; $i++){
  $arreglo[] = "algo";
}

foreach($arreglo as $key => $value){
  $arreglo[$key];
}

$arreglo = array_reverse($arreglo);

foreach($arreglo as $key => $value){
  $arreglo[$key];
}

//d - Crear un arreglo de 10 elementos y recorrerlo de ambos sentidos
//    con un for y un while

$arreglo = array();

for($i = 0; $i < 10; $i++){
  $arreglo[] = "algo";
}

for($i = 0; $i < count($arreglo); $i+=1){
  $arreglo[$i];
}

for($i = count($arreglo)-1; $i > 0; $i-=1){
  $arreglo[$i];
}


$i = 0;
while($i < count($arreglo)){
  $arreglo[$i];
  $i = $i + 1;
}

$i = count($arreglo)-1;
while($i > 0){
  $arreglo[$i];
  $i = $i - 1;
}

/**
 * =====================================
 * 3 - Arreglos
 * =====================================
 */
//a - Crear un arreglo de una dimensión de mil elementos
//    con claves consecutivas

$arreglo = array();

for($i = 0; $i < 1000; $i+=1){
  $arreglo[] = 0;
}

//b - Crea un arreglo de 100elementos con claves numericas pero pares
//    Ej: $a[0], $a[2], $a[3] deben existir, $a[1], $a[3] no deben existir

$arreglo = array();

for($i = 0; $i < 100; $i+=1){
  $arreglo[2*$i] = 0;
}

//c - Si nos pasan un arreglo y no sabemos el contenido, cual suele ser la mejor
//    forma de recorrerlo? Se puede de más formas?

/*La mejor forma es usando un foreach, ya que no necesitamos conocer las claves.

Se puede crear un array nuevo pasandole los valores del original (con un array_pop o un array_shift)
y recorrer este nuevo array con un for o un while ya que conocemos las claves, pero estariamos modificando
el array original.*/

//d - Crear una matriz de 10x10

$matriz = array();

for($i = 0; $i < 10; $i+=1){
  $matriz[] = array();

  for($j = 0; $j < 10; $j+=1){
    $matriz[$i][$j] = "($i,$j)";
  }
}

//e - Podemos crear un "cubo" de 10x10x10 en lugar de una matriz? Crearlo con for o while

/*Podemos intentarlo*/

$cubo = array();

for($i = 0; $i < 10; $i+=1){
  $cubo[] = array();

  for($j = 0; $j < 10; $j+=1){
    $cubo[$i][$j][] = array();

    for($k = 0; $k < 10; $k+=1){
      $cubo[$i][$j][$k] = "($i,$j,$k)";
    }
  }
}

/**
 * =====================================
 * 4 - funciones
 * =====================================
 */
//a - Crear una funcion que dado un arreglo/array duplica todos los valores
$ar = array(1, 2, 3);

function ej4_a($ar){
  global $ar;

  foreach($ar as $key => $value){
    $ar[$key] = 2*$value;
  }
} // tiene que modificar todos los valores y duplicarlos

//b - Crea una funcion que dado un arreglo/array te devuelve un nuevo arreglo
//    con los valores duplicados pero no modifica el original (debe crear un
//    nuevo arreglo)

$ar = array(1, 2, 3);
$newArray = array();

function createNewArray($ar, $newArray){
  foreach($ar as $key =>$value){
    $newArray[] = 2*$value;
  }
  return $newArray;
}

//c - De un ejemplo de función recursiva

function sumatoriaHasta($inicio,$tope){
  if($inicio >= $tope){
    return $tope;
  }
  return $inicio + sumatoriaHasta($inicio+1,$tope);
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

/*Anda y devuelve un numero, en este caso 5!, o sea 120. Estamos calculando el factorial.*/

/**
 * =====================================
 * 5 - A desarrollar
 * =====================================
 */

//a - Arregle el siguiente codigo

$a = array(1,2,3);
$b = array(4,5,6);

echo "Las keys del arreglo a son: \n";

foreach ($a as $k => $v) {
  echo $k . "\n";
}

echo "\n\n";

// duplico todos los elementos sin agregar nuevos

foreach ($b as $k => $v) {
  $b[$k] = $v*2;
}


/**
 *
 * Teorico - Explicar TDD, dar un ejemplo de porque es util
 *           y nombrar todas las ventajas que le vean
 *
 * TDD Consiste en la creacion de "Tests" a la par que se programa. Primero uno prepara la "prueba" que uno quiere
 * que su programa supere. Al correr esta prueba -por lo general- se espera un fallo, se determina la causa del fallo
 * y se arregla el codigo del programa, ya sea programando lo que falta o modificando lo que ya esta ahi. Acto seguido
 * se vuelve a correr la prueba y se espera que la pase.
 * 
 * Por ejemplo si quiero una funcion que devuelva un array, ya puedo decirle al test que espere obtener uno.
 * El fallo del test puede decirme dos cosas: que la funcion ni siquiera existe, o que no esta devolviendo lo que deberia.
 * Ademas en el segundo caso puede decirme que esta devolviendo en lugar de lo que espero, facilitando asi la correccion del codigo.
 * 
 * Ventajas del TDD:
 * No hay necesidad de utilizar prints u otras funciones dentro de nuestro programa para corroborar resultados.
 * Es un metodo que apunta a que tengas en claro lo que esperas que haga tu programa, de ahi en adelante, solo
 * hace falta llegar.
 * El programa va mejorando de a poco e incluso un test ya "aprobado" pude aportar informacion si falla con posteriores cambios.
 * 
 */