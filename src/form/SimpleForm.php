<?php

namespace bird2719\SwapSystem\form;

abstract class SimpleForm extends FormBase {

    public function __construct() {
        $this->datas["type"] = "form";
        $this->datas["title"] = "";
        $this->datas["content"] = "";
        $this->datas["buttons"] = [];
        $this->createForm();
    }

    public function setTitle(string $title) : void{
        $this->datas["title"] = $title;
    }

    public function setText(string $text) : void{
        $this->datas["content"] = $text;
    }

    public function addButton(string $text) : void {
        $this->datas["buttons"][] = ["text" => $text];
    }
}