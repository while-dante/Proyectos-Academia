<?php 

namespace Objeto;

use Interfaz\Movible;

class Dama implements Movible{

    private $blanco;
    private $nombre;

    public function __construct(Bool $blanco){
        $this->blanco = $blanco;
        $this->nombre = "D ";
    }

    public function mover($x1,$y1,$x2,$y2,Tablero $tablero){
        $distX = $x1-$x2;
        $distY = $y1-$y2;
        
        $camino = array();
        $condicionCamino = False;
        if((abs($distX) == abs($distY))){
            
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

        }elseif($distX == 0 xor $distY == 0){

            if($distX < 0){
                for($i=$x1+1;$i<$x2;$i++){
                    $camino[] = array($i,$y1);
                }
            }elseif($distX > 0){
                for($i=$x1-1;$i>$x2;$i--){
                    $camino[] = array($i,$y1);
                }
            }elseif($distY < 0){
                for($i=$y1+1;$i<$y2;$i++){
                    $camino[] = array($x1,$i);
                }
            }elseif($distY > 0){
                for($i=$y1-1;$i>$y2;$i--){
                    $camino[] = array($x1,$i);
                }
            }
    
            foreach($camino as $posicion){
                $pieza = $tablero->dame($posicion[0],$posicion[1]);
                if(!is_subclass_of($pieza,"\Objeto\Peon")){
                    return False;
                }
                $condicionCamino = True;
            }
        }

        $destino = $tablero->dame($x2,$y2);

        $condicionDestino = (is_subclass_of($destino,"\Objeto\Peon")
            or ($destino->esBlanco() != $this->esBlanco()));
        
        if($condicionCamino and $condicionDestino){
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