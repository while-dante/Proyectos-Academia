<?php

namespace TaskManager;

class QueueArray{

    private $q = array();

    public function get(){
        if (!empty($this->q)){
            return array_shift($this->q);
        }
        return False;
    }

    public function put($element){
        $this->q[] = $element;
        return True;
    }

    public function size(){
        return count($this->q);
    }
}