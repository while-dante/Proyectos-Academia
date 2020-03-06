<?php

namespace Strategies;

use \Interfaces\Strategy as Strategy;

class StrategyRandom implements Strategy{

    public function pick(array $servers){
        $key = array_rand($servers);
        $chosenOne = $servers[$key];
        
        return $chosenOne;
    }
}