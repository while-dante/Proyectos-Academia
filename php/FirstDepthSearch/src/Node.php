<?php

namespace Node;

class Node implements INode{
    private $id;
    private $neighbours = array();
    private $called = False;

    public function __construct($id){
        $this->id = $id;
        $this->neighbours = array();
        $this->called = False;
    }

    public function getId(){
        return $this->id;
    }
    
    public function connect(Node $newNeighbour){
        $added = False;
        $neighbourId = $newNeighbour->getId();

        $notSelf = $neighbourId != $this->id;
        $notNeighbour = !in_array($newNeighbour,$this->neighbours);

        if($notSelf and $notNeighbour){
            $this->neighbours[] = $newNeighbour;
            $this->called = True;
            if(!$newNeighbour->getCalled()){
                $newNeighbour->connect($this);
            }
            $added = True;
        }
        $this->called = False;
        return $added;
    }

    public function disconnect($neighbour){
        $disconnected = False;
        $neighbourId = $neighbour->getId();

        $notSelf = $neighbourId != $this->id;
        $isNeighbour = in_array($neighbour,$this->neighbours);

        $oldNeighbours = $this->neighbours;
        $newNeighbours = array();
        
        if($notSelf and $isNeighbour){
            foreach($oldNeighbours as $old){
                if($old != $neighbour){
                    $newNeighbours[] = $old;
                }
            }
            $this->called = True;
            if(!$neighbour->getCalled()){
                $neighbour->disConnect($this);
            }
            $disconnected = True;
            $this->neighbours = $newNeighbours;
        }
        $this->called = False;
        return $disconnected;
    }

    public function getNeighbours(){
        return $this->neighbours;
    }

    public function rotateNeighbours(){
        
        if(count($this->neighbours) > 1){
            $first = array_shift($this->neighbours);
            $this->neighbours[] = $first;
            return True;
        }
        return False;
    }

    private function getCalled(){
        return $this->called;
    }
}