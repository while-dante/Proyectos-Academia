<?php

namespace Monster;

use Int\MonsterInt;

abstract class Monster implements MonsterInt{

    public function lurk(){
        return $this->getType() . ' is lurking in the shadows...';
    }

    public function attack(){
        return $this->getType() . ' attacks!';
    }

    public function getType(){
        return $this->type;
    }

    abstract public function makeNoise();
}
