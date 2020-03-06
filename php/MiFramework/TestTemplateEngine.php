<?php

require_once("TemplateEngine.php");
require_once("./vendor/autoload.php");

use PHPUnit\Framework\TestCase;

final class TestTemplateEngine extends TestCase{

    public function testOK(){
        $this->assertTrue(True);
    }

    public function testClassExists(){
        $this->assertTrue(class_exists("TemplateEngine"));
    }

    public function testAddVariable(){
        $engine = new TemplateEngine("index.template");
        $confirm = $engine->addVariable("titulo","titulo");
        $this->assertTrue($confirm);
    }

    public function testRenderKeywordsNotReplaced(){
        $engine = new TemplateEngine("index.template");
        $expectedRender = file_get_contents("index.empty.template");
        $render = $engine->render();
        $this->assertEquals($expectedRender,$render);
    }

    public function testRenderIncorrectKeywords(){
        $engine = new TemplateEngine("index.template");
        $engine->addVariable("titular","Esto no deberia aparecer");
        $engine->addVariable("parrafoide","Esto tampoco");
        $expectedRender = file_get_contents("index.empty.template");
        $render = $engine->render();
        $this->assertEquals($expectedRender,$render);
    }

    public function testRenderWellDone(){
        $engine = new TemplateEngine("index.template");
        $engine->addVariable("titulo","soy un titulo");
        $engine->addVariable("parrafo","soy un parrafo");
        $engine->addVariable("cabecera","soy una cabecera");
        $expectedRender = file_get_contents("index.complete.template");
        $render = $engine->render();
        $this->assertEquals($expectedRender,$render);
    }

    public function testRenderSameKeywordReplacedTwice(){
        $engine = new TEmplateEngine("index.template");
        $engine->addVariable("titulo","yo no tengo que aparecer");
        $engine->addVariable("titulo","yo si tengo que aparecer");
        $expectedRender = file_get_contents("index.onlyTitle.template");
        $render = $engine->render();
        $this->assertEquals($expectedRender,$render);
    }

    public function testKeywords(){
        $engine = new TemplateEngine("index.template");
        $expectedKeywords = array("cabecera","titulo","parrafo","number"=>3);
        $keywords = $engine->keyWords();
        $this->assertEquals($expectedKeywords,$keywords);
    }

    public function testNoKeywords(){
        $engine = new TemplateEngine("index.empty.template");
        $expectedKeywords = array("number"=>0);
        $keywords = $engine->keywords();
        $this->assertEquals($expectedKeywords,$keywords);
    }
}