<?php

namespace matze\booster\Scheduler;

use matze\booster\booster;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\scheduler\Task;

class BoosterTask extends Task{

    private $plugin;
    private $booster;

    function __construct(booster $plugin, $booster){
        $this->plugin = $plugin;
        $this->booster = $booster;
    }

    function onRun($tick){
        switch ($this->booster) {
            case "1":
                if($this->plugin->bt1 == 901){
                    $this->plugin->bt1 = 900;
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20);
                } elseif ($this->plugin->bt1 === 0){
                    $this->plugin->b1 = false;
                    $this->plugin->bt1 = 901;
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $this->plugin->getServer()->broadcastMessage(str_replace("%booster%", $booster, $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ended")));
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $player->setAllowFlight(false);
                        $player->setFlying(false);
                    }
                } elseif ($this->plugin->bt1 > 0) {
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20); //Todo: Slow down Delay
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $minutes = $this->plugin->getConfig()->get("Message-Minutes");
                    $this->plugin->bt1--;
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $player->setAllowFlight(true);
                    }
                    if (in_array($this->plugin->bt1, $minutes)) {
                        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                            $player->sendMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt1 / 60], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Minutes")));
                        }
                    } elseif (in_array($this->plugin->bt1, $this->plugin->getConfig()->get("Message-Seconds"))) {
                        if ($this->plugin->bt1 === 1) {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt1], $this->plugin->getConfig()->get("Message-Broadcast-Booster-LastSecond")));
                        } else {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt1], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Seconds")));
                        }
                    }
                }
                break;


            case "2":
                if($this->plugin->bt2 == 901){
                    $this->plugin->bt2 = 900;
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20);
                } elseif ($this->plugin->bt2 === 0){
                    $this->plugin->b2 = false;
                    $this->plugin->bt2 = 901;
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $player->removeEffect(Effect::HASTE);
                    }
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $this->plugin->getServer()->broadcastMessage(str_replace("%booster%", $booster, $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ended")));
                } elseif ($this->plugin->bt2 > 0) {
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20); //Todo: Slow down Delay
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $minutes = $this->plugin->getConfig()->get("Message-Minutes");
                    $this->plugin->bt2--;
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $haste = new EffectInstance(Effect::getEffect(Effect::HASTE), 1000, 4, false);
                        $player->addEffect($haste);
                    }
                    if (in_array($this->plugin->bt2, $minutes)) {
                        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                            $player->sendMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt2 / 60], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Minutes")));
                        }
                    } elseif (in_array($this->plugin->bt2, $this->plugin->getConfig()->get("Message-Seconds"))) {
                        if ($this->plugin->bt2 === 1) {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt2], $this->plugin->getConfig()->get("Message-Broadcast-Booster-LastSecond")));
                        } else {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt2], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Seconds")));
                        }
                    }
                }
                break;


            case "3":
                if($this->plugin->bt3 == 901){
                    $this->plugin->bt3 = 900;
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20);
                } elseif ($this->plugin->bt3 === 0){
                    $this->plugin->b3 = false;
                    $this->plugin->bt3 = 901;
                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $player->removeEffect(Effect::STRENGTH);
                    }
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $this->plugin->getServer()->broadcastMessage(str_replace("%booster%", $booster, $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ended")));
                } elseif ($this->plugin->bt3 > 0) {
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20); //Todo: Slow down Delay
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $minutes = $this->plugin->getConfig()->get("Message-Minutes");
                    $this->plugin->bt3--;

                    foreach ($this->plugin->getServer()->getOnlinePlayers() as $player){
                        $haste = new EffectInstance(Effect::getEffect(Effect::STRENGTH), 1000, 2, false);
                        $player->addEffect($haste);
                    }
                    if (in_array($this->plugin->bt3, $minutes)) {
                        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                            $player->sendMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt3 / 60], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Minutes")));
                        }
                    } elseif (in_array($this->plugin->bt3, $this->plugin->getConfig()->get("Message-Seconds"))) {
                        if ($this->plugin->bt3 === 1) {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt3], $this->plugin->getConfig()->get("Message-Broadcast-Booster-LastSecond")));
                        } else {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt3], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Seconds")));
                        }
                    }
                }
                break;


            case "4":
                if($this->plugin->bt4 == 901){
                    $this->plugin->bt4 = 900;
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20);
                } elseif ($this->plugin->bt4 === 0){
                    $this->plugin->b4 = false;
                    $this->plugin->bt4 = 901;
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $this->plugin->getServer()->broadcastMessage(str_replace("%booster%", $booster, $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ended")));
                } elseif ($this->plugin->bt4 > 0) {
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20); //Todo: Slow down Delay
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $minutes = $this->plugin->getConfig()->get("Message-Minutes");
                    $this->plugin->bt4--;
                    if (in_array($this->plugin->bt4, $minutes)) {
                        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                            $player->sendMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt4 / 60], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Minutes")));
                        }
                    } elseif (in_array($this->plugin->bt4, $this->plugin->getConfig()->get("Message-Seconds"))) {
                        if ($this->plugin->bt4 === 1) {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt4], $this->plugin->getConfig()->get("Message-Broadcast-Booster-LastSecond")));
                        } else {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt4], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Seconds")));
                        }
                    }
                }
                break;


            case "5":
                if($this->plugin->bt5 == 901){
                    $this->plugin->bt5 = 900;
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20);
                } elseif ($this->plugin->bt5 === 0){
                    $this->plugin->b5 = false;
                    $this->plugin->bt5 = 901;
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $this->plugin->getServer()->broadcastMessage(str_replace("%booster%", $booster, $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ended")));
                } elseif ($this->plugin->bt5 > 0) {
                    $this->plugin->getScheduler()->scheduleDelayedTask(new BoosterTask($this->plugin, $this->booster), 20); //Todo: Slow down Delay
                    $booster = $this->plugin->getBoosterName($this->booster);
                    $minutes = $this->plugin->getConfig()->get("Message-Minutes");
                    $this->plugin->bt5--;
                    if (in_array($this->plugin->bt5, $minutes)) {
                        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
                            $player->sendMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt5 / 60], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Minutes")));
                        }
                    } elseif (in_array($this->plugin->bt5, $this->plugin->getConfig()->get("Message-Seconds"))) {
                        if ($this->plugin->bt5 === 1) {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt5], $this->plugin->getConfig()->get("Message-Broadcast-Booster-LastSecond")));
                        } else {
                            $this->plugin->getServer()->broadcastMessage(str_replace(["%booster%", "%time%"], [$booster, $this->plugin->bt5], $this->plugin->getConfig()->get("Message-Broadcast-Booster-Ends-Seconds")));
                        }
                    }
                    break;
                }
        }
    }
}