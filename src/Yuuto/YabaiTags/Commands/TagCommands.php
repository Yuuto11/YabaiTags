<?php

namespace Yuuto\YabaiTags\Commands;

use Yuuto\YabaiTags\Main;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\Durable;
use pocketmine\plugin\Plugin;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

use jojoe77777\FormAPI;
use _64FF00\PureChat\PureChat;

class TagCommands extends PluginCommand{
	
	/** @var array */
	public $plugin;

	public function __construct($name, Main $plugin) {
        parent::__construct($name, $plugin);
        $this->setDescription("YabaiTags Plugin");
        $this->setUsage("/tag");
		$this->setAliases(["tags"]);		
        $this->setPermission("yabai.tag");
		$this->plugin = $plugin;
    }

	/**
     * @param CommandSender $sender
     * @param string $alias
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
		if (!$sender->hasPermission("yabai.tag")) {
			$sender->sendMessage(TextFormat::RED . "You do not have permission to use this command");
			return false;
		}
		if ($sender instanceof ConsoleCommandSender) {
			$sender->sendMessage(TextFormat::RED . "This command can be only used in-game.");
			return false;
		}
		$this->TagsUI($sender);
		return true;
	}
	
	/**
	 * @param TagsUI
	 * @param Player $player
     */
	public function TagsUI(Player $player) : void{
		$api = $this->plugin->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null) {
        $result = $data;
        if ($result === null) {
            return;
        }
		switch($result) {
			case 0:
			$ppchat = $this->plugin->getServer()->getPluginManager()->getPlugin("PureChat");
			$ppchat->setSuffix((TextFormat::RESET . "§8[§cExample§6#1§8]"), $player);
			$player->sendMessage(TextFormat::RESET . "Set Tag To " . TextFormat::RESET . "§cExample§6#1");
			break;
			case 1:
			$ppchat = $this->plugin->getServer()->getPluginManager()->getPlugin("PureChat");
			$ppchat->setSuffix((TextFormat::RESET . "§8[§dExample§b#2§8]"), $player);
			$player->sendMessage(TextFormat::RESET . "Set Tag To " . TextFormat::RESET . "§dExample§b#2");
			break;	
			case 3:
			$ppchat = $this->plugin->getServer()->getPluginManager()->getPlugin("PureChat");
			$ppchat->setSuffix((TextFormat::RESET . "§r"), $player);
			$player->sendMessage(TextFormat::RESET . "§aYou removed your tag");
			break;			
		    }
		});
		$form->setTitle(TextFormat::BOLD . TextFormat::BLUE . "Yabbai Tags");
		$form->setContent(TextFormat::AQUA . "Select tags");
		$form->addButton(TextFormat::GREEN . "§cExample§6#1");	
		$form->addButton(TextFormat::GREEN . "§dExample§b#2");	
		$form->addButton(TextFormat::GREEN . "§l§4Remove");			
		$form->sendToPlayer($player);
	}
}
