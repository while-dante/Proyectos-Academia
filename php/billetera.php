<?php

//MODELAR UNA BILLETERA

/*Tiene plata que se guarda por billetes
propiedades:
billetes (arreglo)

funciones: 
agregarPlata($billete,$cant)
sacarPlata($billete,$cant)
mostrarPlata()
total()
*/

//Vamos a modelar 16 billeteras (de la clase)

class Billetera{

    Private $billetes = array();

    function agregarPlata($billete,$cantidad){
        
        $denominacionesValidas = array(2,5,10,20,50,100,500,1000);

        if (!in_array($billete,$denominacionesValidas)){
            return;
        }
        else{
            if (empty($this ->billetes[$billete])){
                $this ->billetes[$billete] = $cantidad;
            }
            else{
                $this ->billetes[$billete] += $cantidad;
            }
        }
    }

    function sacarPlata($billete,$cantidad){

        $denominacionesValidas = array(2,5,10,20,50,100,500,1000);

        if (!in_array($billete,$denominacionesValidas) or $cantidad > $this ->billetes[$billete]){
            return;
        }
        else{
            $this ->billetes[$billete] -= $cantidad;
        }
    }

    function mostrarPlata(){

        $plata = array();

        foreach ($this ->billetes as $billete => $cantidad){
            if ($cantidad > 0){
                $plata[$billete] = $cantidad;
            }
        }
        return $plata;
    }

    function total(){
        $parcial = array();

        foreach ($this ->billetes as $valor => $cantidad){
            $parcial[] = $valor*$cantidad;
        }
        $total = array_sum($parcial);

        return $total;
    }
}

$billeteras = array();

$i = 0;

while ($i < 16){

    $billeteras[] = new Billetera();
    $i += 1;
}

$denominacionesValidas = array(2,5,10,20,50,100,500,1000);

$i = 0;
$totales = array();

while ($i < 16){
    $depositos = 5;
    $j = 0;
    while($j < $depositos){
        $cantidadBilletes = random_int(1,10);
        $billeteras[$i]->agregarPlata($denominacionesValidas[random_int(0,7)],$cantidadBilletes);
        $j += 1;
    }
    $totales[] = $billeteras[$i]->total();
    $i += 1;
}

$platas = array();

foreach ($billeteras as $numero => $billetera){
    $platas[] = $billetera->mostrarPlata();
}

$total = array_sum($totales);

print_r($platas);
print_r($totales);
print "$total pesos en total.\n";
