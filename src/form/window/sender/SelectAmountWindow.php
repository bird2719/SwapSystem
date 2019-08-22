<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\CustomForm;
use bird2719\SwapSystem\form\element\Label;
use bird2719\SwapSystem\form\element\Slider;
use bird2719\SwapSystem\swap\mail\Request;
use bird2719\SwapSystem\form\element\Input;

class SelectAmountWindow extends CustomForm{

    private $request;
    private $plugin;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        $items = $this->request->getItems();
        for($i = 0; $i < count($items); $i++){
            $items[$i]->setCount($data[$i + 1]);
        }

        $window = new SelectPlayerWindow($this->plugin, $player->getName(), $this->request);
        $this->request->setComment($data[count($data)-1]);
        $player->sendForm($window);
    }

    public function __construct(Request $request, Main $plugin){
        $this->request = $request;
        $this->plugin = $plugin;
        parent::__construct();
    }

    public function createForm() : void{
        $this->addContent(new Label("交換に差し出す個数をそれぞれの候補で選択してください。"));

        $items = $this->request->getItems();
        for($i = 0; $i  < count($items); $i++){
            $this->addContent(new Slider($items[$i]->getName(), 1 , $items[$i]->getCount()));
        }
        $this->addContent(new Input("【コメント自由欄】", "欲しいアイテムの要望等をここに記述しましょう。", ""));
    }
}