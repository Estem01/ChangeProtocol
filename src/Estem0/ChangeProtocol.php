<?php

declare(strict_types=1);

namespace Estem0;

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
class ChangeProtocol extends PluginBase implements Listener {

    public $acceptProtocol = [];

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

		$this->acceptProtocol = [534, 533, 532, 530, 526, 524, 516, 514, 512, 513];
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
