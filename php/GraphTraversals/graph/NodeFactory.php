<?php

namespace Graph;

class NodeFactory
{
    static public function createNode(int $id)
    {
        return new Node($id);
    }

    static public function createMultipleNodes(int $quant)
    {
        $nodes = [];

        for($i=0;$i<$quant;$i++){
            $nodes[] = new Node($i);
        }
        
        return $nodes;
    }
}