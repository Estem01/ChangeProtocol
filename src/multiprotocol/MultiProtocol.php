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
		$this->acceptProtocol = (new Config($this->getDataFolder()."accept.yml", Config::YAML))->get("accept-protocol");
		
		if ($this->acceptProtocol === false || empty($this->acceptProtocol)) {
			$this->acceptProtocol[] = ProtocolInfo::CURRENT_PROTOCOL;
			$config = new Config($this->getDataFolder()."accept.yml", Config::YAML);
			$config->set("accept-protocol", [ProtocolInfo::CURRENT_PROTOCOL]);
			$config->save();
		}
                if ($this->denyProtocol === false || empty($this->denyProtocol)) {
			$this->denyProtocol[] = ProtocolInfo::CURRENT_PROTOCOL;
                }
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
