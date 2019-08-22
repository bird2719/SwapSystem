<?php

namespace bird2719\SwapSystem\form;

use pocketmine\form\Form;

abstract class FormBase implements Form{

    protected $datas;

    public abstract function createForm() : void;

    public function jsonSerialize(){
        return $this->datas;
    }
}