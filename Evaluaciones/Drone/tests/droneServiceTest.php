<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Service\DroneService;
use MongoDB\Client;

final class DroneServiceTest extends TestCase{

    private $droneService;

    protected function setUp() : void{
        $connection  = new Client("mongodb://localhost");
        $droneCollection = $connection->testDroneService->drones;
        $droneCollection->drop();
        $this->droneService = new DroneService($droneCollection);
    }

    public function testRegisterReturn(){
        $confirm = $this->droneService->register(
            "001",10000,"Blue","R2D2"
        );
        $this->assertTrue($confirm);
        $confirm = $this->droneService->register(
            "001",10000,"Blue","R2D2"
        );
        $this->assertFalse($confirm);
    }

    public function testRegisterAndList(){
        $this->droneService->register(
            "001",10000,"Blue","R2D2"
        );
        $this->droneService->register(
            "001",10000,"Red","R2D2"
        );
        $this->droneService->register(
            "002",10000,"Blue","R2D2"
        );
        $this->droneService->register(
            "003",10000,"Teal","C3PO"
        );
        
        $expectedList = array(
            array(
                "name" => "001",
                "prize" => 10000,
                "colour" => "Blue",
                "model" => "R2D2"
            ),
            array(
                "name" => "002",
                "prize" => 10000,
                "colour" => "Blue",
                "model" => "R2D2"
            ),
            array(
                "name" => "003",
                "prize" => 10000,
                "colour" => "Teal",
                "model" => "C3PO"
            ),
        );
        $returnedList = $this->droneService->list();
        $this->assertEquals($expectedList,$returnedList);
    }

    public function testDeleteReturn(){
        $confirm = $this->droneService->delete("001");
        $this->assertFalse($confirm);

        $this->droneService->register(
            "001",10000,"Blue","R2D2"
        );
        $this->droneService->register(
            "002",10000,"Red","C3PO"
        );

        $confirm = $this->droneService->delete("001");
        $this->assertTrue($confirm);
        $confirm = $this->droneService->delete("005");
        $this->assertFalse($confirm);
    }

    public function testDeleteAndCheckList(){
        $this->droneService->register(
            "001",10000,"Blue","R2D2"
        );
        $this->droneService->register(
            "002",10000,"Red","R2D2"
        );
        $this->droneService->register(
            "003",10000,"Green","R2D2"
        );
        $expectedList = array(
            array(
                "name" => "001",
                "prize" => 10000,
                "colour" => "Blue",
                "model" => "R2D2"
            ),        
            array(
                "name" => "002",
                "prize" => 10000,
                "colour" => "Red",
                "model" => "R2D2"
            ),        
            array(
                "name" => "003",
                "prize" => 10000,
                "colour" => "Green",
                "model" => "R2D2"
            )            
        );
        $returnedList = $this->droneService->list();
        $this->assertEquals($expectedList,$returnedList);

        $this->droneService->delete("002");
        $this->droneService->delete("005");
        $expectedList = array(
            array(
                "name" => "001",
                "prize" => 10000,
                "colour" => "Blue",
                "model" => "R2D2"
            ),      
            array(
                "name" => "003",
                "prize" => 10000,
                "colour" => "Green",
                "model" => "R2D2"
            )            
        );
        $returnedList = $this->droneService->list();
        $this->assertEquals($expectedList,$returnedList);
    }
}