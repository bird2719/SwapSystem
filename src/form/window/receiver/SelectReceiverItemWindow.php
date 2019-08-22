<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\CustomForm;
use bird2719\SwapSystem\swap\mail\Reply;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\form\element\Label;
use bird2719\SwapSystem\form\element\Toggle;
use bird2719\SwapSystem\form\window\MessageWindow;
use pocketmine\utils\TextFormat;

class SelectReceiverItemWindow extends CustomForm{

    private $items;
    private $reply;
    private $request;
    private $player;
    private $plugin;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        $items = array();
        for($i = 0; $i < count($this->items); $i++){
            if($data[$i + 1]){
                $items[] = $this->items[$i];
            }
        }

        if(0 < count($items)){
            $this->reply->setReplierItems($items);
            $window = new SelectReceiverAmountWindow($this->plugin, $this->reply);
            $player->sendForm($window);
        }else{
            $message = "\n" . TextFormat::RED . "交換候補アイテムは１種以上選ぶ必要があります。\n\n";
            $nextWindow = new SelectReceiverItemWindow($this->plugin, $this->reply, $this->request, $player);
            $window = new MessageWindow($message, $nextWindow);
            $player->sendForm($window);
        }
    }

    public function __construct(Main $plugin, Reply $reply, Request $request, Player $player){
        $this->plugin = $plugin;
        $this->reply = $reply;
        $this->request = $request;
        $this->player = $player;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換アイテム選択画面");
        $this->addContent(new Label("物々交換で相手に贈るアイテム候補を選択してください。\n複数のアイテムを指定することで交換するアイテムの選択肢を相手に与えることができます。\n\n※複数選択しても実際に渡すアイテムは１種類だけです。安心してね！"));

        $items = array();
        for($i = 0; $i < 36; $i++){
            if(array_key_exists($i, $this->player->getInventory()->getContents())){
                $inventoryItem = $this->player->getInventory()->getContents()[$i];
                $isDuplicated = false;
                foreach($items as $item){
                    if($item->getId() == $inventoryItem->getId() && $item->getDamage() == $inventoryItem->getDamage()){
                        $item->setCount($item->getCount() + $inventoryItem->getCount());
                        $isDuplicated = true;
                    }
                }
                if($i < 9){
                    if(!$isDuplicated){
                        $items[$i] = clone $inventoryItem;
                    }
                }
            }
        }

        for($i = 0; $i < 9; $i++){
            if(array_key_exists($i, $items)){
                if($i == $this->player->getInventory()->getHeldItemIndex()){
                    $this->addContent(new Toggle($items[$i]->getName() . "  (スロット" . ($i + 1) . ", 現在手に持っているアイテム)"));
                }else{
                    $this->addContent(new Toggle($items[$i]->getName() . "  (スロット" . ($i + 1) . ")"));
                }
                $this->items[] = $items[$i];
            }
        }
    }
}