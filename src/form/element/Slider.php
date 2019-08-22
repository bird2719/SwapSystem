<?php

namespace bird2719\SwapSystem\form\element;

class Slider extends Element{

    private $text;
    private $min;
    private $max;

    public function __construct(string $text = "", int $min = 0, int $max = 1){
        $this->text = $text;
        $this->min = $min;
        $this->max = $max;
    }

    public function setText(string $text) : void{
        $this->text = $text;
    }

    public function setMin(int $min) : void{
        $this->min = $min;
    }

    public function setMax(int $max) : void{
        $this->max = $max;
    }

    public function getContent() : array{
        $data = [
            "type" => "slider",
            "text" => $this->text,
            "min" => $this->min,
            "max" => $this->max
        ];
        return $data;
    }
}