<?php

namespace Graph;

interface INode
{
    public function getId();
    public function visited();
    public function SetVisited(bool $bool);
    public function addNeighbour(Node $node);
    public function getNeighbours();
    public function removeNeighbour(Node $node);
}