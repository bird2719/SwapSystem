<?php

namespace bird2719\SwapSystem\form\element;

abstract class Element {

    public function __construct(){

    }

    public abstract function getContent() : array;
}