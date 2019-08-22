<?php

namespace bird2719\SwapSystem\form\window;

use bird2719\SwapSystem\form\SimpleForm;
use pocketmine\Player;
use bird2719\SwapSystem\form\FormBase;

class MessageWindow extends SimpleForm{

    private $message;
    private $nextWindow;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;
        $player->sendForm($this->nextWindow);
    }

    public function __construct(string $message, FormBase $nextWindow){
        $this->message = $message;
        $this->nextWindow = $nextWindow;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("メッセージ画面");
        $this->setText($this->message);
        $this->addButton("戻る");
    }
}