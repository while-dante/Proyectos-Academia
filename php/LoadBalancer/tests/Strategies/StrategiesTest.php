<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class StrategiesTest extends TestCase{

    public function testClassExists(){
        
        $this->assertTrue(class_exists("Strategies\StrategyRandom"));
        $this->assertTrue(class_exists("Strategies\StrategyRoundRobin"));
    }

    public function testPick(){
        $stratRandom = new \Strategies\StrategyRandom;
        $servers = array(0,1,2,3);

        srand(232323);
        $chosenOne = $stratRandom->pick($servers);
        $this->assertEquals(1,$chosenOne);
        $chosenOne = $stratRandom->pick($servers);
        $this->assertEquals(3,$chosenOne);
        $chosenOne = $stratRandom->pick($servers);
        $this->assertEquals(3,$chosenOne);
        $chosenOne = $stratRandom->pick($servers);
        $this->assertEquals(2,$chosenOne);
        $chosenOne = $stratRandom->pick($servers);
        $this->assertEquals(3,$chosenOne);

        $stratRoundRobin = new \Strategies\StrategyRoundRobin;
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(0,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(1,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(2,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(3,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(0,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(1,$chosenOne);
        
        $servers = array(0,1);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(0,$chosenOne);
        $chosenOne = $stratRoundRobin->pick($servers);
        $this->assertEquals(1,$chosenOne);
    }
}


