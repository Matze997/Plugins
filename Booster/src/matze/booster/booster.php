<?php

namespace matze\booster;

use jojoe77777\FormAPI\SimpleForm;
use matze\booster\Commands\BoosterCommand;
use matze\booster\Scheduler\BoosterTask;
use matze\booster\Scheduler\FlyBoosterTask;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class booster extends PluginBase implements Listener{

    public $b1 = false;
    public $b2 = false;
    public $b3 = false;
    public $b4 = false;
    public $b5 = false;
    public $bt1 = 901;
    public $bt2 = 901;
    public $bt3 = 901;
    public $bt4 = 901;
    public $bt5 = 901;
    public $target = [];

    function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("BOOSTER", new BoosterCommand($this));
        $this->b1 = false;
        $this->b2 = false;
        $this->b3 = false;
        $this->b4 = false;
        $this->b5 = false;
        $this->bt1 = 901;
        $this->bt2 = 901;
        $this->bt3 = 901;
        $this->bt4 = 901;
        $this->bt5 = 901;
        @mkdir($this->getDataFolder());
        if(!is_file($this->getDataFolder()."players.yml")){
            $playerf = new Config($this->getDataFolder()."players.yml", Config::YAML);
            $playerf->save();
        }
    }

    function openBoosterUI(Player $player){
        $form = new SimpleForm(function (Player $player, $data){
            if($data === null){
                return true;
            }
            if($data !== "close"){
                if($this->isActiveBooster($data) === false){
                    $this->target[$player->getName()] = $data;
                    $this->openConfirmUI($player);
                } else {
                    $player->sendMessage($this->getConfig()->get("Message-Booster-Already-Active"));
                }
            }
        });
        $form->setTitle($this->getConfig()->get("Form-Title"));
        $playerf = new Config($this->getDataFolder()."players.yml");
        $form->setContent(str_replace("%amount%", $playerf->get($player->getName()), $this->getConfig()->get("Form-Content1")));
        $form->addButton($this->getConfig()->get("Form-Button1"), 0, "textures/ui/dressing_room_capes", 1);
        $form->addButton($this->getConfig()->get("Form-Button2"), 0, "textures/gui/newgui/mob_effects/haste_effect", 2);
        $form->addButton($this->getConfig()->get("Form-Button3"), 0, "textures/gui/newgui/mob_effects/strength_effect", 3);
        $form->addButton($this->getConfig()->get("Form-Button4"), 0, "textures/ui/icon_best3", 4);
        $form->addButton($this->getConfig()->get("Form-Button5"), 0, "textures/ui/dust_selectable_3", 5);
        $form->addButton($this->getConfig()->get("Form-Button6"), 0, "textures/ui/realms_red_x", "close");
        $form->sendToPlayer($player);
        return $form;
    }

    function openConfirmUI(Player $player){
        $form = new SimpleForm(function (Player $player, $data){
            if($data === null){
                return true;
            }
            if($data === "ja"){
                $playerf = new Config($this->getDataFolder()."players.yml");
                if($playerf->get($player->getName()) > 0){
                    $this->activateBooster($this->target[$player->getName()]);
                    $this->removeBooster($player);
                    $booster = $this->getBoosterName($this->target[$player->getName()]);
                    $this->getServer()->broadcastMessage(str_replace(["%booster%", "%name%"], [$booster, $player->getName()], $this->getConfig()->get("Message-Broadcast-Booster-Started")));
                } else {
                    $player->sendMessage($this->getConfig()->get("Message-Not-Enough-Booster"));
                }
            }
        });
        $form->setTitle($this->getConfig()->get("Form-Title"));
        $form->setContent(str_replace("%target%", $this->getBoosterName($this->target[$player->getName()]), $this->getConfig()->get("Form-Content2")));
        $form->addButton($this->getConfig()->get("Form-Button7"), 0, "textures/ui/realms_green_check", "ja");
        $form->addButton($this->getConfig()->get("Form-Button8"), 0, "textures/ui/realms_red_x", "nein");
        $form->sendToPlayer($player);
        return $form;
    }

    function activateBooster($booster){
        switch ($booster){
            case "1":
                $this->b1 = true;
                $this->getScheduler()->scheduleDelayedTask(new BoosterTask($this, $booster), 1);
                break;
            case "2":
                $this->b2 = true;
                $this->getScheduler()->scheduleDelayedTask(new BoosterTask($this, $booster), 1);
                break;
            case "3":
                $this->b3 = true;
                $this->getScheduler()->scheduleDelayedTask(new BoosterTask($this, $booster), 1);
                break;
            case "4":
                $this->b4 = true;
                $this->getScheduler()->scheduleDelayedTask(new BoosterTask($this, $booster), 1);
                break;
            case "5":
                $this->b5 = true;
                $this->getScheduler()->scheduleDelayedTask(new BoosterTask($this, $booster), 1);
                break;
        }
    }

    function isActiveBooster($booster){
        if($booster === "1"){
            if($this->b1 === false){
                return false;
            }
        } elseif ($booster === "2"){
            if($this->b2 === false){
                return false;
            }
        } elseif ($booster === "3"){
            if($this->b3 === false){
                return false;
            }
        } elseif ($booster === "4"){
            if($this->b4 === false){
                return false;
            }
        } elseif ($booster === "5"){
            if($this->b5 === false){
                return false;
            }
        } else {
            return false;
        }
    }

    function getBoosterName($booster){
        if($booster === "1"){
            return $this->getConfig()->get("Booster1");
        } elseif ($booster === "2"){
            return $this->getConfig()->get("Booster2");
        } elseif ($booster === "3"){
            return $this->getConfig()->get("Booster3");
        } elseif ($booster === "4"){
            return $this->getConfig()->get("Booster4");
        } elseif ($booster === "5"){
            return $this->getConfig()->get("Booster5");
        }
    }

    function removeBooster(Player $player){
        $playerf = new Config($this->getDataFolder()."players.yml");
        $playerf->set($player->getName(), $playerf->get($player->getName())-1);
        $playerf->save();
    }
}