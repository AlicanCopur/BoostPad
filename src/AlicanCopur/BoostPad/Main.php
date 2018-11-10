<?php

namespace AlicanCopur\BoostPad;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\level\Position;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->saveResource("Config.yml");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onMove(PlayerMoveEvent $event){
  	  $o = $event->getPlayer();
  	  $from = $event->getFrom();
  	  $to = $event->getTo();
 	   if($from->getLevel()->getBlockIdAt($from->x, $from->y - 1, $from->z) === Block::REDSTONE_BLOCK){
 			$cfg = new Config($this->getDataFolder()."Config.yml", Config::YAML);
 			$m = $cfg->get("multiply");
      		$o->setMotion((new Vector3($to->x - $from->x, $to->y - $from->y, $to->z - $from->z))->multiply($m));
  	  }
  }
}
