<?php

namespace Node;

interface INode{
    public function getId();
    public function getNeighbours();
    public function connect(\Node\Node $newNeighbours);
}