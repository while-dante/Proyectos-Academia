<?php

namespace Interfaces;

interface Server{

    public function call();
    public function getName();
}

//CODIGO:
/* 
200 -> ok
300 -> redirect
400 -> not found
500 -> error
0 -> fallen
*/