<?php

declare(strict_types=1);

namespace multiprotocol;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\LoginPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\plugin\PluginBase;

/**
 * Class MultiProtocol
 * @package multiprotocol
 * @author Estem0
 */
class MultiProtocol extends PluginBase implements Listener {

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

   public function onCompletion() : void
{
  $server = Server::getInstance();
}

    /**
     * @param DataPacketReceiveEvent $event
     */
    public function onLogin(DataPacketReceiveEvent $event) : void{

        $pk = $event->getPacket();

        if(!$pk instanceof LoginPacket) {
            return;
        }
        $player = $event->$server->getPlayer();
        $currentProtocol = ProtocolInfo::CURRENT_PROTOCOL;

        if($pk->protocol !== $currentProtocol) {
            $pk->protocol = $currentProtocol;
            $this->getLogger()->alert("§6{$player->getName()}'s protocol changed to {$currentProtocol}!");
        }
    }
}
