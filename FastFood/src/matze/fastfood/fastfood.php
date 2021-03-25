<?php

namespace matze\fastfood;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class fastfood extends PluginBase implements Listener{

    function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    }
}