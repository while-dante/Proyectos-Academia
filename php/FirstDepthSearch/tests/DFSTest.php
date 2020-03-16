<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use \Node\Node;
use Searcher\DFS as SearcherDFS;

final class DFSTest extends TestCase{
    
    protected function setUp(): void{
        $this->searcher = new SearcherDFS;
        $this->A = new Node('A');
        $this->B = new Node('B');
        $this->C = new Node('C');
        $this->D = new Node('D');
        $this->E = new Node('E');
        $this->F = new Node('F');
        $this->G = new Node('G');
    }

    public function testSearchOneNode(){
        $visited = $this->searcher->search($this->A);
        $this->searcher->clear();
        $this->assertEquals(['A'],$visited);
    }

    public function testSearchThreeNodes(){
        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $visited = $this->searcher->search($this->A);
        $expected = ['A','B','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $visited = $this->searcher->search($this->C);
        $expected = ['C','A','B'];
        $this->assertEquals($expected,$visited);
    }

    public function testSearchThreeNodesRound(){
        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $this->B->connect($this->C);

        $visited = $this->searcher->search($this->A);
        $expected = ['A','B','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $visited = $this->searcher->search($this->B);
        $expected = ['B','A','C'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $visited = $this->searcher->search($this->C);
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

        $visited = $this->searcher->search($this->E);
        $expected = ['E','C','D','B','A','F'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $this->F->disconnect($this->A);

        $visited = $this->searcher->search($this->A);
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

        $visited = $this->searcher->search($this->D);
        $expected = ['D','F','C','A','E','G','B'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);

        $visited = $this->searcher->search($this->A);
        $expected = ['A','C','E','G','F','D','B'];
        $this->searcher->clear();
        $this->assertEquals($expected,$visited);
    }

    public function testSearchTarget(){
        $this->A->connect($this->B);
        $visited = $this->searcher->search($this->A,'A');
        $this->searcher->clear();
        $expected = ['A'];
        $this->assertEquals($expected,$visited);
        
        $visited = $this->searcher->search($this->A,'B');
        $this->searcher->clear();
        $expected = ['A','B'];
        $this->assertEquals($expected,$visited);

        $this->A->connect($this->C);
        $visited = $this->searcher->search($this->A,'C');
        $this->searcher->clear();
        $expected = ['A','B','C'];
        $this->assertEquals($expected,$visited);

        $this->C->connect($this->D);
        $visited = $this->searcher->search($this->A,'C');
        $this->searcher->clear();
        $expected = ['A','B','C'];
        $this->assertEquals($expected,$visited);
    }
}