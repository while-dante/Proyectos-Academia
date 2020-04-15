<?php

namespace Test;

use Graph\Node;
use Graph\NodeFactory;
use PHPUnit\Framework\TestCase;

final class NodeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->zero = new Node(0);
        $this->one = new Node(1);
    }

    public function testGetId()
    {
        $expectedId = 0;
        $returnedId = $this->zero->getId();
        $this->assertEquals($expectedId,$returnedId);
    }

    public function testMarkAndVisit()
    {
        $confirm = $this->zero->visited();
        $this->assertFalse($confirm);

        $this->zero->setVisited(True);
        $confirm = $this->zero->visited();
        $this->assertTrue($confirm);

        $this->zero->setVisited(False);
        $confirm = $this->zero->visited();
        $this->assertFalse($confirm);
    }

    public function testAddNeighbour()
    {
        $zero = new Node(0);
        $confirm = $zero->addNeighbour($this->one);
        $this->assertTrue($confirm);
        
        $adjacentA = $zero->getNeighbours();
        $expectedList = [$this->one];
        $this->assertEquals($expectedList,$adjacentA);

        $confirm = $zero->addNeighbour($zero);
        $this->assertFalse($confirm);

        $confirm = $zero->addNeighbour($this->one);
        $this->assertFalse($confirm);

        $adjacentB = $this->one->getNeighbours();
        $expectedList = [];
        $this->assertEquals($expectedList,$adjacentB);
    }

    public function testRemoveNeighbour()
    {
        $zero = new Node(0);
        $one = new Node(1);
        $two = new Node(2);

        $zero->addNeighbour($one);
        $zero->addNeighbour($two);
        $expectedList = [$one,$two];
        $returnedList = $zero->getNeighbours();
        $this->assertEquals($expectedList,$returnedList);

        $confirm = $zero->removeNeighbour($one);
        $this->assertTrue($confirm);

        $expectedList = [$two];
        $returnedList = $zero->getNeighbours();
        $this->assertEquals($expectedList,$returnedList);

        $confirm = $zero->removeNeighbour($one);
        $this->assertFalse($confirm);
        $confirm = $zero->removeNeighbour($zero);
        $this->assertFalse($confirm);
    }

    public function testCreateNode()
    {
        $fiveFactory = NodeFactory::createNode(5);
        $five = new Node(5);

        $this->assertEquals($five,$fiveFactory);
    }

    public function testCreateMultipleNodes()
    {
        $zero = new Node(0);
        $one = new Node(1);
        $two = new Node(2);
        $three = new Node(3);
        $four = new Node(4);

        $returnedList = NodeFactory::createMultipleNodes(5);
        $expectedList = [$zero,$one,$two,$three,$four];

        $this->assertEquals($expectedList,$returnedList);
    }
}