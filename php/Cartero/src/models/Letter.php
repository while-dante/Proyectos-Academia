<?php

namespace Models;

class Letter
{
    private $sender;
    private $recipient;
    private $content;

    public function __construct(string $sender, string $recipient, string $content){
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->content = $content;
    }

    public function getSender(){
        return $this->sender;
    }

    public function getRecipient(){
        return $this->recipient;
    }  

    public function getContent(){
        return $this->content;
    }
}