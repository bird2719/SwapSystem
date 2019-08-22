<?php

namespace bird2719\SwapSystem\form\window;

use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use pocketmine\Player;
use bird2719\SwapSystem\form\window\sender\SelectItemWindow;
use bird2719\SwapSystem\form\window\receiver\SelectRequestWindow;
use bird2719\SwapSystem\form\window\sender\SelectReplyWindow;

class MainWindow extends SimpleForm{

    private $plugin;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;
        switch($data){
            case 0:
                $window = new SelectItemWindow($player, $this->plugin);
                $player->sendForm($window);
                break;
            case 1:
                $window = new SelectRequestWindow($this->plugin, $player->getName());
                $player->sendForm($window);
                break;
            case 2:
                $window = new SelectReplyWindow($this->plugin, $player->getName());
                $player->sendForm($window);
                break;
            case 3:
                break;
        }
    }

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換メイン画面");
        $this->setText("確認したい事項を選択してください");
        $this->addButton("物々交換を提案");
        $this->addButton("提案された物々交換");
        $this->addButton("返信のあった提案");
        $this->addButton("閉じる");
    }
}