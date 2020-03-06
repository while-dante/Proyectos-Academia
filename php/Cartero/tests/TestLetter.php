<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class TestLetter extends TestCase
{
    protected function setUp(): void
    {
        $this->letter = new \Models\Letter("Sensational","Receptor","Hiii");
    }
    public function testGetSender(){
        $expected = "Sensational";
        $obtained = $this->letter->getSender();
        $this->assertEquals($expected,$obtained);
    }

    public function testGetRecipient(){
        $expected = "Receptor";
        $obtained = $this->letter->getRecipient();
        $this->assertEquals($expected,$obtained);
    }

    public function testGetContent(){
        $expected = "Hiii";
        $obtained = $this->letter->getContent();
        $this->assertEquals($expected,$obtained);
    }
}