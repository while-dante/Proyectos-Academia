<?php

//BATALLA NAVAL

/*
Nomenclatura:
Vacío => 0
Barco => 1
Barco Hundido => 2


1) Creamos la clase Battleship y que toma por constructor el tamaño del tablero
y la cantidad de naves que cada jugador puede poner.
$battleship = new Battleship(20,20, 10);

Preguntas guías:
- Como represento un tablero de 20 por 20?
- Cuantos tableros voy a necesitar crear?
*/

class Battleship{

    private $tableroJugador1 = array();
    private $tableroJugador2 = array();
    private $navesJugador1;
    private $navesJugador2;

    private $turnos = 0;
    private $disparo1 = 0;
    private $disparo2 = 0;

    public function __construct($filas,$columnas,$naves){

        $this->navesJugador1 = $naves;
        $this->navesJugador2 = $naves;

        for ($i = 0; $i < $filas; $i+=1){
            $this->tableroJugador1[] = array();
            $this->tableroJugador2[] = array();

            for($j = 0; $j < $columnas; $j+=1){
                $this->tableroJugador1[$i][$j] = 0;
                $this->tableroJugador2[$i][$j] = 0;
            }
        }
    }

    public function mostrarTableroJugador1(){
        return $this->tableroJugador1;
    }

    public function mostrarTableroJugador2(){
        return $this->tableroJugador2;
    }

    public function colocarNaveJugador1($fila,$columna){
        $naves = $this->navesJugador1;
        $lugar = $this->tableroJugador1[$fila][$columna];

        if($this->navesJugador1 > 0 and $lugar === 0){
            $this->tableroJugador1[$fila][$columna] = 1;
            $this->navesJugador1 -= 1;
        }
    }

    public function colocarNaveJugador2($fila,$columna){
        $naves = $this->navesJugador2;
        $lugar = $this->tableroJugador2[$fila][$columna];

        if($naves > 0 and $lugar === 0){
            $this->tableroJugador2[$fila][$columna] = 1;
            $this->navesJugador2 -= 1;
        }
    }

    public function mostrarNavesRestantes1(){
        return $this->navesJugador1;
    }

    public function mostrarNavesRestantes2(){
        return $this->navesJugador2;
    }

    public function disparoTurnoJugador1($fila,$columna){
        if($this->disparo1 === 0){

            if ($this->tableroJugador2[$fila][$columna] === 1){
                $this->tableroJugador2[$fila][$columna] = 2;
            }
            $this->turnos += 1;
            $this->disparo1 = 1;
            $this->disparo2 = 0;
        }
    }

    public function disparoTurnoJugador2($fila,$columna){
        if ($this->disparo2 === 0){

            if ($this->tableroJugador1[$fila][$columna] === 1){
                $this->tableroJugador1[$fila][$columna] = 2;
            }
            $this->turnos += 1;
            $this->disparo2 = 1;
            $this->disparo1 = 0;
        }
    }

    public function ganoJugador1(){
        
        for ($i = 0; $i < count($this->tableroJugador2); $i+=1){
            if(in_array(1,$this->tableroJugador2[$i])){
                return;
            }
        }
        $mensaje = "Ganador: Jugador 1";
        return $mensaje;
    }

    public function ganoJugador2(){

        for ($i = 0; $i < count($this->tableroJugador1); $i+=1){
            if(in_array(1,$this->tableroJugador1[$i])){
                return;
            }
        }
        $mensaje = "Ganador: Jugador 2";
        return $mensaje;
    }

    public function terminoElJuego(){

        if(!is_null($this->ganoJugador1()) or !is_null($this->ganoJugador2())){
            $mensaje = "Fin del Juego";
            return $mensaje;
        }
        return;
    }

    public function cuantosTurnosPasaron(){
        return $this->turnos;
    }
}