<?php

namespace Interfaces;

interface Controler{
    function get($get,$post,&$session);
    function post($get,$post,&$session);
}

?>
