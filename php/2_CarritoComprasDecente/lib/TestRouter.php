<?php

require_once("Router.php");
require_once("./vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class TestRouter extends TestCase{

    public function testOK(){
        $this->assertTrue(True);
    }

    public function testRouterClass(){
        $this->assertTrue(class_exists("Router"));
    }

    public function testCanAddRoute(){
        $router = new Router();
        $router->addRoute("path","target");
        $this->assertTrue(True);
    }

    public function testCanMatch(){
        $router = new Router();
        $router->match("path");
        $this->assertTrue(True);
    }

    public function testAddRoute(){
        $router = new Router();
        $confirm = $router->addRoute("path","target");
        $this->assertTrue($confirm);
    }

    public function testAddSameRoute(){
        $router = new Router();

        $confirm = $router->addRoute("path","target0");
        $this->assertTrue($confirm);

        $confirm = $router->addRoute("path","target1");
        $this->assertFalse($confirm);
    }

    public function testNoMatch(){
        $router = new Router();
        $target = $router->match("NonexistentPath");
        $this->assertFalse($target);
    }

    public function testMatch(){
        $router = new Router();

        $router->addRoute("path","target");
        $expectedMatch = "target";
        $match = $router->match("path");
        $this->assertEquals($expectedMatch,$match);

        $router->addRoute("numberPath",10);
        $expectedMatch = 10;
        $match = $router->match("numberPath");
        $this->assertEquals($expectedMatch,$match);
    }

    public function testNoStringPath(){
        $router = new Router();
        $confirm = $router->addRoute(10,"target");
        $this->assertFalse($confirm);
    }

    //====================URLs and regex=========================

    public function testGenericURL(){
        $router = new Router();
        $router->addRoute("^(/noticia)/(?<id>\d+)/(?<anio>\d{4})/(?<mes>\d{1,2})/(?<dia>\d{1,2})(\.html)$","noticias");
        
        $matchNoticias = $router->match("/noticia/1337/2001/2/7.html");
        $this->assertEquals("noticias",$matchNoticias);

        $matchNoticias = $router->match("/noticia/420/1998/2/10.html");
        $this->assertEquals("noticias",$matchNoticias);
    }

    public function testBadURL(){
        $router = new Router();
        $router->addRoute("^(/noticia)/(?<id>\d+)/(?<anio>\d{4})/(?<mes>\d{1,2})/(?<dia>\d{1,2})(\.html)$","noticias");

        $badMatches = array(
            $badMatch0 = $router->match("/noticion/666/0001/13/32.html"),
            $badMatch1 = $router->match("/noticia/cinco/0001/13/32.html"),
            $badmatch2 = $router->match("/noticia/777/2020/1/.html")
        );

        foreach($badMatches as $match){
            $this->assertFalse($match);
        }
    }
}