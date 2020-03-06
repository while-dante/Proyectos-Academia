<?php

include './vendor/autoload.php';
include './lib/Router.php';

use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase{

    public function testsRouterExists(){
        $this->assertTrue(class_exists("Router"));
        $router = new Router();
        $this->assertFalse(empty($router));
    }

    public function testDispatchPathsWithoutController(){
        $router = new Router();
        $strPath = "tetsPath";
        $intPath = 8080;
        $boolPath = True;
        $this->assertFalse($router->dispatch($strPath));
        $this->assertFalse($router->dispatch($intPath));
        $this->assertFalse($router->dispatch($boolPath));
    }

    public function testAgregarController(){
        $router = new Router();
        $controller = "controller";
        $path = "path";
        $confirm = $router->agregarController($path,$controller);
        $this->assertTrue($confirm);
        $expected = "controller";
        $dispatched = $router->dispatch("path");
        $this->assertEquals($expected,$dispatched);
    }

    public function testAgregarControllersDistintosPathDistintos(){
        $router = new Router();
        $controller1 = "controller1";
        $path1 = "path1";
        $controller2 = "controller2";
        $path2 = "path2";
        $confimr1 = $router->agregarController($path1,$controller1);
        $confimr2 = $router->agregarController($path2,$controller2);
        $this->assertTrue($confimr1);
        $this->assertTrue($confimr2);
        $dispatched = $router->dispatch("path2");
        $expected = "controller2";
        $this->assertEquals($dispatched,$expected);
    }

    public function testAgregarMismoControllerDisntitosPath(){
        $router = new Router();
        $controller = "controller";
        $path1 = "p1";
        $path2 = "p2";
        $confirm = $router->agregarController($path1,$controller);
        $this->assertTrue($confirm);
        $confirm = $router->agregarController($path2,$controller);
        $this->assertTrue($confirm);
        $expected = "controller";
        $dispatched = $router->dispatch("p1");
        $this->assertEquals($expected,$dispatched);
        $this->assertEquals($dispatched,$router->dispatch("p2"));
    }

    public function testAgregarControllersMismoPath(){
        $router = new Router();
        $controller1 = "c1";
        $controller2 = "c2";
        $path = "p";
        $confirm = $router->agregarController($path,$controller1);
        $this->assertTrue($confirm);
        $confirm = $router->agregarController($path,$controller1);
        $this->assertFalse($confirm);
        $confirm = $router->agregarController($path,$controller2);
        $this->assertFalse($confirm);
    }

    public function testDeleteNonxistentPath(){
        $router = new Router();
        $router->agregarController("pathQueExiste","controllerComunYSilvestre");
        $confirm = $router->deleteController("pathQueNoExiste");
        $this->assertFalse($confirm);
        $expected = "controllerComunYSilvestre";
        $dispatched = $router->dispatch("pathQueExiste");
        $this->assertEquals($expected,$dispatched);
    }

    public function testDeleteExistentPath(){
        $router = new Router();
        $router->agregarController("path","controller");
        $router->agregarController("noBorrar","plis");
        $confirm = $router->deleteController("path");
        $this->assertTrue($confirm);
        $expected = "plis";
        $dispatched = $router->dispatch("noBorrar");
        $this->assertEquals($expected,$dispatched);
    }
}