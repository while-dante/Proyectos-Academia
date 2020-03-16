<?php

namespace Monster;

class Zombie extends Monster{
    protected $type = 'Zombie';
    protected $noise = 'AARRHHH';

    public function makeNoise(){
        return $this->noise;
    }
}