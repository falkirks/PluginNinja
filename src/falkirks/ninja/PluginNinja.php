<?php
namespace falkirks\ninja;


use falkirks\ninja\installer\Cloak;
use falkirks\ninja\installer\PluginMover;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PluginNinja extends PluginBase{
    public function onEnable(){
        if($this->isPhar()){
            if(Cloak::init($this->getFile(), $this->getLogger()) === Cloak::STATUS_OK){
                try {
                    $pluginMover = new PluginMover($this, $this->getServer()->getDataPath(), $this->getServer()->getPluginPath());
                    $this->getLogger()->info(TextFormat::DARK_PURPLE . "Cloak is now stable and installation can continue." . TextFormat::RESET);
                    $this->getLogger()->warning("Errors and warnings may appear, they are normal.");

                    $this->getServer()->getScheduler()->scheduleDelayedTask($pluginMover, 1);
                }
                catch(\RuntimeException $e){
                    $this->getLogger()->critical("Cloak is unstable and requires a restart. Please do NOT use the reload command.");
                }
            }
        }
        else{
            $this->getLogger()->warning("PluginNinja must be run from a .phar file.");
            $this->setEnabled(false);
        }
    }
}