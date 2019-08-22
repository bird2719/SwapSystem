<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\CustomForm;
use bird2719\SwapSystem\form\element\Label;
use bird2719\SwapSystem\form\element\Slider;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\form\element\Input;
use bird2719\SwapSystem\swap\mail\Reply;

class SelectReceiverAmountWindow extends CustomForm{

    private $reply;
    private $plugin;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        $items = $this->reply->getReplierItems();
        for($i = 0; $i < count($items); $i++){
            $items[$i]->setCount($data[$i + 1]);
        }

        $window = new ConfirmReplyWindow($this->plugin, $this->reply);
        $player->sendForm($window);
    }

    public function __construct(Main $plugin, Reply $reply){
        $this->reply = $reply;
        $this->plugin = $plugin;
        parent::__construct();
    }

    public function createForm() : void{
        $this->addContent(new Label("交換に差し出す個数をそれぞれの候補で選択してください。"));

        $items = $this->reply->getReplierItems();
        for($i = 0; $i  < count($items); $i++){
            $this->addContent(new Slider($items[$i]->getName(), 1 , $items[$i]->getCount()));
        }
    }
}