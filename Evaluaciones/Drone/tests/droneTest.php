<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Drone\Drone;

final class DroneTest extends TestCase{

    public function testInitialPosition(){
        $drone = new Drone;
        $expectedPosition = array(
            "x" => 0,
            "y" => 0
        );
        $returnedPosition = $drone->position();
        $this->assertEquals($expectedPosition,$returnedPosition);
    }

    public function testInitialBattery(){
        $drone = new Drone;
        $expectedBattery = 100;
        $returnedBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$returnedBattery);
    }

    public function testMoveOutOfBounds(){
        $drone = new Drone;
        $confirm = $drone->move(-1,0);
        $this->assertFalse($confirm);
        $confirm = $drone->move(20,0);
        $this->assertFalse($confirm);
        $confirm = $drone->move(0,37);
        $this->assertFalse($confirm);
    }

    public function testMoveDiagonally(){
        $drone = new Drone;
        $confirm = $drone->move(1,1);
        $this->assertFalse($confirm);
        $confirm = $drone->move(7,7);
        $this->assertFalse($confirm);
        $confirm = $drone->move(19,19);
        $this->assertFalse($confirm);
    }

    public function testMoveInsideBounds(){
        $drone = new Drone;
        $confirm = $drone->move(0,15);
        $this->assertTrue($confirm);
    }

    public function testMoveInsideBoundsTwice(){
        $drone = new Drone;
        $confirm = $drone->move(0,5);
        $this-> assertTrue($confirm);
        $confirm = $drone->move(7,5);
        $this->assertTrue($confirm);
    }

    public function testMoveToSamePosition(){
        $drone = new Drone;
        $confirm = $drone->move(5,0);
        $this->assertTrue($confirm);
        $confirm = $drone->move(5,0);
        $this->assertFalse($confirm);
    }

    public function testMoveAndCheckPosition(){
        $drone = new Drone;
        $drone->move(10,0);
        $expectedPosition = array(
            "x" => 10,
            "y" => 0,
        );
        $currentPosition = $drone->position();
        $this->assertEquals($expectedPosition,$currentPosition);
        
        $drone->move(10,18);
        $expectedPosition = array(
            "x" => 10,
            "y" => 18,
        );
        $currentPosition = $drone->position();
        $this->assertEquals($expectedPosition,$currentPosition);
    }

    public function testMoveAndCheckBattery(){
        $drone = new Drone;
        $drone->move(5,0);
        $expectedBattery = 95;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
        $drone->move(17,0);
        $expectedBattery = 83;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
    }

    public function testMoveAndRechargeBattery(){
        $drone = new Drone;
        $drone->move(15,0);
        $expectedBattery = 85;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
        $drone->move(0,0);
        $expectedBattery = 100;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
    }

    public function testNotEnoughBattery(){
        $drone = new Drone;
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $confirm = $drone->move(0,11);
        $this->assertTrue($confirm);
        $confirm = $drone->move(0,1);
        $this->assertFalse($confirm);

        $expectedBattery = 9;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
        $expectedPosition = array(
            "x" => 0,
            "y" => 11
        );
        $currentPosition = $drone->position();
        $this->assertEquals($expectedPosition,$currentPosition);
    }

    public function testOutOfBattery(){
        $drone = new Drone;
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $drone->move(0,1);
        $drone->move(0,11);
        $confirm = $drone->move(0,2);
        $this->assertTrue($confirm);
        $confirm = $drone->move(7,2);
        $this->assertFalse($confirm);

        $expectedBattery = 0;
        $currentBattery = $drone->battery();
        $this->assertEquals($expectedBattery,$currentBattery);
        $expectedPosition = array(
            "x" => 0,
            "y" => 2
        );
        $currentPosition = $drone->position();
        $this->assertEquals($expectedPosition,$currentPosition);
    }
}