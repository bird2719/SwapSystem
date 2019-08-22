<?php

namespace bird2719\SwapSystem\form\element;

class Dropdown extends Element{

    private $text;
    private $options;
    private $default;

    public function __construct(string $text = "", array $options, int $default = null){
        $this->text = $text;
        $this->options = $options;
        $this->default = $default;
    }

    public function setText(string $text) : void{
        $this->text = $text;
    }

    public function setOptions(array $options) : void{
        $this->options = $options;
    }

    public function setDefault(int $default) : void{
        $this->default = $default;
    }

    public function getContent() : array{
        $data = [
            "type" => "dropdown",
            "text" => $this->text,
            "options" => $this->options,
            "default" => $this->default
        ];
        return $data;
    }
}