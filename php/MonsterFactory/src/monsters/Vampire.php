<?php

namespace Monster;

class Vampire extends Monster{
    protected $type = 'Vampire';
    protected $noise = 'Chomp!!! succ...';

    public function makeNoise(){
        return $this->noise;
    }
}