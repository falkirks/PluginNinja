<?php
namespace falkirks\ninja\installer;

use pocketmine\plugin\PluginLogger;
use pocketmine\utils\TextFormat;

class Cloak{
    const STATUS_OK = 0;
    const STATUS_NEEDS_RESTART = 2;

    public static function init($path, PluginLogger $logger){
        $path = str_replace("phar://", "", substr($path, 0, -1));
        if(file_exists($path)) {
            $fullPath = explode(DIRECTORY_SEPARATOR, $path);
            if ($fullPath[count($fullPath) - 1]{0} === ".") {
                return Cloak::STATUS_OK;
            }
            else {
                $fullPath[count($fullPath) - 1] = "." . $fullPath[count($fullPath) - 1];
                rename($path, implode(DIRECTORY_SEPARATOR, $fullPath));
                $logger->info("Preliminary installation was successful. In order to ensure everything is working correctly you should" . TextFormat::RED . " restart " . TextFormat::WHITE . "your server now.");
                return Cloak::STATUS_NEEDS_RESTART;
            }
        }
        else{
            $logger->warning("Reloading is okay. But PluginNinja sometimes needs a full restart, now would be one of those times.");
            return Cloak::STATUS_NEEDS_RESTART;
        }
    }
}