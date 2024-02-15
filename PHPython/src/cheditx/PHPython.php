<?php

declare(strict_types = 1);

namespace cheditx;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;

class PHPython extends PluginBase implements Listener {

	public $file;

	public function onEnable() : void {
		if (!is_dir($this->getDataFolder())) {
			@mkdir($this->getDataFolder());
		}

		if (!is_file($this->getDataFolder() . "config.yml")) {
			$this->saveDefaultConfig();
		}

		$this->file = $this->getConfig()->get("file-name");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onJoin(PlayerJoinEvent $event): void {
		$player = $event->getPlayer();

		$result = base64_decode(shell_exec("python3 " . $this->getDataFolder() . $this->file . ".py " . $event->getEventName() . ' ' . base64_encode(json_encode(['getPlayer' => ['getName' => $player->getName()]]))));
		$player->sendMessage($result);
	}

	public function onQuit(PlayerQuitEvent $event): void {
		$player = $event->getPlayer();

		$result = base64_decode(shell_exec("python3 " . $this->getDataFolder() . $this->file . ".py " . $event->getEventName() . ' ' . base64_encode(json_encode(['getPlayer' => ['getName' => $player->getName()]]))));
		$player->sendMessage($result);
	}
}