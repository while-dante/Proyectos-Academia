<?php

namespace Juego;

class Lavieja
{
    private $tablero = [
        [' ',' ',' '],
        [' ',' ',' '],
        [' ',' ',' ']
    ];
    private $turno = 1;

    public function mostrar()
    {
        return $this->tablero;
    }

    public function jugar($fila,$columna)
    {
        if ($this->tablero[$fila][$columna] == ' ' and !$this->termino()){
            if ($this->turno%2 == 0){
                $this->tablero[$fila][$columna] = 'O';
        
            }else{
                $this->tablero[$fila][$columna] = 'X';
            }
            $this->turno++;
                
            return True;
        }
        return False;
    }

    public function empate()
    {
        if ($this->turno >= 10){
            return True;
        }
        return False;
    }

    public function xGana()
    {
        $gana = ['X','X','X'];

        foreach ($this->tablero as $fila){
            if ($fila === $gana){
                return True;
            }
        }

        for ($i=0;$i<3;$i++){
            $columna = [
                $this->tablero[0][$i],
                $this->tablero[1][$i],
                $this->tablero[2][$i]
            ];
        
            if($columna == $gana){
                return True;
            }
        }

        $diagonal1 = [
            $this->tablero[0][0],
            $this->tablero[1][1],
            $this->tablero[2][2]
        ];
        $diagonal2 = [
            $this->tablero[0][2],
            $this->tablero[1][1],
            $this->tablero[2][0]
        ];

        if ($diagonal1 == $gana or $diagonal2 == $gana){
            return True;
        }
        
        return False;
    }

    public function oGana()
    {
        $gana = ['O','O','O'];

        foreach ($this->tablero as $fila){
            if ($fila === $gana){
                return True;
            }
        }

        for ($i=0;$i<3;$i++){
            $columna = [
                $this->tablero[0][$i],
                $this->tablero[1][$i],
                $this->tablero[2][$i]
            ];
        
            if($columna == $gana){
                return True;
            }
        }

        $diagonal1 = [
            $this->tablero[0][0],
            $this->tablero[1][1],
            $this->tablero[2][2]
        ];
        $diagonal2 = [
            $this->tablero[0][2],
            $this->tablero[1][1],
            $this->tablero[2][0]
        ];

        if ($diagonal1 == $gana or $diagonal2 == $gana){
            return True;
        }
        
        return False;
    }

    public function termino()
    {
        if ($this->empate() or $this->xGana() or $this->oGana()){
            return True;
        }
        return False;
    }
}
