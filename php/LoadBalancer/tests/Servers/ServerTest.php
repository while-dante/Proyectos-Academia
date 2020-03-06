<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class ServerTest extends TestCase{

    public function testServerExists(){

        $this->assertTrue(class_exists("\Servers\ServerOk"));
        $this->assertTrue(class_exists("\Servers\ServerFail"));
        $this->assertTrue(class_exists("\Servers\ServerDoomsdayClock"));
        $this->assertTrue(class_exists("\Servers\ServerQuirky"));
        $this->assertTrue(class_exists("\Servers\ServerRedirect3F"));
    }

    public function testGetName(){
        $ok = new \Servers\ServerOk("ok");
        $fail = new \Servers\ServerFail("fail");
        $clock = new \Servers\ServerDoomsdayClock("clock",1);
        $quirky = new \Servers\ServerQuirky("quirky");
        $redir3F = new \Servers\ServerRedirect3F("trifail");

        $this->assertEquals("ok",$ok->getName());
        $this->assertEquals("fail",$fail->getName());
        $this->assertEquals("clock",$clock->getName());
        $this->assertEquals("quirky",$quirky->getName());
        $this->assertEquals("trifail",$redir3F->getName());
    }

    public function testCall(){
        $ok = new \Servers\ServerOk("ok");
        $fail = new \Servers\ServerFail("fail");
        $clock = new \Servers\ServerDoomsdayClock("clock",3);
        $quirky = new \Servers\ServerQuirky("quirky");
        $redir3F = new \Servers\ServerRedirect3F("trifail");

        $this->assertEquals(200,$ok->call());
        $this->assertEquals(200,$ok->call());
        $this->assertEquals(200,$ok->call());


        $this->assertEquals(500,$fail->call());
        $this->assertEquals(500,$fail->call());
        $this->assertEquals(500,$fail->call());

        $this->assertEquals(200,$clock->call());
        $this->assertEquals(200,$clock->call());
        $this->assertEquals(500,$clock->call());
        $this->assertEquals(0,$clock->call());
        $this->assertEquals(0,$clock->call());
        $this->assertEquals(0,$clock->call());

        $responses = array(0,200,300,400,500);

        srand(42);
        
        $this->assertEquals(300,$quirky->call());
        $this->assertEquals(300,$quirky->call());
        $this->assertEquals(200,$quirky->call());
        $this->assertEquals(500,$quirky->call());

        $this->assertEquals(300,$redir3F->call());
        $this->assertEquals(300,$redir3F->call());
        $this->assertEquals(500,$redir3F->call());
        $this->assertEquals(300,$redir3F->call());
        $this->assertEquals(300,$redir3F->call());
        $this->assertEquals(500,$redir3F->call());
        $this->assertEquals(300,$redir3F->call());
    }
}
