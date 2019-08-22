<?php

namespace bird2719\SwapSystem\form;

abstract class ModalForm extends FormBase {

    public function __construct() {
        $this->datas["type"] = "modal";
        $this->datas["title"] = "";
        $this->datas["content"] = "";
        $this->datas["button1"] = "";
        $this->datas["button2"] = "";
        $this->createForm();
    }

    public function setTitle(string $title) : void {
        $this->datas["title"] = $title;
    }

    public function setText(string $text) : void {
        $this->datas["content"] = $text;
    }

    public function setButton1(string $text) : void {
        $this->datas["button1"] = $text;
    }

    public function setButton2(string $text) : void {
        $this->datas["button2"] = $text;
    }
}