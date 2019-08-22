<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\swap\mail\Reply;

class SelectReceiverItemWindow2 extends SimpleForm{

    private $plugin;
    private $reply;
    private $request;
    private $items;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        if($data < count($this->items)){
            $this->reply->setReplierItem($this->items[$data]);
            $window = new SelectReceiverAmountWindow($this->plugin, $this->reply);
            $player->sendForm($window);
        }else{
            $window = new SelectGiftWindow($this->plugin, $this->request);
            $player->sendForm($window);
        }
    }

    public function __construct(Main $plugin, Reply $reply, Request $request, Player $player){
        $this->plugin = $plugin;
        $this->reply = $reply;
        $this->request = $request;
        $this->items = $player->getInventory()->getContents();
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換アイテム選択画面");
        $this->setText("交換に差し出すアイテムを選択してください");

        $this->addButton($this->items[$i]->getName());

        $this->addButton("戻る");
    }
}