<?php

namespace Graph;

class Node implements INode
{
    private $id = '';
    private $visited;
    private $neighbours;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->visited = False;
        $this->neighbours = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function visited()
    {
        return $this->visited;
    }

    public function SetVisited(bool $bool)
    {
        $this->visited = $bool;
    }

    public function addNeighbour(Node $newNeighbour)
    {
        if (! in_array($newNeighbour,$this->neighbours) and $newNeighbour != $this){
            $this->neighbours[] = $newNeighbour;
            return True;
        }
        return False;
    }

    public function getNeighbours()
    {
        return $this->neighbours;
    }

    public function removeNeighbour(Node $oldNeighbour)
    {
        if (! in_array($oldNeighbour,$this->neighbours)){

            return False;
        }

        $newNeighbours = [];

        foreach ($this->neighbours as $neighbour){
            if ($neighbour != $oldNeighbour){
                $newNeighbours[] = $neighbour;
            }
        }
        $this->neighbours = $newNeighbours;

        return True;
    }
}