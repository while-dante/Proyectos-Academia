<?php

namespace Interfaces;

use Models\Letter;

interface Reciever
{
    public function save(Letter $letter) : Bool;
}