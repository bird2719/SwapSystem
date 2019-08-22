<?php

namespace bird2719\SwapSystem\form\element;

class StepSlider extends Element{

    private $text;
    private $steps;

    public function __construct(string $text = "", array $steps){
        $this->text = $text;
        $this->steps = $steps;
    }

    public function setText(string $text) : void{
        $this->text = $text;
    }

    public function setSteps(array $steps) : void{
        $this->steps = $steps;
    }

    public function getContent() : array{
        $data = [
            "type" => "step_slider",
            "text" => $this->text,
            "steps" => $this->steps
        ];
        return $data;
    }
}