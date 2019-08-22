<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\swap\mail\Reply;

class SelectOwnerGiftWindow extends SimpleForm{

    private $plugin;
    private $reply;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        if($data < count($this->reply->getReplierItems())){
            $window = new ConfirmSwapWindow($this->plugin, $this->reply, $this->reply->getReplierItems()[$data]);
            $player->sendForm($window);
        }else{
            $window = new SelectReplyWindow($this->plugin, $player->getName());
            $player->sendForm($window);
        }
    }

    public function __construct(Main $plugin, Reply $reply){
        $this->plugin = $plugin;
        $this->reply = $reply;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換アイテム選択画面");
        $this->setText("物々交換で貰うアイテムを選択して下さい。");

        for($i = 0; $i < count($this->reply->getReplierItems()); $i++){
            $this->addButton($this->reply->getReplierItems()[$i]->getName() . " × " . $this->reply->getReplierItems()[$i]->getCount() . "個");
        }

        $this->addButton("戻る");
    }
}