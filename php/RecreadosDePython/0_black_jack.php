<?php
//NanoJack

$sin_cartas = 2;

$n = 1;

function generar_mazos($n){
    $cartas = array();
    $i = 0;
    while ($i < $n){
        $j = 1;
        while ($j < 14){
            $k = 1;
            while ($k < 5){
                $cartas[] = $j;
                $k = $k + 1;
            }
            $j = $j + 1;
        }
        $i = $i + 1;
    }
    shuffle($cartas);
    return $cartas;
}

function jugar_solo($m){
    $puntaje = 0;
    $i = 0;
    while ($i <= count($m)){
        while ($puntaje < 21){
            if (count($m) <= 0){
                print "Fin de la partida.\n";
                return 0; 
                #return 2
            }
            else{
                $puntaje = $puntaje + $m[0];
                array_shift($m);
            }
                if ($puntaje == 21){
                    print "Wow... ganaste. ¿Estás satisfecho/a?\n";
                    return $puntaje;
                }
                elseif ($puntaje > 21){
                    print "¡Jajaaa! PERDISTE\n";
                    return $puntaje;
                }
        }
        $i = $i + 1;
    }
}

function jugar($m){
    $puntaje = 0;
    $i = 0;
    while ($i <= count($m)){
        while ($puntaje < 21){
            if (count($m) <= 0){
                return $sin_cartas;
            }
            else{
                $puntaje = $puntaje + $m[0];
                array_shift($m);
                if ($puntaje == 21){
                    return $puntaje;
                }
                elseif ($puntaje > 21){
                    return $puntaje;
                }
            }             
        }
        $i = $i + 1;
    }     
}

$j = 2;

function jugar_varios($m,$j){
    $resultados = array();
    $i = 1;
    while ($i <= $j){
        $resultados[] = jugar($m);
        $i = $i + 1;
    }
    return $resultados;
}

function ver_quien_gano($resultados){
    $i = 0;
    $condicion = array();
    $sin_cartas = 2;

    while ($i < count($resultados)){
        if ($resultados[$i] == 21){
            $condicion[] = 1;
        }
        elseif ($resultados[$i] == $sin_cartas){
            $condicion[] = $resultados[$i];
        }
        else{
            $condicion[] = 0;
        }
        $i = $i + 1;
    }
    return $condicion;
}

$rep = 1;
$jug = 1;

function experimentar2($rep,$jug,$mazo){
    $i = 1;
    $counter = array();
    $sin_cartas = 2;

    while ($i <= $rep){
        $j = 0;
        $puntajes = jugar_varios($mazo,$jug);
        $resultados = ver_quien_gano($puntajes);
        
        #print "$i $puntajes.\n";
        print"$i $resultados.\n";

        if ($i == 1){
            $counter = $resultados;
        }
        else{

            while ($j < count($resultados)){

                if ($counter[$j] == $sin_cartas){
                    return array($sin_cartas);
                }
                else{
                    $counter[$j] = $counter[$j] + $resultados[$j];
                    $j = $j + 1;
                }
            }
        }
        $i = $i + 1;
    }
    return $counter;
}

function jugar_nano_jack($n,$j,$r){
    $mazo = generar_mazos($n);
    $puntos = experimentar2($r,$j,$mazo);
    $mensaje = array();
    $sin_cartas = 2;
    $i = 0;

    while ($i < $j){

        if ($puntos[$i] == $sin_cartas){
            return "Nos quedamos sin cartas";
        }
        else{
            $mensaje[] = $puntos[$i];
            $mensaje[$i] = str($mensaje[$i]);
            $mensaje[$i] = "Jugador"+str($i+1)+":"+" "+$mensaje[$i];
        }
        $i = $i + 1;
    }
    return $mensaje;
}

$cant_mazos = 20;
$jugadores = 7;
$repeticiones = 5;

$juego = jugar_nano_jack($cant_mazos,$jugadores,$repeticiones);
print_r ($juego);