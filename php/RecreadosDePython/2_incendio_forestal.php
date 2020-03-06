<?php

/*Bosque
tiene n posiciones y representamos su estado con
0 = vacio, 1 = arbol, -1 = arbol prendido fuego.

Etapa de un bosque durante doce meces

1_ Primavera: hay una proabilidad (p) de que nazca un arbol

2_ Caida de rayos: hay una probabilidad (f) de que caiga un rayo en una posicion
 Si cae un rayo donde habia un arbol (1), ese arbol se incendia (-1)

3_ Incendios: los arboles prendidos fuego (-1) extienden el fuego a los arboles (1) vecinos

4_ Limpieza: los arboles prendidos fuego (-1) dejan un espacio vacio (0)
*/

//Bosque vacio
//Solo tiene espacios vacios (0)

function generar_bosque_vacio($n_posiciones){
    $vacio = 0;
    $bosque_vacio = array();

    $i = 0;
    while ($i < $n_posiciones){
        $bosque_vacio[] = $vacio;
        $i = $i + 1;
    }
    return $bosque_vacio;
}

//Bosque limpio
//Tiene espacios vacios (0) y arboles (1)

function generar_bosque_limpio($n_posiciones){
    $bosque_limpio = array();

    $i = 0;
    while ($i < $n_posiciones){
        $bosque_limpio[] = random_int(0,1);
        $i = $i + 1;
    }
    return $bosque_limpio;
}

//Bosque quemado
//Tiene espacios vacios (0), arboles (1) y arboles prendidos fuego (-1)

function generar_bosque_quemado($n_posiciones){
    $bosque_quemado = array();
    $i = 0;

    while ($i < $n_posiciones){
        $bosque_quemado[] = random_int(-1,1);
        $i = $i + 1;
    }
    return $bosque_quemado;
}

//Defino funciones para representar las etapas:

//Defino la funcion brotes
//Genera un arbol (1) en cada celda vacia (0) con una probabilidad p

function suceso_aleatorio($probabilidad){

    if (mt_rand(1,100)/100 <= $probabilidad){
        return True;
    }
    else{
        return False;
    }
}

function brotes($bosque,$probabilidad_brote){
    $vacio = 0;
    $arbol = 1;

    $i = 0;
    while ($i < count($bosque)){
        if ($bosque[$i] === $vacio and suceso_aleatorio($probabilidad_brote)){
            $bosque[$i] = $arbol;
        }
        $i = $i + 1;
    }
    return $bosque;
}

//Defino la funcion cuantos
//Toma un bosque y un tipo de celda y devuelve la cantidad de ese tipo en el bosque
    
function cuantos($bosque,$tipo_celda){
    $vacio = 0;
    $arbol = 1;
    $fuego = -1;

    if ($tipo_celda != $vacio and $tipo_celda != $arbol and $tipo_celda != $fuego){

        $mensaje = "Por favor inserte un tipo de celda valido.";
        return $mensaje;
    }
    else{
        $contador = 0;

        foreach ($bosque as $celda => $tipo){

            if ($tipo === $tipo_celda){
                $contador += 1;
            }
        }
    }
    return $contador;
}

//Defino la funcion rayos
//Prende fuego (-1) los arboles (1) con una probabilidad p
    
function rayos($bosque,$probabilidad_rayo){
    $arbol = 1;
    $fuego = -1;

    $i = 0;
    while ($i < count($bosque)){
        if ($bosque[$i] === $arbol and suceso_aleatorio($probabilidad_rayo)){
            $bosque[$i] = $fuego;
        }
        $i += 1;
    }
    return $bosque;
}

//Defino la funcion propagacion
//Busca arboles prendidos fuego (-1) y enciende a sus vecinos (1)

function propagacion($bosque){
    $vacio = 0;
    $arbol = 1;
    $fuego = -1;

    $i = 0;
    $j = count($bosque) - 1;
    while ($i < count($bosque) - 1){
        if ($bosque[$i] === $fuego and $bosque[$i+1] === $arbol){
            $bosque[$i+1] = $fuego;
        }
        $i = $i + 1;
    }
    while ($j > 0){
        if ($bosque[$j] === $fuego and $bosque[$j-1] === $arbol){
            $bosque[$j-1] = $fuego;
        }
        $j = $j - 1;
    }
    return $bosque;
}

//Defino la funcion limpieza
//Busca arboles prendidos fuego (-1) y los reemplaza por un espacio vacio (0)

function limpieza($bosque){

    $i = 0;
    while ($i < count($bosque)){
        if ($bosque[$i] === -1){
            $bosque[$i] = 0;
        }
        $i = $i + 1;
    }
    return $bosque;
}

/*PRUEBA
$bosque0 = generar_bosque_vacio(20);
print_r($bosque0);
$bosque0 = brotes($bosque0,0.6);
print_r($bosque0);
$cantArboles = cuantos($bosque0,1);
print_r("Hay $cantArboles arboles en el bosque.\n");
$bosque0 = rayos($bosque0,0.2);
print_r($bosque0);
$bosque0 = propagacion($bosque0);
print_r($bosque0);
$bosque0 = limpieza($bosque0);
print_r($bosque0);
*/

function incendio_forestal($posiciones,$proba_brote,$proba_rayo,$repeticiones){
    $t = 0;
    $supervivientes = 0;

    //Primero genera un bosque vacio
    $bosque = generar_bosque_vacio($posiciones);
    $arbol = 1;

    while ($t < $repeticiones){
        $bosque = brotes($bosque,$proba_brote); //crecen arboles
        $bosque = rayos($bosque,$proba_rayo); //caen rayos
        $bosque = propagacion($bosque); //el fuego se extiende
        $bosque = limpieza($bosque); //se limpia el bosque
        $supervivientes = $supervivientes + cuantos($bosque,$arbol); //cuenta los que quedan
        $t = $t + 1;
    }
    $promedio = $supervivientes/$repeticiones;
    return $promedio;
}

$largoBosque = 100;
$probaBrote = 0.6;
$probaRayo = 0.2;
$repeticiones = 10000;

$promedio = incendio_forestal($largoBosque,$probaBrote,$probaRayo,$repeticiones);

print "Promedio de supervivientes: $promedio.\n";
