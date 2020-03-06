<?php 

namespace Objeto;

use Interfaz\Movible;

class Alfil implements Movible{
    
    private $blanco;
    private $nombre;

    public function __construct(Bool $blanco){
        $this->blanco = $blanco;
        $this->nombre = "A ";
    }

    public function mover($x1,$y1,$x2,$y2,Tablero $tablero){
        $distX = $x1-$x2;
        $distY = $y1-$y2;

        $camino = array();
        if($distX < 0 and $distY < 0){
            $j = $y1+1;
            for($i=$x1+1;$i<$x2;$i++){
                $camino[] = array($i,$j);
                $j++;
            }
        }elseif($distX > 0 and $distY < 0){
            $j = $y1+1;
            for($i=$x1-1;$i>$x2;$i--){
                $camino[] = array($i,$j);
                $j++;
            }
        }elseif($distX > 0 and $distY > 0){
            $j = $y1-1;
            for($i=$x1-1;$i>$x2;$i--){
                $camino[] = array($i,$j);
                $j--;
            }
        }elseif($distX < 0 and $distY > 0){
            $j = $y1-1;
            for($i=$x1+1;$i<$x2;$i++){
                $camino[] = array($i,$j);
                $j--;
            }
        }

        foreach($camino as $posicion){
            $pieza = $tablero->dame($posicion[0],$posicion[1]);
            if(!is_subclass_of($pieza,"\Objeto\Peon")){
                return False;
            }
            $condicionCamino = True;
        }

        $destino = $tablero->dame($x2,$y2);

        $condicionDestino = (is_subclass_of($destino,"\Objeto\Peon")
            or ($destino->esBlanco() != $this->esBlanco()));

        $condicionMovimiento = (abs($distX) == abs($distY));

        if($condicionMovimiento and $condicionDestino and $condicionCamino){
            return True;
        }
        return False;
    }

    public function esBlanco(){
        return $this->blanco;
    }

    public function nombre(){
        return $this->nombre;
    }
}   