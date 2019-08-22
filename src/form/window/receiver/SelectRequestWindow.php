<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\SimpleForm;
use bird2719\SwapSystem\form\window\MainWindow;

class SelectRequestWindow extends SimpleForm{

    private $plugin;
    private $playerName;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;

        $mails = $this->plugin->getHolderManager()->getRequestHolder($this->playerName)->getMails();
        if($data < count($mails)){
            $window = new SelectGiftWindow($this->plugin, $mails[$data]);
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
        $this->setTitle("物々交換リクエスト選択画面");
        $this->setText("送られてきたリクエストがここに溜まります。リクエストを選択して物々交換を進めてください。");

        $mails = $this->plugin->getHolderManager()->getRequestHolder($this->playerName)->getMails();
        for($i = 0; $i < count($mails); $i++){
            $this->addButton( "<" . $mails[$i]->getOwner() . "> " . $mails[$i]->getComment());
        }

        $this->addButton("戻る");
    }
}