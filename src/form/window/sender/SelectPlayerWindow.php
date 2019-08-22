<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\CustomForm;
use bird2719\SwapSystem\form\element\Label;
use bird2719\SwapSystem\form\element\Toggle;
use bird2719\SwapSystem\swap\mail\Request;

class SelectPlayerWindow extends CustomForm{

    private $plugin;
    private $playerName;
    private $playerNames;
    private $request;

    public function handleResponse(Player $player, $data): void{
        if($data === null) return;
        $selectPlayers = array();
        for($i = 1; $i < count($data); $i++){
            if($data[$i]){
                $selectPlayers[] = $this->players[$i - 1];
            }
        }
        $window = new ConfirmRequestWindow($this->plugin, $selectPlayers, $this->request);
        $player->sendForm($window);
    }

    public function __construct(Main $plugin, string $playerName, Request $request){
        $this->plugin = $plugin;
        $this->playerName = $playerName;
        $this->request = $request;
        parent::__construct();
    }

    public function createForm() : void{
        $this->addContent(new Label("交換提案を送る相手を選択してください。"));

        $this->players= array();
        foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
            if($player->getName() != $this->playerName){
                $this->players[] = $player;
            }
        }

        for($i = 0; $i < count($this->players); $i++){
            $this->addContent(new Toggle($this->players[$i]->getName()));
        }

    }
}