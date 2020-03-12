<?php

namespace Node;

use Node\Node;

class FDS{

    private $visitedNodes = array();

    public function getVisited(){
        return $this->visitedNodes;
    }

    public function search(Node $node){
        $nodeId = $node->getId();
        if(!in_array($nodeId,$this->visitedNodes)){
            $this->visitedNodes[] = $nodeId;
            $neighbours = $node->getNeighbours();
            foreach($neighbours as $neighbour){
                $this->search($neighbour);
            }
        }
    }

    public function clear(){
        $this->visitedNodes = array();
        return True;
    }
}






