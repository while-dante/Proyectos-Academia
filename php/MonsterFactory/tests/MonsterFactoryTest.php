<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Resource\MonsterFactory;
use Monster\Faerie;
use Monster\NullMonster;
use Monster\Zombie;

final class MonsterFactoryTest extends TestCase{

    public function testMakeZombie(){
        $createdMonster = MonsterFactory::createMonster('Zombie');
        $expectedMonster = new Zombie;
        $this->assertEquals($expectedMonster,$createdMonster);
    }

    public function testMakeFaerie(){
        $createdMonster = MonsterFactory::createMonster('Faerie');
        $expectedMonster = new Faerie;
        $this->assertEquals($expectedMonster,$createdMonster);
    }

    public function testFailedCreation(){
        $createdMonster = MonsterFactory::createMonster('gualichardo');
        $expectedMonster = new NullMonster;
        $this->assertEquals($expectedMonster,$createdMonster);
    }
}