<?php

namespace bird2719\SwapSystem\form\window\receiver;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\ModalForm;
use bird2719\SwapSystem\swap\mail\Reply;
use pocketmine\utils\TextFormat;

class ConfirmReplyWindow extends ModalForm{

    private $plugin;
    private $reply;

    public function handleResponse(Player $player, $data): void{
        if($data){
            $replyHolder = $this->plugin->getHolderManager()->getReplyHolder($this->reply->getOwner());
            if($replyHolder != null){
                $replyHolder->add($this->reply);
                $owner = $this->plugin->getServer()->getPlayer($this->reply->getOwner());
            }else{
                $player->sendMessage(TextFormat::RED . $this->reply->getOwner() . "はサーバーにいなかったため返信できませんでした。");
                return;
            }
            $player->sendMessage(TextFormat::GREEN . "返信を行いました。");
            $owner->sendMessage(TextFormat::GREEN . $player->getName() . "から物々交換の返信がきました。  /swapを実行し、返信内容を確認してください。");
        }else{
            $player->sendMessage(TextFormat::RED . "返信作業を中断しました。");
        }
    }

    public function __construct(Main $plugin, Reply $reply){
        $this->plugin = $plugin;
        $this->reply = $reply;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("返信内容確認画面");
        $summary = $this->reply->getOwnerItem()->getName() . " " . $this->reply->getOwnerItem()->getCount() . "個を" . $this->reply->getOwner() ."から貰い、\n";
        foreach($this->reply->getReplierItems() as $item){
            $summary = $summary . $item->getName() . " " . $item->getCount() . "個, ";
        }
        $summary = $summary . "のうちのどれか一つを贈ります。";
        $this->setText($summary . "\n以上の内容で返信を行います。よろしいですか？\n\nこの返信に対して相手が承諾することで物々交換が成立します。");
        $this->setButton1("OK");
        $this->setButton2("キャンセル");
    }
}