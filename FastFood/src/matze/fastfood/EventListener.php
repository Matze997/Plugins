<?php

namespace matze\fastfood;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class EventListener implements Listener{

    private $plugin;

    function __construct(fastfood $plugin){
        $this->plugin = $plugin;
    }

    function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $item = $event->getItem()->getId();
        $i = $event->getItem();
        if($player->getFood() < 20){
            if($item === 364){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 320){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 366){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 266){
                if($player->getFood() + 4 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 4);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 396){
                if($player->getFood() + 6 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 6);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 391){
                if($player->getFood() + 3 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 3);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 457){
                if($player->getFood() + 2 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 2);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 360){
                if($player->getFood() + 2 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 2);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 424){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 412){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 463){
                if($player->getFood() + 4 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 4);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 297){
                if($player->getFood() + 4 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 4);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 282){
                if($player->getFood() + 6 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 6);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 413){
                if($player->getFood() + 8 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 8);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 393){
                if($player->getFood() + 5 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 5);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 350){
                if($player->getFood() + 4 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 4);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 400){
                if($player->getFood() + 5 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 5);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);

            } elseif ($item === 464){
                if($player->getFood() + 2 >= 20){
                    $player->setFood(20);
                } else {
                    $player->setFood($player->getFood() + 2);
                }
                $i->setCount($i->getCount() - 1);
                $player->getInventory()->setItemInHand($i);
            }
        }
    }
}