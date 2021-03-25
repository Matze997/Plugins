<?php

namespace matze\booster;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerExperienceChangeEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\utils\Config;

class EventListener implements Listener{

    private $plugin;

    function __construct(booster $plugin){
        $this->plugin = $plugin;
    }

    function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $player->getName();
        $playerf = new Config($this->plugin->getDataFolder()."players.yml", Config::YAML);
        if(!$playerf->exists($name)){
            $playerf->set($name, 0);
            $playerf->save();
        }
        $this->plugin->target[$name] = [];
    }

    function onXPChange(PlayerExperienceChangeEvent $event){
        $player = $event->getEntity();
        if($player instanceof Player){
            if($this->plugin->b5 === true){
                $zahl = [1, 1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8];
                $event->setNewLevel($event->getOldLevel() + $event->getNewProgress()*$zahl[mt_rand(0, 8)]);
            }
        }
    }

    function onBreak(BlockBreakEvent $event){
        $player = $event->getPlayer();
        if($this->plugin->b4 === true){
            if(in_array($event->getBlock()->getId(), [16, 21, 56, 73, 129, 74, 153])){
                $zahl = mt_rand(1, 6);
                if($zahl <= 2){
                    $drop = $event->getDrops();
                    $event->setDrops($drop);
                } elseif ($zahl <= 5){
                    $drops = $event->getDrops();
                    $drop = array_merge($drops, $drops);
                    $event->setDrops($drop);
                } elseif ($zahl === 6){
                    $drops = $event->getDrops();
                    $drop = array_merge($drops, $drops, $drops);
                    $event->setDrops($drop);
                }
            } elseif (in_array($event->getBlock()->getId(), [14, 15])){
                $zahl = mt_rand(1, 6);
                if($zahl <= 2){
                    foreach ($event->getDrops() as $drop){
                        if($event->getBlock()->getId() === 15){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(Item::IRON_INGOT));
                            $event->setDrops([]);
                        } elseif ($event->getBlock()->getId() === 14){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(Item::GOLD_INGOT));
                            $event->setDrops([]);
                        }
                    }
                } elseif ($zahl <= 5){
                    foreach ($event->getDrops() as $drop){
                        if($event->getBlock()->getId() === 15){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(265));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(265));
                            $event->setDrops([]);
                        } elseif ($event->getBlock()->getId() === 14){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(266));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(266));
                            $event->setDrops([]);
                        }
                    }
                } elseif ($zahl === 6){
                    foreach ($event->getDrops() as $drop){
                        if($event->getBlock()->getId() === 15){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(265));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(265));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(265));
                            $event->setDrops([]);
                        } elseif ($event->getBlock()->getId() === 14){
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(266));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(266));
                            $event->getBlock()->getLevel()->dropItem(new Vector3($event->getBlock()->x, $event->getBlock()->y, $event->getBlock()->z), new Item(266));
                            $event->setDrops([]);
                        }
                    }
                }
            }
        }
    }
}