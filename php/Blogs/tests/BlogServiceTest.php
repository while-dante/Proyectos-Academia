<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class BlogServiceTest extends TestCase{

    public function testClassExists(){
        $this->assertTrue(class_exists("Library\BlogService"));
        $blog = new \Library\BlogService;
        $this->assertFalse(empty($blog));
        $blog->drop();
    }

    public function testGetAllPosts(){
        $blog = new \Library\BlogService;
        $posts = $blog->getAllPosts("Dante");
        $this->assertEquals(array(),$posts);
        $blog->drop();
    }

    public function testSavePost(){
        $blog = new \Library\BlogService;
        $uService = new \Library\UserService;
        $uService->saveUser("Dante");
        $uService->saveUser("Damian");
        $mensaje0 = "Oh lil snail on the sidewalk, good luck in your journey.";
        $mensaje1 = "Sad emo shit.";
        $mensaje2 = "AAAAAAAAAA";
        $mensaje3 = "Welcome to my blog!";
        $blog->savePost($mensaje0,"Dante");
        $blog->savePost($mensaje1,"Dante");
        $blog->savePost($mensaje2,"Dante");
        $blog->savePost($mensaje3,"Damian");
        $expectedDante = array(
            $mensaje0, $mensaje1, $mensaje2
        );
        $postsDante = $blog->getAllPosts("Dante");
        $expectedDamian = array($mensaje3);
        $postsDamian = $blog->getAllPosts("Damian");
        $this->assertEquals($expectedDante,$postsDante);
        $this->assertEquals($expectedDamian,$postsDamian);
        $blog->drop();
        $uService->drop();
    }
}