<?php

namespace Tests;

use Node\BFS;
use PHPUnit\Framework\TestCase;
use \Node\Node;

final class BFSTest extends TestCase{

    protected function setUp(): void{
        $this->searcher = new BFS;
        $this->A = new Node('A');
        $this->B = new Node('B');
        $this->C = new Node('C');
        $this->D = new Node('D');
        $this->E = new Node('E');
        $this->F = new Node('F');
        $this->G = new Node('G');
    }
}