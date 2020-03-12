<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use \Node\Node;
use \Node\FDS;

final class FDSTest extends TestCase{
    
    protected function setUp(): void{
        $this->searcher = new FDS;
        $this->A = new Node('A');
        $this->B = new Node('B');
        $this->C = new Node('C');
        $this->D = new Node('D');
        $this->E = new Node('E');
        $this->F = new Node('F');
        $this->G = new Node('G');

    }

    public function testGetVisited(){
        $visited = $this->searcher->getVisited();
        $this->assertEquals(array(),$visited);
    }

    public function testSearchOneNode(){
        $this->searcher->search($this->A);
        $visited = $this->searcher->getVisited();
        $this->searcher->clear();
        $this->assertEquals(['A'],$visited);
    }

    public function testSearchThreeNodes(){
        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $this->searcher->search($this->A);
        $visited = $this->searcher->getVisited();
        $expected = ['A','B','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->searcher->search($this->C);
        $visited = $this->searcher->getVisited();
        $expected = ['C','A','B'];
        $this->assertEquals($expected,$visited);
    }

    public function testSearchThreeNodesRound(){
        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $this->B->connect($this->C);

        $this->searcher->search($this->A);
        $visited = $this->searcher->getVisited();
        $expected = ['A','B','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->searcher->search($this->B);
        $visited = $this->searcher->getVisited();
        $expected = ['B','A','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->searcher->search($this->C);
        $visited = $this->searcher->getVisited();
        $expected = ['C','A','B'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);
    }

    public function testSearchInGraph(){
        $this->E->connect($this->C);
        $this->E->connect($this->B);
        $this->E->connect($this->F);
        $this->C->connect($this->D);
        $this->B->connect($this->D);
        $this->F->connect($this->A);
        $this->D->connect($this->A);

        $this->searcher->search($this->E);
        $visited = $this->searcher->getVisited();
        $expected = ['E','C','D','B','A','F'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->F->disconnect($this->A);

        $this->searcher->search($this->A);
        $visited = $this->searcher->getVisited();
        $expected = ['A','D','C','E','B','F'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);
    }

    public function testFinalGraph(){
        $this->A->connect($this->C);
        $this->A->connect($this->E);
        $this->C->connect($this->E);
        $this->C->connect($this->F);
        $this->E->connect($this->G);
        $this->F->connect($this->G);
        $this->F->connect($this->D);
        $this->F->connect($this->B);

        $this->searcher->search($this->D);
        $visited = $this->searcher->getVisited();
        $expected = ['D','F','C','A','E','G','B'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->searcher->search($this->A);
        $visited = $this->searcher->getVisited();
        $expected = ['A','C','E','G','F','D','B'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);
    }
}