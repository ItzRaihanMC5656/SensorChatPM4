<?php

namespace RhaxDev\SensorChat\PM4;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Event;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
    
    public function onEnable() : void{
        $this->saveResource("data.json");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onChat(PlayerChatEvent $e) {
        $file = file_get_contents($this->getDataFolder() . "data.json");
        $json = json_decode($file, true);
        $f = $json["Format"];
        foreach($json["List"] as $list){
            $len = strlen($list);
            $repeat = str_repeat($f, $len);
            $replace = str_replace($list, $repeat, $e->getMessage());
            $e->setMessage($replace);
        }
    }
}
