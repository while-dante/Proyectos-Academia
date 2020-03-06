<?php

//Hacemos un TaTeTi

/*
PROPIEDADES:
turno
tablero

FUNCIONES:
jugar(fil,col)
mostrar()
quienGano()
*/

class Tateti{

    private $tablero;
    private $turnos = array();

    function __construct(){
        $tablero = array();

        for ($i = 0; $i < 3; $i++){
            $tablero[] = array(" "," "," ");
        }
        $this->tablero = $tablero;
    }

    function mostrar(){
        return $this->tablero;
    }
    
    function jugar($fil,$col){
        if ($this->ganoX() === null and $this->ganoO() === null and $this->empate() === null){

            if ($this->tablero[$fil][$col] === " "){

                if (count($this->turnos)%2 === 0){
                    $this->tablero[$fil][$col] = "X";
                }
                else{
                    $this->tablero[$fil][$col] = "O";
                }
                $this->turnos[] = 1;
            }
        }
    }

    function ganoX(){
        $mensaje = "Ganador: X";
        $contadorDia = 0;

        for ($i=0; $i<3; $i++){
            $contadorFil = 0;
            $contadorCol = 0;

            for ($j=0; $j<3; $j++){
                if ($this->tablero[$i][$j] === "X"){
                    $contadorFil++;
                    if ($contadorFil === 3){
                        return $mensaje;
                    }
                }
                if ($this->tablero[$j][$i] === "X"){
                    $contadorCol++;
                    if ($contadorCol === 3){
                        return $mensaje;
                    }
                }
            }
            if ($this->tablero[$i][$i] === "X"){
                $contadorDia++;
                if ($contadorDia === 3){
                    return $mensaje;
                }
            }
        }
        if ($this->tablero[0][2]==="X" and $this->tablero[1][1]==="X" and $this->tablero[2][0]==="X"){
            return $mensaje;
        }
    }

    function ganoO(){
        $mensaje = "Ganador: O";
        $contadorDia = 0;

        for ($i=0; $i<3; $i++){
            $contadorFil = 0;
            $contadorCol = 0;

            for ($j=0; $j<3; $j++){
                if ($this->tablero[$i][$j] === "O"){
                    $contadorFil++;
                    if ($contadorFil === 3){
                        return $mensaje;
                    }
                }
                if ($this->tablero[$j][$i] === "O"){
                    $contadorCol++;
                    if ($contadorCol === 3){
                        return $mensaje;
                    }
                }
            }
            if ($this->tablero[$i][$i] === "O"){
                $contadorDia++;
                if ($contadorDia === 3){
                    return $mensaje;
                }
            }
        }
        if ($this->tablero[0][2]==="O" and $this->tablero[1][1]==="O" and $this->tablero[2][0]==="O"){
            return $mensaje;
        }
    }

    function empate(){
        $mensaje = "Empate, gano la Vieja";

        for ($i=0; $i<3; $i++){
            if (in_array(" ",$this->tablero[$i])){
                return;
            }
        }
        if (is_null($this->ganoO()) and is_null($this->ganoX())){
            return $mensaje;
        }
    }

    function mostrarLindo(){
        $tableroLindo = "";

        $i=0;
        $j=0;
        while ($i < 3){
            implode("|",$this->mostrar());
            $i++;
        }
        return $tableroLindo;
    }
}