<?php

namespace Searcher;

use Node\Node;

class BFS{

    private $visitedNodes = array();

    public function search(Node $node, $target = null){
        $nodeId = $node->getId();
        
        if (! in_array($nodeId,$this->visitedNodes)){
            $this->visitedNodes[] = $nodeId;
        }

        $neighbours = $node->getNeighbours();

        foreach ($neighbours as $neighbour){
            if (! in_array($neighbour->getId(),$this->visitedNodes)){
                $nodeId = $node->getId();
                $this->visitedNodes[] = $nodeId;
            }
        }


        return $this->visitedNodes;
    }

    public function clear(){
        $this->visitedNodes = array();
        return True;
    }
}