<?php

namespace Monster;

class NullMonster extends Monster{
    protected $type = 'null';
    protected $noise = '';

    public function makeNoise(){
        return $this->noise;
    }
}