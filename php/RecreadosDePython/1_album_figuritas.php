<?php

//Importo funciones utiles

function esta_en($elemento, $lista){
    $i = 0;
    while ($i < count($lista)){
        if ($lista[$i] == $elemento){
            return True;
	}
        $i = $i + 1;
	}
    return False;
}

//Simular comprar una figurita

function comprar_una_figu($figus_total){
    $figu = rand(1,$figus_total);
    //print("Compre la $figu");
    return $figu;
}

//Simular compra hasta llenar el album se llene y dar la cantidad de compras

function cuantas_figus($figus_total){
    $figuritas_compradas = 0;
    $album = array();
    $i = 0;
    while ($i < $figus_total){
        $album[] = 0;
        $i = $i + 1;
    }
    //print(album)
    while (esta_en(0,$album)){
        $album[comprar_una_figu($figus_total) - 1] = 1;
        $figuritas_compradas = $figuritas_compradas + 1;
        //print(album)
    }
    //print('Compre',figuritas_compradas,'figuritas')
    return $figuritas_compradas;
}

/*
$figus_total = 500;

$figuritas = cuantas_figus($figus_total);

print("Compre $figuritas figuritas en total.");
*/

//Ahora lo repetimos

function repetir_album($n_repeticiones,$figus_total){
    $i = 0;
    $resultados = array();

    while ($i < $n_repeticiones){
        $resultados[] = cuantas_figus($figus_total);
        $i = $i + 1;
    }
    $promedio = array_sum($resultados)/count($resultados);
    return $promedio;
}

/*
$figus_total = 200;
$n_repeticiones = 1000;

$resultado = repetir_album($n_repeticiones,$figus_total);

print "Album de $figus_total figuritas.\n";
print "$n_repeticiones repeticiones.\n";
print "Promedio comprando de a una: $resultado.\n";

AHORA CON PAQUETES

Compro de a cinco en vez de a una

Para representar un paquete voy a usar una lista

Un paquete de 5 figuritas de un album de 669
*/

//Arma un paquete de una dada cantidad de figuritas para un album de una cantidad de figuritas totales

function generar_paquete($figus_total,$figus_paquete){
    $paquete = array();
    $i = 0;
    while ($i < $figus_paquete){
        $paquete[] = comprar_una_figu($figus_total);
        $i = $i + 1;
    }   
    //print("Compre el paquete: $paquete");
    return $paquete;
}

//Quiero saber cuantos paquetes tengo que comprar para llenar un album

function cuantos_paquetes($figus_total,$figus_paquete){
    $paquetes_comprados = 0;
    $album = array();
    $i = 0;

    while ($i < $figus_total){
        $album[] = 0;
        $i = $i + 1;
    }
        
    //print($album);

    while (esta_en(0,$album)){
        $j = 0;
        $paquete = generar_paquete($figus_total,$figus_paquete);
        while ($j < $figus_paquete){
            $album[$paquete[$j] - 1] = 1;
            $j = $j + 1;
        }
        $paquetes_comprados = $paquetes_comprados + 1;
        //print("");
        //print($album);
    } 
    //print("Compre $paquetes_comprados paquetes en total")
    return $paquetes_comprados;
}

//Ahora lo repetimos

function repetir_album_paquetes($n_repeticiones,$figus_total,$figus_paquete){
    $i = 0;
    $resultados = array();

    while ($i < $n_repeticiones){
        $resultados[] = cuantos_paquetes($figus_total,$figus_paquete);
        $i = $i + 1;
    }
    return $resultados;
}


function repetir_album_paquetes_promedio($n_repeticiones,$figus_total,$figus_paquete){
    $i = 0;
    $resultados = array();

    while ($i < $n_repeticiones){
        $resultados[] = cuantos_paquetes($figus_total,$figus_paquete);
        $i = $i + 1;
    }    
    $promedio = array_sum($resultados)/count($resultados);
    return $promedio;
}

/*
$figus_total = 200;
$figus_paquete = 5;
$n_repeticiones = 1000;

$promedio = repetir_album_paquetes_promedio($n_repeticiones,$figus_total,$figus_paquete);
$en_figus = $promedio*5;

print "Promedio comprando paquetes de $figus_paquete: $promedio paquetes. O sea, $en_figus figuritas.";
*/

function Probabilidad_de_llenar_el_album($n_repeticiones,$figus_total,$figus_paquete,$paquetes){
    $i = 0;
    $contador = 0;
    $resultados = repetir_album_paquetes($n_repeticiones,$figus_total,$figus_paquete);
    while ($i < $n_repeticiones){
        if ($resultados[$i] <= $paquetes){
            $contador = $contador + 1;
        }
        $i = $i + 1;
    }
    $P = ($contador/$n_repeticiones);
    return $P;
}

$n_repeticiones = 10000;
$figus_total = 669;
$figus_paquete = 5;
$paquetes = 850;

$proba = Probabilidad_de_llenar_el_album($n_repeticiones,$figus_total,$figus_paquete,$paquetes);

print "Probabilidad de completar el album con $paquetes paquetes: $proba.\n";