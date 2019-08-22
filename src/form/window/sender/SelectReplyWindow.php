<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use bird2719\SwapSystem\form\window\MainWindow;

class SelectReplyWindow extends SimpleForm{

    private $plugin;
    private $playerName;
    private $replies;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        if($data < count($this->replies)){
            $window = new SelectOwnerGiftWindow($this->plugin, $this->replies[$data]);
            $player->sendForm($window);
        }else{
            $window = new MainWindow($this->plugin);
            $player->sendForm($window);
        }
    }

    public function __construct(Main $plugin, string $playerName){
        $this->plugin = $plugin;
        $this->playerName = $playerName;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("物々交換返信選択画面");
        $this->setText("送った申請に対する返信がここに溜まります。条件を承諾することで物々交換を完了できます。");

        $this->replies = $this->plugin->getHolderManager()->getReplyHolder($this->playerName)->getMails();
        for($i = 0; $i < count($this->replies); $i++){
            $this->addButton( "<" . $this->replies[$i]->getReplier() . "> からの返信");
        }

        $this->addButton("戻る");
    }
}