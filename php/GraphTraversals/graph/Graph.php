<?php

namespace Graph;

class Graph
{
    private $nodesInGraph;

    public function __construct()
    {
        $this->nodesInGraph = [];
    }

    public function connect(Node $node,array $neighbours)
    {
        if (! in_array($node,$this->nodesInGraph)){
            $this->nodesInGraph[] = $node;
        }

        foreach ($neighbours as $neighbour){
            $node->addNeighbour($neighbour);
            $neighbour->addNeighbour($node);
            $this->nodesInGrap[] = $neighbour;
        }
    }

    public function disconnect()
    {
        
    }

    public function showGraph()
    {
        $nodes = [];
        foreach ($this->nodesInGraph as $node){
            $id = $node->getId();
            if (! isset($nodes[$id]) and ! in_array($id,$nodes)){
                $nodes[$node->getId()] = [];
            }
            
            $neighbours = $node->getNeighbours();
            foreach ($neighbours as $neighbour){
                $nodes[$node->getId()][] = $neighbour->getId();
            }
        }
        
        return $nodes;
    }
}