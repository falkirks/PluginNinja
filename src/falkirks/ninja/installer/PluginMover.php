<?php
namespace falkirks\ninja\installer;

use falkirks\ninja\PluginNinja;
use pocketmine\scheduler\PluginTask;

class PluginMover extends PluginTask{
    private $path;
    private $pluginPath;
    public function __construct(PluginNinja $pluginNinja, $path, $pluginPath){
        parent::__construct($pluginNinja);
        $this->path = $path . "ninja/";
        $this->pluginPath = $pluginPath;
        @mkdir($this->path);
    }
    public function onRun($tick){
        $this->getOwner()->getLogger()->info("Running plugin transfer...");
        $this->getOwner()->getLogger()->info("Disabling running plugins...");
        foreach($this->getOwner()->getServer()->getPluginManager()->getPlugins() as $plugin){
            if($plugin !== $this->getOwner()){
                $this->getOwner()->getServer()->getPluginManager()->disablePlugin($plugin);
            }
        }
        $this->getOwner()->getLogger()->info("Moving plugins...");
        foreach(new \DirectoryIterator($this->pluginPath) as $file){
            if(substr($file, strlen($file)-5) === ".phar" && strpos($file, "PluginNinja") === false){
                $this->getOwner()->getLogger()->info("Moving $file");
                rename($this->pluginPath . $file, $this->path . $file);
            }
        }
    }
}