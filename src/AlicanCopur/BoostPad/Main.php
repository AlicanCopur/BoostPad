<?php

/** 
*     _    _ _                  ____ 
*    / \  | (_) ___ __ _ _ __  / ___|
*   / _ \ | | |/ __/ _` | '_ \| |    
*  / ___ \| | | (_| (_| | | | | |___ 
* /_/   \_\_|_|\___\__,_|_| |_|\____|
*                                 
*                                  
*  -I'm getting stronger if I'm not dying-
*
* @version 1.0
* @author AlicanCopur
* @copyright HashCube Network © | 2015 - 2019
* @license Açık yazılım lisansı altındadır. Tüm hakları saklıdır. 
*/       

namespace AlicanCopur\BoostPad;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener {

    protected function onEnable() {
        @mkdir($this->getDataFolder());
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML, [
            "multiply" => 5,
            "block-ids" => [5]
        ]);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @param PlayerMoveEvent $event
     */

    public function move(PlayerMoveEvent $event) {
        $player = $event->getPlayer();
        $from = $event->getFrom();
        $to = $event->getTo();
        if (in_array($from->getLevel()->getBlockIdAt($from->x, $from->y - 1, $from->z), $this->getBlockIds())) {
            $player->setMotion((new Vector3($to->x - $from->x, $to->y - $from->y, $to->z - $from->z))->multiply($this->getMultiply()));
        }
    }

    /**
     * @return int|null
     */

    public function getMultiply(): ?int {
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        return $config->get("multiply");
    }

    /**
     * @return array|null
     */

    public function getBlockIds(): ?array {
        $config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        return $config->get("block-ids");
    }
}
