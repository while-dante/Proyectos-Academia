<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class RandomTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("LB\Random"));
    }
    
    public function testGetName(){
        $random = new \LB\Random("randi");
        $this->assertFalse(empty($random));
        $this->assertEquals("randi",$random->getName());
    }

    public function testAddServer(){
        $random = new \LB\Random("randi");
        $this->assertTrue(empty($random->getList()));
        
        $server1 = new \Servers\ServerOk("ok");
        $server2 = new \Servers\ServerRedirect3F("tri");
        $server3 = new \Servers\ServerQuirky("q");
        
        $this->assertTrue($random->addServer($server1));
        $expected = array(
            "ok" => $server1
        );
        $this->assertEquals($expected,$random->getList());

        $this->assertFalse($random->addServer($server1));
        $this->assertEquals($expected,$random->getList());

        $this->assertTrue($random->addServer($server2));
        $this->assertTrue($random->addServer($server3));
        $expected = array(
            "ok" => $server1,
            "tri" => $server2,
            "q" => $server3
        );
        $this->assertEquals($expected,$random->getList());
    }

    public function testRemoveServer(){
        $random = new \LB\Random("randi");
        $this->assertFalse($random->removeServer(""));
        $this->assertFalse($random->removeServer("server"));

        $server1 = new \Servers\ServerOk("ok");
        $server2 = new \Servers\ServerFail("fail");
        $server3 = new \Servers\ServerDoomsdayClock("clock",5);
        $random->addServer($server1);
        $random->addServer($server2);
        $random->addServer($server3);

        $this->assertTrue($random->removeServer("ok"));
        $this->assertFalse($random->removeServer("ko"));
        $expected = array(
            "fail" => $server2,
            "clock" => $server3
        );
        $this->assertEquals($expected,$random->getList());
        
        $this->assertTrue($random->removeServer("fail"));
        $this->assertTrue($random->removeServer("clock"));
        $expected = array();
        $this->assertEquals($expected,$random->getList());
    }

    public function testCall(){
        $random = new \LB\Random("randi");
        try{
            $this->assertEquals(200, $random->call());
        }catch(\Exception $error){
            $this->assertTrue(True);
        }

        $server1 = new \Servers\ServerOk("ok");
        $server2 = new \Servers\ServerFail("fail");
        $server3 = new \Servers\ServerRedirect3F("3F");
        $random->addServer($server1);
        $random->addServer($server2);
        $random->addServer($server3);

        srand(1337);
        $this->assertEquals(500,$random->call());
        $this->assertEquals(500,$random->call());
        $this->assertEquals(300,$random->call());
        $this->assertEquals(500,$random->call());
        $this->assertEquals(300,$random->call());
        $this->assertEquals(500,$random->call());
    }
}

