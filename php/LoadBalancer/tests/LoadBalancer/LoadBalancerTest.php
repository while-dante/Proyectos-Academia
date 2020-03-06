<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class LoadBalancerTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("LB\LoadBalancer"));
    }

    public function testGetName(){
        $random = new \Strategies\StrategyRandom;
        $LB = new \LB\LoadBalancer("Marta",$random);
        $this->assertFalse(empty($LB));
        $name = $LB->getName();
        $this->assertEquals("Marta",$name);
    }

    public function testAddServer(){
        $RR = new \Strategies\StrategyRoundRobin;
        $LB = new \LB\LoadBalancer("Ramon",$RR);
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerOk("S2");

        //addServer returns
        $this->assertTrue($LB->addServer($server1));
        $this->assertFalse($LB->addServer($server1));
        $this->assertTrue($LB->addServer($server2));

        $LB = new \LB\LoadBalancer("Ramon",$RR);

        //empty list
        $this->assertTrue(empty($LB->getList()));

        //add single server
        $LB->addServer($server1);
        $expected = array(
            "S1" => $server1
        );
        $this->assertEquals($expected,$LB->getList());

        //add same server
        $LB->addServer($server1);
        $this->assertEquals($expected,$LB->getList());

        //add different server
        $LB->addServer($server2);
        $expected = array(
            "S1" => $server1,
            "S2" => $server2
        );
        $this->assertEquals($expected,$LB->getList());
    }

    public function testRemoveServer(){
        $RR = new \Strategies\StrategyRoundRobin;
        $LB = new \LB\LoadBalancer("Ricardo",$RR);
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LB->addServer($server1);
        $LB->addServer($server2);

        //removeServer returns
        $this->assertTrue($LB->removeServer("S1"));
        $this->assertFalse($LB->removeServer("S1"));
        $this->assertTrue($LB->removeServer("S2"));

        $LB = new \LB\LoadBalancer("Ricardo",$RR);
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LB->addServer($server1);
        $LB->addServer($server2);

        $LB->removeServer("S1");
        $expected = array(
            "S2" => $server2
        );
        $this->assertEquals($expected,$LB->getList());
        
        $LB->removeServer("S2");
        $expected = array();
        $this->assertEquals($expected,$LB->getList());

        $LB->removeServer("S1");
        $this->assertEquals($expected,$LB->getList());
    }

    public function testCall(){
        $RR = new \Strategies\StrategyRoundRobin;
        $LB = new \LB\RoundRobin("LB",$RR);
        $server1 = new \Servers\ServerOk("S1");
        $server2 = new \Servers\ServerFail("S2");

        $LB->addServer($server1);
        $LB->addServer($server2);

        $this->assertEquals(200,$LB->call());
        $this->assertEquals(500,$LB->call());
        $this->assertEquals(200,$LB->call());

        //call when empty
        $LB = new \LB\RoundRobin("LB",$RR);

        try{
            $LB->call();
        }catch(\Exception $error){
            $this->assertTrue(True);
        }
    }
}