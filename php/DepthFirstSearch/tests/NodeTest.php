<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use \Node\Node;

final class NodeTest extends TestCase{
    protected function setUp(): void{
        $this->A = new Node('A');
        $this->B = new Node('B');
        $this->C = new Node('C');
        $this->D = new Node('D');
        $this->E = new Node('E');
    }

    public function testGetId(){
        $ids = [];
        $ids[] = $this->A->getId();
        $ids[] = $this->B->getId();
        $ids[] = $this->C->getId();
        $ids[] = $this->D->getId();
        $expectedIds = ['A','B','C','D'];
        $this->assertEquals($expectedIds,$ids);
    }

    public function testConnect(){
        $return = $this->A->connect($this->A);
        $this->assertFalse($return);
        $return = $this->A->connect($this->B);
        $this->assertTrue($return);
        $return = $this->A->connect($this->B);
        $this->assertFalse($return);
        $return = $this->A->connect($this->C);
        $this->assertTrue($return);
    }

    public function testGetNeighbours(){
        $return = $this->A->getNeighbours();
        $expected = [];
        $this->assertEquals($expected,$return);

        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $return = $this->A->getNeighbours();
        $expected = [
            $this->B,
            $this->C
        ];
        $this->assertEquals($expected,$return);

        $return = $this->B->getNeighbours();
        $expected = [$this->A];
        $this->assertEquals($expected,$return);

        $return = $this->C->getNeighbours();
        $this->assertEquals($expected,$return);
    }

    public function testDisconnect(){
        $return = $this->A->disconnect($this->B);
        $this->assertFalse($return);

        $this->A->connect($this->B);
        $this->A->connect($this->C);
        $return = $this->A->getNeighbours();
        $expected = [$this->B,$this->C];
        $this->assertEquals($expected,$return);

        $return = $this->B->getNeighbours();
        $expected = [$this->A];
        $this->assertEquals($expected,$return);

        $return = $this->A->disconnect($this->B);
        $this->assertTrue($return);

        $return = $this->A->getNeighbours();
        $expected = [$this->C];
        $this->assertEquals($expected,$return);

        $return = $this->B->getNeighbours();
        $expected = [];
        $this->assertEquals($expected,$return);
    }

    public function testRotateNeighbours(){
        $return = $this->A->rotateNeighbours();
        $this->assertFalse($return);

        $this->A->connect($this->B);
        $return = $this->A->rotateNeighbours();
        $this->assertFalse($return);

        $this->A->connect($this->C);
        $return = $this->A->rotateNeighbours();
        $this->assertTrue($return);

        $neighbours = $this->A->getNeighbours();
        $expectedNeighbours = [$this->C,$this->B];
        $this->assertEquals($expectedNeighbours,$neighbours);

        $this->A->connect($this->D);
        $this->A->connect($this->E);
        $this->A->rotateNeighbours();
        $neighbours = $this->A->getNeighbours();
        $expectedNeighbours = [$this->B,$this->D,$this->E,$this->C];
        $this->assertEquals($expectedNeighbours,$neighbours);
    }

}