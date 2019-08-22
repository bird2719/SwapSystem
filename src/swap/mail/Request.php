<?php

namespace bird2719\SwapSystem\swap\mail;

class Request extends Mail{

    private $owner;
    private $items;
    private $comment;

    public function __construct($items){
        $this->items = $items;
        $this->comment = "";
    }

    public function getItems() : array{
        return $this->items;
    }

    public function getComment() : string{
        return $this->comment;
    }

    public function setComment(string $comment) : void{
        $this->comment = $comment;
    }
}