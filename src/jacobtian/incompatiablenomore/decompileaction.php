<?php
global $pharcount;
global $pharlist;
global $pharname;
global $pharlist;
global $pharlocation;
include "main.php";
include  "updateaction.php";
/**
 * Created by PhpStorm.
 * User: JacobTian
 * Date: 6/24/16
 * Time: 10:32 AM
 */

namespace JacobTian\IncompatiableNoMore\decompileaction;

use JacobTian\IncompatiableNoMore;

use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\event\plugin;
use pocketmine\plugin;


include ("main.php");


$decompileaction = 0
//count plugins in /plugins folder
//reference: stackoverflow.com
    $i = 0;
    $dir = 'plugins/';
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false){
            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file))
                $i = +$i + 1;
        }
    }
$pluginlist = scandir ( $dir);
$count = 0;
$pharlist = array ();
$cond = "true";
do {
    $filetocheck = "plugins/" . $pluginlist[$count];
    if ($filetocheck == false or null):
        $decompileaction = 1;
        $cond = "false";
        $pharcount = $count;
        $count = 0; //just in case.
    else:
        //read extension
        $extension = pathinfo($filetocheck->getFilename(), PATHINFO_EXTENSION);
        $filechecked = $filetocheck;
        do {
            array_push($pharlist, $filetocheck);
        } while ($extension = "phar");
        $count = $count + 1;
    endif;
}while ($cond == "true");
//====================================================================================================================//
//Below: Unpack phar into folder

$updateaction = 0;
$pharid = 0;
$pharlocation = array();
$templocation = "";
@mkdir("temp/");
@mkdir("temp/IncompatiableNoMore/");
do {
    $pharname = pathinfo($filetocheck->getFilename(), PATHINFO_BASENAME);
    @mkdir("temp/IncompatiableNoMore/" . $pharname . "/");
    $templocation = "temp/IncompatiableNoMore/" . $pharname . "/";
    array_push($pharlocation, $templocation);
        try {
            $phar = $pharlist[$pharid];
            $phar->extractTo("temp/IncompatiableNoMore/" . $pharname . "/", null, true); // extract all files, and overwrite
        } catch (Exception $e) {
            // handle errors
        }

    $pharid = $pharid + 1;
}while ($pharid <= $pharcount);

do {$updateaction = 1; //trigger on update action
}while ($pharid > $pharcount);

//====================================================================================================================//
//Edit plugin
$currentpharid = 0;
do {
    $currentlocation = $pharlocation[$currentpharid];
    $currentpharid = $currentpharid + 1;
    $oldapi = get($currentlocation . "config.yml", Config::YAML, array("api"));
    $targetapi = new Config($this->getDataFolder()."config.yml", Config::YAML, array("api"));
    if ($oldapi != $targetapi) {
        $updatecurrent = 1;}
    else {
        $updatecurrent = 0;

    }
    if ($updatecurrent == 1 ) {
    $plugininfo["api"] = $targetapi;
        $newinfo = yaml_parse()
    }
} while ($currentpharid <= $pharcount);

