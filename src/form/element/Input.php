<?php

namespace bird2719\SwapSystem\form\element;

class Input extends Element{

    private $text;
    private $placeholder;
    private $default;

    public function __construct(string $text = "", string $placeholder = "", string $default = ""){
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->default = $default;
    }

    public function setText(string $text) : void{
        $this->text = $text;
    }

    public function setPlaceholder(string $placeholder) : void{
        $this->placeholder = $placeholder;
    }

    public function setDefault(string $default) : void{
        $this->default = $default;
    }

    public function getContent() : array{
        $data = [
            "type" => "input",
            "text" => $this->text,
            "placeholder" => $this->placeholder,
            "default" => $this->default
        ];
        return $data;
    }
}