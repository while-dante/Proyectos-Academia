<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class UserServiceTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("Library\UserService"));
        $service = new \Library\UserService;
        $this->assertFalse(empty($service));
        $service->drop();
    }

    public function testGetAllUsers(){
        $service = new \Library\UserService;
        $users = $service->getAllUsers();
        $this->assertEquals(array(),$users);
        $service->drop();
    }

    public function testUserExists(){
        $service = new \Library\UserService;
        $this->assertFalse($service->userExists("Dante"));
        $service->drop();
    }

    public function testSaveUser(){
        $service = new \Library\UserService;
        $this->assertTrue($service->saveUser("Dante"));
        $this->assertFalse($service->saveUser("Dante"));
        $this->assertTrue($service->saveUser("Damian"));
        $expected = array("Dante","Damian");
        $this->assertEquals($expected,$service->getAllUsers());
        $service->drop();
    }

    public function testAllSteps(){
        $service = new \Library\UserService;
        $confirm = $service->saveUser("Dante");
        $this->assertTrue($confirm);
        $confirm = $service->saveUser("Damian");
        $this->assertTrue($confirm);
        
        $confirm = $service->userExists("Dante");
        $this->assertTrue($confirm);
        $confirm = $service->userExists("Pepe");
        $this->assertFalse($confirm);

        $expected = array("Dante","Damian");
        $users = $service->getAllUsers();
        $this->assertEquals($expected,$users);
        $service->drop();
    }
}