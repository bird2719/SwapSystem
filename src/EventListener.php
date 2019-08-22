<?php

namespace  bird2719\SwapSystem;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerGameModeChangeEvent;
use bird2719\SwapSystem\form\window\MainWindow;
use bird2719\SwapSystem\form\window\sender\SelectAmountWindow;
use bird2719\SwapSystem\form\window\sender\ConfirmRequestWindow;
use pocketmine\event\player\PlayerLoginEvent;
use bird2719\SwapSystem\swap\HolderManager;
use pocketmine\event\player\PlayerQuitEvent;

class EventListener implements Listener{

    private $holderManager;

    public function __construct(HolderManager $holderManager){
        $this->holderManager = $holderManager;
    }

    public function onLogin(PlayerLoginEvent $event){
        $this->holderManager->registerMailHolder($event->getPlayer()->getName());
    }

    public function onQuit(PlayerQuitEvent $event){
        $this->holderManager->unregisterMailHolder($event->getPlayer()->getName());
    }
}