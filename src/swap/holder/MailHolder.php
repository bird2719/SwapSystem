<?php

namespace bird2719\SwapSystem\swap\holder;

use bird2719\SwapSystem\swap\mail\Mail;

abstract class MailHolder {

    const MAIL_COUNT_MAX = 10;
    protected $mails;

    public function __construct(){
        $this->mails = array();
    }

    public function add(Mail $mail) : void{
        $this->mails[] = $mail;

        if(count($this->mails) > self::MAIL_COUNT_MAX){
            for($i = 0; $i < count($this->mails); $i++){
                if(!$this->mails[$i]->isLikes()){
                    unset($this->mails[$i]);
                    break;
                }
            }
        }
        $this->mails = array_values($this->mails);
    }

    public function delete($index) : void{
        unset($this->mails[$index]);
        $this->mails = array_values($this->mails[$index]);
    }

    public abstract function deleteMailByPlayer(string $playerName) : void;

    public function getMails() : array{
        return $this->mails;
    }
}