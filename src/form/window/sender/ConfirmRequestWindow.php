<?php

namespace bird2719\SwapSystem\form\window\sender;

use pocketmine\Player;
use bird2719\SwapSystem\Main;
use bird2719\SwapSystem\form\ModalForm;
use bird2719\SwapSystem\swap\mail\Request;
use pocketmine\utils\TextFormat;

class ConfirmRequestWindow extends ModalForm{

    private $plugin;
    private $selectPlayers;
    private $request;

    public function handleResponse(Player $player, $data): void{
        if($data){
            $player->sendMessage(TextFormat::GREEN . "申請を行いました。");
            foreach($this->selectPlayers as $selectPlayer){
                $requestHolder = $this->plugin->getHolderManager()->getRequestHolder($selectPlayer->getName());
                if($requestHolder != null){
                    $requestHolder->add($this->request);
                    $selectPlayer->sendMessage(TextFormat::GREEN . $player->getName() . "から物々交換の申請がきました。  /swapを実行し、提案内容を確認してください。");
                }else{
                    $player->sendMessage(TextFormat::RED . $selectPlayer->getName() . "がサーバーにいなかったため、物々交換を中断しました。");
                }
            }
        }else{
            $player->sendMessage(TextFormat::RED . "申請作業を中断しました。");
        }
    }

    public function __construct(Main $plugin, array $selectPlayers, Request $request){
        $this->plugin = $plugin;
        $this->selectPlayers = $selectPlayers;
        $this->request = $request;
        parent::__construct();
    }

    public function createForm() : void{
        $this->setTitle("申請内容確認画面");
        $summary = "相手に贈るアイテムは\n";
        foreach($this->request->getItems() as $item){
            $summary = $summary . $item->getName() . "を" . $item->getCount() ."個,\n";
        }
        $summary = $summary . "のどれか一つで、貰うアイテムに関する要望コメントは\n「" . $this->request->getComment() . "」です。";

        $this->setText($summary . "\n以上の内容の申請を行います。よろしいですか？\n\nこの申請に対して誰かからの返信があっても自動的に物々交換がされることはありません。\nあなたが返信を承諾することで物々交換が成立します。\n返信は/swapからご確認ください。");
        $this->setButton1("OK");
        $this->setButton2("キャンセル");
    }
}