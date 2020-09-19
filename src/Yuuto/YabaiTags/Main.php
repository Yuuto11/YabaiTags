<?php

namespace Yuuto/YabaiTags;

use Yuuto/YabaiTags/Commands/TagCommands;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\entity\Entity;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use jojoe77777\FormAPI;
use _64FF00\PureChat\PureChat;
use _64FF00\PurePerms\PurePerms;

	public function onLoad() : void{
  
		// FormAPI Plugin
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		if ($api instanceof FormAPI) {
			$this->getServer()->getLogger()->notice("Load FormAPI successful!");
		} else {
			$this->getServer()->getLogger()->warning("Error no Plugin FormAPI!");
		}
		// PurePerms Plugin
		$purePerms = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		if ($purePerms instanceof PurePerms) {
			$this->getServer()->getLogger()->notice("Load PureChat PurePerms!");
		} else {
			$this->getServer()->getLogger()->warning("Error no Plugin PurePerms!");
		}
		// PureChat Plugin
		$pureChat = $this->getServer()->getPluginManager()->getPlugin("PureChat");
		if ($pureChat instanceof PureChat) {
			$this->getServer()->getLogger()->notice("Load PureChat successful!");
		} else {
			$this->getServer()->getLogger()->warning("Error no Plugin PureChat!");
		}
	}    
  
		$this->getServer()->getCommandMap()->register("tag", new TagCommands("tag", $this));
          }
    }
}
