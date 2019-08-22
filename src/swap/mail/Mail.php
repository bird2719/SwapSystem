<?php

namespace bird2719\SwapSystem\swap\mail;

abstract class Mail {

    private $owner;
    private $isLikes;

    public function __construct(){

    }

    public function getOwner() : string{
        return $this->owner;
    }

    public function setOwner(string $owner) : void{
        $this->owner = $owner;
    }

    public function isLikes() : bool{
        return $this->isLikes;
    }

    public function setIsLikes($isLikes) : void{
        $this->isLikes = $isLikes;
    }
}