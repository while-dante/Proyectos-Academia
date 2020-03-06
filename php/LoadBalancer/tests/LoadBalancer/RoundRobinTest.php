<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class RoundRobinTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("LB\RoundRobin"));
    }

    public function testGetName(){
        $LoBaRR = new \LB\RoundRobin("test");
        $this->assertFalse(empty($LoBaRR));
        $name = $LoBaRR->getName();
        $this->assertEquals("test",$name);
    }

    public function testAddServer(){
        $LoBaRR = new \LB\RoundRobin("RR");
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerOk("S2");

        //addServer returns
        $this->assertTrue($LoBaRR->addServer($server1));
        $this->assertFalse($LoBaRR->addServer($server1));
        $this->assertTrue($LoBaRR->addServer($server2));

        $LoBaRR = new \LB\RoundRobin("RR");

        //empty list
        $this->assertTrue(empty($LoBaRR->getList()));

        //add single server
        $LoBaRR->addServer($server1);
        $expected = array(
            "S1" => $server1
        );
        $this->assertEquals($expected,$LoBaRR->getList());

        //add same server
        $LoBaRR->addServer($server1);
        $this->assertEquals($expected,$LoBaRR->getList());

        //add different server
        $LoBaRR->addServer($server2);
        $expected = array(
            "S1" => $server1,
            "S2" => $server2
        );
        $this->assertEquals($expected,$LoBaRR->getList());

    }

    public function testCall(){
        $LoBaRR = new \LB\RoundRobin("RR");
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LoBaRR->addServer($server1);
        $LoBaRR->addServer($server2);

        $this->assertEquals(200,$LoBaRR->call());
        $this->assertEquals(500,$LoBaRR->call());
        $this->assertEquals(200,$LoBaRR->call());

        //call when empty
        $LoBaRR = new \LB\RoundRobin("RR");

        try{
            $LoBaRR->call();
        }catch(\Exception $error){
            $this->assertTrue(True);
        }
    }

    public function testRemoveServer(){
        $LoBaRR = new \LB\RoundRobin("RR");
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LoBaRR->addServer($server1);
        $LoBaRR->addServer($server2);

        //removeServer returns
        $this->assertTrue($LoBaRR->removeServer("S1"));
        $this->assertFalse($LoBaRR->removeServer("S1"));
        $this->assertTrue($LoBaRR->removeServer("S2"));

        $LoBaRR = new \LB\RoundRobin("RR");
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LoBaRR->addServer($server1);
        $LoBaRR->addServer($server2);

        $LoBaRR->removeServer("S1");
        $expected = array(
            "S2" => $server2
        );
        $this->assertEquals($expected,$LoBaRR->getList());
        
        $LoBaRR->removeServer("S2");
        $expected = array();
        $this->assertEquals($expected,$LoBaRR->getList());

        $LoBaRR->removeServer("S1");
        $this->assertEquals($expected,$LoBaRR->getList());
    }

    public function testRemoveAndCall(){
        $LoBaRR = new \LB\RoundRobin("RR");
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");
        $server3 = new \Servers\ServerDoomsdayClock("S3",2);

        $LoBaRR->addServer($server1);
        $LoBaRR->addServer($server2);
        $LoBaRR->addServer($server3);

        $this->assertEquals(200,$LoBaRR->call());
        $this->assertEquals(500,$LoBaRR->call());
        $this->assertEquals(200,$LoBaRR->call());
        $LoBaRR->removeServer("S1");
        $this->assertEquals(500,$LoBaRR->call());
        $this->assertEquals(500,$LoBaRR->call());
        $this->assertEquals(500,$LoBaRR->call());
        $this->assertEquals(0,$LoBaRR->call());
    }
}