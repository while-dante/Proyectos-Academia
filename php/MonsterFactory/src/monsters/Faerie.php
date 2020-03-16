<?php

namespace Monster;

class Faerie extends Monster{
    protected $type = 'Faerie';
    protected $noise = 'Jijiji :3c';

    public function makeNoise(){
        return $this->noise;
    }
}