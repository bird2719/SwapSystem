<?php

namespace bird2719\SwapSystem\swap\mail;

use pocketmine\item\Item;

class Reply extends Mail{

    private $replier;
    private $ownerItem;
    private $replierItems;

    public function __construct(){

    }

    public function getReplier() : string{
        return $this->replier;
    }

    public function setReplier(string $replier) : void{
        $this->replier = $replier;
    }

    public function getOwnerItem() : Item{
        return $this->ownerItem;
    }

    public function setOwnerItem(Item $ownerItem) : void{
        $this->ownerItem = $ownerItem;
    }

    public function getReplierItems() : array{
        return $this->replierItems;
    }

    public function setReplierItems(array $replierItems) : void{
        $this->replierItems = $replierItems;
    }
}