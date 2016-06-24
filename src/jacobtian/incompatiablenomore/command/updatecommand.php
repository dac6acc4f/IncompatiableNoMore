<?php
namespace JacobTian\IncompatiableNoMore\command;

use pocketmine\command\Command;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\command\CommandSender;

use JacobTian\IncompatiableNoMore\updateaction;

class ActionCommand extends command implements PluginIdentifiableCommand{
    public $commandName = "fixapi";
    public function __construct(OneVsOne $plugin, ArenaManager $arenaManager){
        parent::__construct($this->commandName, "Join 1vs1 queue !");
        $this->setUsage("/$this->commandName");

        $this->plugin = $plugin;
        $this->arenaManager = $arenaManager;
    }
    public function getPlugin(){
        return $this->plugin;
    }
    public function execute(CommandSender $sender, $label, array $params){
        if(!$this->plugin->isEnabled()){
            return false;
        }

        $this->action->doaction;

        return true;
    }
}