<?php

namespace bird2719\SwapSystem\swap;

use bird2719\SwapSystem\swap\holder\ReplyHolder;
use bird2719\SwapSystem\swap\holder\RequestHolder;

class HolderManager{

    private $replyHolders;
    private $requestHolders;

    public function getReplyHolder(string $playerName) : ?ReplyHolder{
        return $this->replyHolders[$playerName] ?? null;
    }

    public function getRequestHolder(string $playerName) : ?RequestHolder{
        return $this->requestHolders[$playerName] ?? null;
    }

    public function registerMailHolder($playerName) : void{
        $this->replyHolders[$playerName] = new ReplyHolder();
        $this->requestHolders[$playerName] = new RequestHolder();
    }

    public function unregisterMailHolder($playerName) : void{
        unset($this->replyHolders[$playerName]);
        unset($this->requestHolders[$playerName]);

        foreach($this->replyHolders as $replyHolder){
            $replyHolder->deleteMailByPlayer($playerName);
        }

        foreach($this->requestHolders as $requestHolder){
            $requestHolder->deleteMailByPlayer($playerName);
        }
    }
}