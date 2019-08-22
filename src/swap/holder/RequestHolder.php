<?php

namespace bird2719\SwapSystem\swap\holder;

class RequestHolder extends MailHolder{

    public function deleteMailByPlayer(string $playerName) : void{

        for($i = 0; $i < count($this->mails); $i++){
            if($this->mails[$i]->getOwner() == $playerName){
                unset($this->mails[$i]);
            }
        }
        $this->mails = array_values($this->mails);
    }
}