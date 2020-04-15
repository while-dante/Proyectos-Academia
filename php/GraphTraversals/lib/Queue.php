<?php 

namespace Library;

class Queue{

    private $staccA;
    private $staccB;

    public function __construct(){
        $this->staccA = new Stack;
        $this->staccB = new Stack;
    }

    public function get(){
        while(!($this->staccA->empty())){
            $this->staccB->push($this->staccA->pop());
        }
        $element = $this->staccB->pop();

        while(!($this->staccB->empty())){
            $this->staccA->push($this->staccB->pop());
        }
        return $element;
    }

    public function put($element){
        $this->staccA->push($element);
        return True;
    }

    public function size(){
        $nElementos = 0;
        while(!($this->staccA->empty())){
            $this->staccB->push($this->staccA->pop());
            $nElementos += 1; 
        }
        while(!($this->staccB->empty())){
            $this->staccA->push($this->staccB->pop()); 
        }
        return $nElementos;
    }
}