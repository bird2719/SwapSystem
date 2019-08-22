<?php

namespace bird2719\SwapSystem\form\element;

class Toggle extends Element{

    private $text;

    public function __construct(string $text = ""){
        $this->text = $text;
    }

    public function setText(string $text) : void{
        $this->text = $text;
    }

    public function getContent() : array{
        $data = [
            "type" => "toggle",
            "text" => $this->text
        ];
        return $data;
    }
}