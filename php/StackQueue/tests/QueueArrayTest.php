<?php

namespace Tests;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TaskManager\QueueArray;

final class QueueArrayTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("\TaskManager\QueueArray"));
    }

    public function testGetReturnFalseNoElement(){
        $q = new QueueArray;
        $this->assertFalse($q->get());
    }

    public function testPutReturnTrue(){
        $q = new QueueArray;
        $element = 111;
        $this->assertTrue($q->put($element));
    }

    public function testPutAndGetElement(){
        $q = new QueueArray;
        $element = 111;
        $q->put($element);
        $this->assertEquals($element,$q->get());
    }

    public function testPutAndGetTwoElements(){
        $q = new QueueArray;
        $element = 111;
        $elementBis = 222;
        $q->put($element);
        $q->put($elementBis);
        $this->assertEquals($element,$q->get());
        $this->assertEquals($elementBis,$q->get());
        $this->assertFalse($q->get());
    }

    public function testSize(){
        $q = new QueueArray;
        $this->assertEquals(0,$q->size());
        
        $element = 111;
        $q->put($element);
        $this->assertEquals(1,$q->size());
    }
}