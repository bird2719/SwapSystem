<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\swap\mail\Reply;

class SelectGiftWindow extends SimpleForm{

    private $plugin;
    private $request;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        if($data < count($this->request->getItems())){
            $reply = new Reply();
            $reply->setOwner($this->request->getOwner());
            $reply->setOwnerItem($this->request->getItems()[$data]);
            $reply->setReplier($player->getName());
            $window = new SelectReceiverItemWindow($this->plugin, $reply, $this->request, $player);
            $player->sendForm($window);
        }else{
            $window = new SelectRequestWindow($this->plugin, $player->getName());
            $player->sendForm($window);
        }
    }

    public function __construct(Main $plugin, Request $request){
        $this->plugin = $plugin;
        $this->request = $request;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換アイテム選択画面");
        $this->setText("物々交換で貰うアイテムを選択して下さい。");

        for($i = 0; $i < count($this->request->getItems()); $i++){
            $this->addButton($this->request->getItems()[$i]->getName() . " × " . $this->request->getItems()[$i]->getCount() . "個");
        }

        $this->addButton("戻る");
    }
}