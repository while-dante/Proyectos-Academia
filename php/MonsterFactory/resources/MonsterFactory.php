<?php

namespace Resource;

use Monster\Faerie;
use Monster\NullMonster;
use Monster\Vampire;
use Monster\Zombie;

class MonsterFactory{
    public static function createMonster(string $monsterName){

        switch($monsterName){
            case 'Zombie':

                return new Zombie();
            case 'Vampire':
                
                return new Vampire();
            case 'Faerie':

                return new Faerie();
            default:

                return new NullMonster();
        }
    }
}