<?php

namespace bird2719\SwapSystem;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use bird2719\SwapSystem\form\window\MainWindow;
use bird2719\SwapSystem\swap\HolderManager;

class Main extends PluginBase{

    private $holderManager;

    public function onEnable(){
        $this->holderManager = new HolderManager();
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this->holderManager), $this);
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) : bool {
        switch($command){
            case "swap":
                if($sender instanceof Player){
                    $sender->sendForm(new MainWindow($this));
                }else{
                    $sender->sendMessage("ゲーム内で実行してください。");
                }
                break;
        }
        return true;
    }

    public function getHolderManager() : HolderManager{
        return $this->holderManager;
    }
}
