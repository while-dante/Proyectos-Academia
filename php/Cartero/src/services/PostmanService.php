<?php

namespace Services;

use Interfaces\Sender;
use Models\Letter;

class PostmanService implements  Sender
{
    private $letter;

    public function __construct(Letter $letter){
        $this->letter = $letter;
    }

    public function send(){
        return $this->letter;
    }
}