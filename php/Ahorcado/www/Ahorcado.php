<?php

//Hagamos un ahorcado

/*
PROPIEDADES
palabra
vidas

FUNCIONES
vidasRestantes()
mostrar()
jugar($letra)
gane()
perdi()
*/

class Ahorcado{
    
    private $palabra;
    private $vidas;
    private $palabraOculta;
    private $letrasJugadas = array();

    public function __construct($palabra,$vidas){
        $this->palabra = $palabra;
        $this->vidas = $vidas;

        $largo = strlen($this->palabra);
        $this->palabraOculta = array();

        $i = 0;
        while ($i < $largo){
            $this->palabraOculta[] = "_";
            $i += 1;
        }
    }

    public function mostrar(){
        $muestra = implode(" ",$this->palabraOculta);
        return $muestra;
    }

    public function vidasRestantes(){
        return $this->vidas;
    }

    public function letrasJugadas(){
        $muestra = implode(", ",$this->letrasJugadas);
        return $muestra;
    }

    public function jugar($letra){
        if (empty($letra)){
            return;
        }

        $largo = strlen($this->palabra);
        $acierto = 0;

        if ($this->gane() or $this->perdi()){
            return False;
        }

        $i = 0;
        while ($i < $largo){
            if ($letra === $this->palabra[$i]){
                $this->palabraOculta[$i] = $letra;
                $acierto = 1;
            }
            $i += 1;
        }
        
        if ($acierto != 1){
            $this->vidas -= 1;

            if(!in_array($letra,$this->letrasJugadas)){
                $this->letrasJugadas[] = $letra;
            }
        }
    }

    function gane(){
        if (! in_array("_",$this->palabraOculta)){
            return True;
        }
        else{
            return False;
        }
    }

    function perdi(){
        if ($this->vidas === 0){
            return True;
        }
        else{
            return False;
        }
    }
}