<?php

namespace Drone;

class Drone {

    private $battery;
    private $position;

    public function __construct(){
        $this->battery = 100;
        $this->position = array(
            "x" => 0,
            "y" => 0
        );
    }

    public function move($x,$y){
        $battery = $this->battery;

        if($battery == 0){
            return False;
        }

        $boundsX = ($x > 19 or $x < 0);
        $boundsY = ($y > 19 or $y < 0);

        if($boundsX or $boundsY){
            return False;
        }

        $distX = abs($this->position["x"] - $x);
        $distY = abs($this->position["y"] - $y);

        $moveCondition = ($distX == 0 xor $distY == 0);

        $batteryCondition = ($battery >= $distX and $battery >= $distY);

        if($moveCondition and $batteryCondition){
            $this->position["x"] = $x;
            $this->position["y"] = $y;
            $this->battery -= $distX;
            $this->battery -= $distY;

            if($x == 0 and $y == 0){
                $this->battery = 100;
            }

            return True;
        }

        return False;
    }

    public function position(){
        return $this->position;
    }

    public function battery(){
        return $this->battery;
    }
}