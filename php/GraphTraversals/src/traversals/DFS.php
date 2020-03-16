<?php

namespace Searcher;

use Node\Node;

class DFS{

    public function search(Node $node, $target = null){
        $visitedNodes = array();
        $nodeId = $node->getId();

        if($nodeId == $target){
            $visitedNodes[] = $nodeId;

            return $visitedNodes;
        }
        if(!in_array($nodeId,$visitedNodes)){
            $visitedNodes[] = $nodeId;
            $neighbours = $node->getNeighbours();
            
            foreach($neighbours as $neighbour){
                $this->search($neighbour,$target);
            }
        }
        return $visitedNodes;
    }
}