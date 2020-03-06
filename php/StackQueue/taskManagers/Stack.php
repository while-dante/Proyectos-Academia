<?php 

namespace TaskManager;

class Stack{

    private $stacc = array();

    public function pop(){
        if (!empty($this->stacc)){
            return array_pop($this->stacc);
        }
        return False;
    }

    public function push($element){
        $this->stacc[] = $element;
        return True;
    }

    public function empty(){
        if(empty($this->stacc)){
            return True;
        }
        return False;
    }
}