<?php

//Clase Caja que guarda cosas y muestra las cosas que tiene guardadas

interface MostrableYGuardable{
    public function mostrar();
    public function dimensiones();
}

class Caja implements MostrableYGuardable{

    private $nombre;
    private $contenido = array();
    private $capacidadMaxima;
    private $capacidad;

    public function __construct($creditos,$identificacion){

        $this->capacidadMaxima = $creditos;
        $this->capacidad = $creditos;
        $this->nombre = $identificacion;
    }

    public function guardar(MostrableYGuardable $obj){

        if ($this->capacidad - $obj->dimensiones() >= 0){
            $this->contenido[] = $obj;
            $this->capacidad -= $obj->dimensiones();
        }
    }

    public function mostrar(){
        
        echo "---------------------------------\nSoy el contenido de ".$this->nombre.":\n\n";

        foreach ($this->contenido as $key => $obj){
            $obj->mostrar();
        }

        echo "Fin del contenido de ".$this->nombre."\n_________________________________\n\n";
    }

    public function dimensiones(){
        return $this->capacidadMaxima;
    }

    public function cantidad(){
        return count($this->contenido);
    }

    public function espacioRestante(){
        return $this->capacidad;
    }
}

//cosas a guardar

class Bicicleta implements MostrableYGuardable{

    private $nombre = "Bicicleta";
    private $tamanio;

    public function __construct($creditos){
        $this->tamanio = $creditos;
    }

    public function mostrar(){
        echo $this->nombre." (".$this->tamanio.")\n";
    }

    public function dimensiones(){
        return $this->tamanio;
    }
}

class Auto implements MostrableYGuardable{
    private $nombre = "Auto";
    private $tamanio;

    public function __construct($creditos){
        $this->tamanio = $creditos;
    }

    public function mostrar(){
        echo $this->nombre." (".$this->tamanio.")\n";
    }

    public function dimensiones(){
        return $this->tamanio;
    }
}

class Item implements MostrableYGuardable{
    private $nombre;
    private $tamanio;

    public function __construct($creditos,$identificacion){
        $this->tamanio = $creditos;
        $this->nombre = $identificacion;
    }

    public function mostrar(){
        echo $this->nombre." (".$this->tamanio.")\n\n";
    }

    public function dimensiones(){
        return $this->tamanio;
    }
}

/*
$cofreEpico = new Caja(100,"Cofre");

$bolsaCuero = new Caja(20,"Bolsa de cuero");

$cajaAnillo = new Caja(3,"Caja para anillo");

$diente = new Item(2,"Molar inferior");

$espadaMaldita = new Item(35,"Traedora de angustia");

$brujula = new Item(5,"Brujula");

$monedaPlata = new Item(1,"Moneda de Plata");

for($i=0;$i<15;$i++){
    $bolsaCuero->guardar($monedaPlata);
}

$cajaAnillo->guardar($diente);
$bolsaCuero->guardar($brujula);
$cofreEpico->guardar($bolsaCuero);
$cofreEpico->guardar($cajaAnillo);
$cofreEpico->guardar($espadaMaldita);
$cofreEpico->guardar($bicicletaGrande);
$cofreEpico->guardar($bicicletaNormal);

$cofreEpico->mostrar();

$cantidadCofre = $cofreEpico->cantidad();
$cantidadBolsaCuero = $bolsaCuero->cantidad();

echo "Hay $cantidadCofre objetos en el cofre\n";
echo "Hay $cantidadBolsaCuero objetos en la bolsa\n";
*/

//HORA DE LAS MATRIOSHKAS

$estante = array();

$matrioshkaPrimordial = new Item(0,"Matrioshka Primordial");

for ($i=1;$i<6;$i++){
    $matrioshka = new Caja($i,"Matrioshka");
    $estante[] = $matrioshka;
}

$estante[0]->guardar($matrioshkaPrimordial);

for($i=0;$i<4;$i++){
    $estante[$i+1]->guardar($estante[$i]);
}

$estante[count($estante)-1]->mostrar();
