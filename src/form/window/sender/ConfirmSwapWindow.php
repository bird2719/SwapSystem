<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\ModalForm;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use bird2719\SwapSystem\swap\mail\Reply;

class ConfirmSwapWindow extends ModalForm{

    private $plugin;
    private $reply;
    private $item;

    public function handleResponse(Player $player, $data): void{
        if($data){
            $replier = $this->plugin->getServer()->getPlayer($this->reply->getReplier());
            if($replier === null){
                $player->sendMessage(TextFormat::RED . "取引相手がサーバーにいなかったため、物々交換を中断しました。");
                return;
            }
            if($player->getInventory()->contains($this->reply->getOwnerItem())){
                if($replier->getInventory()->contains($this->item)){
                    if($player->getInventory()->canAddItem($this->item)){
                        if($replier->getInventory()->canAddItem($this->reply->getOwnerItem())){

                            $player->getInventory()->remove($this->reply->getOwnerItem());
                            $replier->getInventory()->remove($this->item);
                            $player->getInventory()->addItem($this->item);
                            $replier->getInventory()->addItem($this->reply->getOwnerItem());

                            $replier->sendMessage(TextFormat::GREEN . $player->getName() . "との物々交換が成立しました。");
                            $player->sendMessage(TextFormat::GREEN . $this->reply->getReplier() . "との物々交換が成立しました。");

                        }else{
                            $player->sendMessage(TextFormat::RED . "取引アイテムを受けとる相手の空きインベントリが足りていないため物々交換を中断しました。");
                            $replier->sendMessage(TextFormat::RED . $player->getName() . "との取引を実行しようとしましたが、取引アイテムを受けとるあなたの空きインベントリが足りていないため物々交換を中断しました。");
                        }
                    }else{
                        $player->sendMessage(TextFormat::RED . "取引アイテムを受けとるあなたの空きインベントリが足りていないため物々交換を中断しました。");
                    }
                }else{
                    $player->sendMessage(TextFormat::RED . "取引相手の手持ちに取引するアイテムがなかったため物々交換を中断しました。");
                    $replier->sendMessage(TextFormat::RED . $player->getName() . "との取引を実行しようとしましたが、あなたが取引アイテムを所持していないため物々交換を中断しました。");
                }
            }else{
                $player->sendMessage(TextFormat::RED . "取引するアイテムが手持ちになかったため物々交換を中断しました。");
            }
        }else{
            $player->sendMessage(TextFormat::RED . "物々交換を中断しました。");
        }
    }

    public function __construct(Main $plugin,  Reply $reply, Item $item){
        $this->plugin = $plugin;
        $this->reply = $reply;
        $this->item = $item;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("申請内容確認画面");
        $summary = $this->reply->getOwnerItem()->getName() . " " . $this->reply->getOwnerItem()->getCount() . "個を" . $this->reply->getReplier() . "に贈り、" . $this->item->getName() . " " . $this->item->getCount() . "個を貰います。\n";

        $this->setText($summary . "以上の内容の物々交換を行うことに承諾します。よろしいですか？");
        $this->setButton1("OK");
        $this->setButton2("キャンセル");
    }
}