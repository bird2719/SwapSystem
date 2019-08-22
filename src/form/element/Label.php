<?php

namespace bird2719\SwapSystem\form\element;

class Label extends Element{

    private $text;

    public function __construct(string $text = ""){
        $this->text = $text;
    }

    public function setText(string $text){
        $this->text = $text;
    }

    public function getContent() : array{
        $data = [
            "type" => "label",
            "text" => $this->text
        ];
        return $data;
    }
}