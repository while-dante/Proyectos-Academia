<?php

namespace Objeto;

class Tablero{

    private $tablero;

    public function __construct(){

        $tablero = array();

        for($i=0;$i<8;$i++){
            $tablero[] = array();
            for($j=0;$j<8;$j++){
                $tablero[$i][] = new NullPieza(True);
            }
        }

        $this->tablero = $tablero;
    }

    public function getTablero(){
        return $this->tablero;
    }

    public function mostrar(){

        $impreso = "";

        foreach($this->tablero as $fila){
            foreach($fila as $pieza){
                $impreso.= "|".$pieza->nombre()."|";
            }
            $impreso.= "\n";
        }
        return $impreso;
    }

    public function colocarPieza($x,$y,\Interfaz\Movible $pieza){

        $posicion = $this->tablero[$x][$y];

        if(is_subclass_of($posicion,"\Objeto\Peon")){
            $this->tablero[$x][$y] = $pieza;
            return True;
        }
        return False;
    }

    public function dame($x,$y){
        $posicion = $this->tablero[$x][$y];
        return $posicion;
    }

    public function mover($x1,$y1,$x2,$y2){
        $pieza = $this->dame($x1,$y1);
        
        if($pieza->mover($x1,$y1,$x2,$y2,$this)){
            $this->tablero[$x1][$y1] = new NullPieza(True);
            $this->tablero[$x2][$y2] = $pieza;
            return True;
        }
        return False;
    }
}