<?php

namespace Searcher;

use Node\Node;

class DFS{

    private $visitedNodes = array();

    public function search(Node $node, $target = null){
        $nodeId = $node->getId();

        if($nodeId == $target){
            $this->visitedNodes[] = $nodeId;

            return $this->visitedNodes;
        }
        if(!in_array($nodeId,$this->visitedNodes)){
            $this->visitedNodes[] = $nodeId;
            $neighbours = $node->getNeighbours();
            
            foreach($neighbours as $neighbour){
                $this->search($neighbour,$target);
            }
        }
        return $this->visitedNodes;
    }

    public function clear(){
        $this->visitedNodes = array();
    }
}