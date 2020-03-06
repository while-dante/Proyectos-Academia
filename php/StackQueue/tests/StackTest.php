<?php

namespace Tests;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TaskManager\Stack;

final class StackTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("\TaskManager\Stack"));
    }

    public function testPopReturnFalseNoElement(){
        $stack = new Stack;
        $this->assertFalse($stack->pop());
    }

    public function testPushElementsReturnTrue(){
        $stack = new Stack;
        $element = 111;
        $elementBis = 222;
        $this->assertTrue($stack->push($element));
        $this->assertTrue($stack->push($element));
        $this->assertTrue($stack->push($elementBis));
    }

    public function testPushAndPopReturnElement(){
        $stack = new Stack;
        $element = 111;
        $stack->push($element);
        $this->assertEquals($element,$stack->pop());
    }

    public function testPushTwoElementsPopLast(){
        $stack = new Stack;
        $element1 = 111;
        $element2 = 222;
        $stack->push($element1);
        $stack->push($element2);
        $this->assertEquals($element2,$stack->pop());
        $this->assertEquals($element1,$stack->pop());
        $this->assertFalse($stack->pop());
    }

    public function testEmptyReturn(){
        $stack = new Stack;
        $this->assertTrue($stack->empty());
        $element = 111;
        $stack->push($element);
        $this->assertFalse($stack->empty());
    }
}