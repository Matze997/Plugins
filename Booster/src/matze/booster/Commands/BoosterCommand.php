<?php

namespace matze\booster\Commands;

use matze\booster\booster;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;

class BoosterCommand extends Command{

    private $plugin;

    function __construct(booster $plugin){
        $this->plugin = $plugin;
        $config = $this->plugin->getConfig();
        parent::__construct($config->get("Command"), $config->get("Description"), $config->get("Usage"), $config->get("Aliases"));
    }

    function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            if(isset($args[0])){
                if($args[0] === "list"){
                    $sender->sendMessage("§fDiese §l§bBooster §r§fsind gerade aktiviert:");
                    if($this->plugin->b1 === true){
                        $sender->sendMessage("§6Fly Booster: §aan");
                    } else {
                        $sender->sendMessage("§6Fly Booster: §caus");
                    }
                    if($this->plugin->b2 === true){
                        $sender->sendMessage("§6Break Booster: §aan");
                    } else {
                        $sender->sendMessage("§6Break Booster: §caus");
                    }
                    if($this->plugin->b3 === true){
                        $sender->sendMessage("§6Stärke Booster: §aan");
                    } else {
                        $sender->sendMessage("§6Stärke Booster: §caus");
                    }
                    if($this->plugin->b4 === true){
                        $sender->sendMessage("§6Drop Booster: §aan");
                    } else {
                        $sender->sendMessage("§6Drop Booster: §caus");
                    }
                    if($this->plugin->b5 === true){
                        $sender->sendMessage("§6XP Booster: §aan");
                    } else {
                        $sender->sendMessage("§6XP Booster: §caus");
                    }
                    $sender->sendMessage("§cNutze /booster um einen Booster zu aktivieren");
                } elseif ($sender->isOp()){
                    $player = $this->plugin->getServer()->getPlayer($args[0]);
                    if($player instanceof Player){
                        if(isset($args[1])){
                            if(is_numeric($args[1])){
                                $playerf = new Config($this->plugin->getDataFolder()."players.yml", Config::YAML);
                                $playerf->set($player->getName(), $playerf->get($player->getName())+$args[1]);
                                $playerf->save();
                                $sender->sendMessage(str_replace(["%name%", "%amount%"], [$player->getName(), $args[1]], $this->plugin->getConfig()->get("Message-Booster-Given")));
                            }
                        }
                    }
                } else {
                    $this->plugin->openBoosterUI($sender);
                }
            } else {
                $this->plugin->openBoosterUI($sender);
            }
        } else {
            if(isset($args[0])){
                $player = $this->plugin->getServer()->getPlayer($args[0]);
                if($player instanceof Player){
                    if(isset($args[1])){
                        if(is_numeric($args[1])){
                            $playerf = new Config($this->plugin->getDataFolder()."players.yml", Config::YAML);
                            $playerf->set($player->getName(), $playerf->get($player->getName())+$args[1]);
                            $playerf->save();
                            $sender->sendMessage(str_replace(["%name%", "%amount%"], [$player->getName(), $args[1]], $this->plugin->getConfig()->get("Message-Booster-Given")));
                        }
                    }
                }
            }
        }
    }
}