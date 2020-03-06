<?php

namespace Tests;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TaskManager\Queue;
use TaskManager\Stack;

final class QueueTest extends TestCase{

    protected function setUp() : void{
        $stackA = new Stack;
        $stackB = new Stack;
        $this->q = new Queue($stackA,$stackB);
    }

    public function testClassExists(){
        $this->assertTrue(class_exists("\TaskManager\Queue"));
    }

    public function testGetReturnFalseNoElement(){
        $this->assertFalse($this->q->get());
    }

    public function testPutReturnTrue(){
        $element = 111;
        $this->assertTrue($this->q->put($element));
    }

    public function testPutAndGetElement(){
        $element = 111;
        $this->q->put($element);
        $this->assertEquals($element,$this->q->get());
    }

    public function testPutAndGetTwoElements(){
        $element = 111;
        $elementBis = 222;
        $this->q->put($element);
        $this->q->put($elementBis);
        $this->assertEquals($element,$this->q->get());
        $this->assertEquals($elementBis,$this->q->get());
        $this->assertFalse($this->q->get());
    }

    public function testSize(){
        $this->assertEquals(0,$this->q->size());
        
        $element = 111;
        $this->q->put($element);
        $this->assertEquals(1,$this->q->size());
    }
}