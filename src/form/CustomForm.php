<?php

namespace bird2719\SwapSystem\form;

use bird2719\SwapSystem\form\element\Element;

abstract class CustomForm extends FormBase {

    public function __construct() {
        $this->datas["type"] = "custom_form";
        $this->datas["title"] = "";
        $this->datas["content"] = [];
        $this->createForm();
    }

    public function setTitle(string $title) : void {
        $this->datas["title"] = $title;
    }

    public function addContent(Element $element) {
        $this->datas["content"][] = $element->getContent();
    }
}