<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class CounterTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("LB\Counter"));
    }

    public function testSaveServer(){
        $server = new \Servers\ServerOk("ok");
        $counter = new \LB\Counter($server);
        $this->assertTrue(True);
        $this->assertFalse(empty($counter));
    }

    public function testGetName(){
        $server = new \Servers\ServerOk("ok");
        $counter = new \LB\Counter($server);
        $this->assertEquals("ok",$counter->getName());
    }

    public function testCall(){
        $server = new \Servers\ServerOk("ok");
        $counter = new \LB\Counter($server);
        $this->assertEquals(200,$counter->call());
    }

    public function testGetCalls(){
        $server = new \Servers\ServerOk("ok");
        $counter = new \LB\Counter($server);
        $this->assertEquals(0,$counter->getTotalCalls());
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $this->assertEquals(5,$counter->getTotalCalls());
        $expected = array(200 => 5);
        $this->assertEquals($expected,$counter->getCalls());

        $server = new \Servers\ServerRedirect3F("3F");
        $counter = new \LB\Counter($server);
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $this->assertEquals(6,$counter->getTotalCalls());
        $expected = array(
            300 => 4,
            500 => 2
        );
        $this->assertEquals($expected,$counter->getCalls());
    }

    public function testGetData(){
        $server = new \Servers\ServerOk("ok");
        $counter = new \LB\Counter($server);
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $expected = array(
            "name" => "ok",
            "calls" => array(
                200 => 5
            ),
            "total" => 5
        );
        $this->assertEquals($expected,$counter->getData());

        $server = new \Servers\ServerRedirect3F("3F");
        $counter = new \LB\Counter($server);
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $counter->call();
        $expected = array(
            "name" => "3F",
            "calls" => array(
                300 => 4,
                500 => 2
            ),
            "total" => 6
        );
        $this->assertEquals($expected,$counter->getData());
    }
}