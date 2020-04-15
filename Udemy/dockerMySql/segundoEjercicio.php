<?php

//Declarar arreglo en la variable $barcelona
$barcelona = array(
    'titulares' => array(
        10 => 'Messi',
        2 => 'Dante',
        5 => 'Tu Vieja'
    ),
    'suplentes' => array(
        8 => 'Arthur',
        9 => 'Conan',
        11 => 'Doyle'
    )
);
//Crear nuevo arreglo vacío, para poder llenarlo en el ciclo, con los jugadores de número PAR.
$nuevosJugadores = array();
//Recorrer el arreglo barcelona (los titulares, y los suplentes) y guardar en el arreglo vacío aquellos jugadores que tengan en su camiseta un numero PAR
foreach ($barcelona as $lista){
    foreach ($lista as $camiseta => $jugador){
        if ($camiseta%2 == 0){
            $nuevosJugadores[] = $jugador;
        }
    }
}
//Ordenar el nuevo arreglo (nuevosJugadores) por nombre del jugador.
sort($nuevosJugadores);
//Leer más en https://www.w3schools.com/php/php_arrays_sort.asp

//Mostrar los jugadores del nuevo arreglo (nuevosJugadores) ordenados por nombre.
//Imprimir en pantalla esos jugadores
foreach ($nuevosJugadores as $jugador){
    echo $jugador."\n";
}