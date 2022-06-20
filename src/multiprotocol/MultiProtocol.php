<?php

declare(strict_types=1);

namespace multiprotocol;

use pocketmine\utils\Config;
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

    public $acceptProtocol = [];

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        @mkdir($this->getDataFolder());
		$this->acceptProtocol = [534, 533, 532, 530, 526, 524, 516, 514, 512];
    }
    /**
     * DataPacketReceiveEvent event
     */
    public function onDataPacketRecieve (DataPacketReceiveEvent $ev) : void{

    	$pk = $ev->getPacket();

    	if ($pk instanceof LoginPacket) {

    		if (in_array($pk->protocol, $this->acceptProtocol)) {
    			$pk->protocol = ProtocolInfo::CURRENT_PROTOCOL;
         }
      }
   }
}
