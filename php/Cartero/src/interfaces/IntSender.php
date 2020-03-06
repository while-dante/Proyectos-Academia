<?php

namespace Interfaces;

use Models\Letter;

interface Sender
{
    public function send(): Letter;
}