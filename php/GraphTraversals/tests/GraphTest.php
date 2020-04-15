<?php

namespace Test;

use Graph\Graph;
use Graph\NodeFactory;
use PHPUnit\Framework\TestCase;

final class testGraphService extends TestCase
{
    protected function setUp(): void
    {
        $this->graph = new Graph;
        $this->nodes = NodeFactory::createMultipleNodes(7);
    }

    public function testShowGraph()
    {
        $representation = $this->graph->showGraph();
        $expectedRepresent = [];
        $this->assertEquals($expectedRepresent,$representation);
    }

    public function testConnectAndShowGraph()
    {
        $zero = $this->nodes[0];
        $oneTwo = array_slice($this->nodes,1,2);
        $this->graph->connect($zero,$oneTwo);

        $representation = $this->graph->showGraph();
        $expectedRepresent = [
            0 => [
                1,2
            ]
        ];
        $this->assertEquals($expectedRepresent,$representation);

        $one = $this->nodes[1];
        $two = $this->nodes[2];
        $bigGraph = new Graph;
        $bigGraph->connect($zero,[$one,$two]);

        $oneConnections = array_slice($this->nodes,3,3);
        $twoConnections = array_slice($this->nodes,6);
        $bigGraph->connect($one,$oneConnections);
        $bigGraph->connect($two,$twoConnections);

        $representation = $bigGraph->showGraph();
        $expectedRepresent = [
            0 => [
                1 => [3,4,5],
                2 => [6]
            ]
        ];
        $this->assertEquals($expectedRepresent,$representation);
    }
}