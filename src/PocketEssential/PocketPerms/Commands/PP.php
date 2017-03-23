<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 3/22/2017
 * Time: 12:51 AM
 */

namespace PocketEssential\PocketPerms\Commands;

use PocketEssential\PocketPerms\PocketPerms;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;


class PP extends Base
{

    private $plugin;

    public function __construct(PocketPerms $plugin) {
        $this->plugin = $plugin;
        parent::__construct($plugin, "pp", "PocketPerm", "/pp", ["p","pocketperm"]);
    }


    public function execute(CommandSender $sender, $commandLabel, array $args)
    {

        if ($sender instanceof Player) {

            if($args[0] == null){
                $sender->sendMessage("");
            }
            switch ($args[0]){

                /*
                 *  Set a player group
                 */
                case "setgroup":
                case "setgrp":
                    if($args[1] == null){
                        $sender->sendMessage(TextFormat::YELLOW . "Usage: /pp setgroup <Player name> <Group name>");
                    } else {
                        if ($args[2] == null) {
                            $sender->sendMessage(TextFormat::YELLOW . "Usage: /pp setgroup <Player name> <Group name>");
                        } else {
                            if ($this->getPlugin()->getServer()->getPlayer($args[1]) == null) {
                                $sender->sendMessage(TexFormat::RED . "[PP] Error while trying to set " . $args[1] . " group, is the player online?");
                            } else {
                                if ($this->getPlugin()->getGroup($as->getrgs[2]) == false) {
                                    $sender->sendMessage(TexFormat::RED . "[PP] That group doesn't exist!");
                                } else {
                                    $this->getPlugin()->setGroup($this->Plugin()->getServer()->getPlayer($args[1]), $args[2]);
                                    $sender->sendMessage(TexFormat::GREEN . "[PP] " . $args[1] . " group has successfully been set to " . $args[2]);
                                }
                            }
                        }
                    }
                    break;

                /*
                 *  Add a permission to a group
                 */
                case "addperm":
                case "addp":
                case "addpermission":
                    if($args[1] == null){
                        $sender->sendMessage(TextFormat::YELLOW . "Usage: /pp addperm <Group name> <Permission>");
                    } else {
                        if ($args[2] == null) {
                            $sender->sendMessage(TextFormat::YELLOW . "Usage: /pp setgroup <Group name> <Permission>");
                        } else {
                            if ($this->getPlugin()->getGroup($args[1]) == false) {
                                $sender->sendMessage(TextFormat::RED . "[PP] That group doesn't exist!");
                            } else {
                                $this->getPlugin()->addGroupPermission($args[1], $args[2]);
                                $sender->sendMessage(TexFormat::GREEN . "[PP] Added permission: ".$args[2]." to group " . $args[1]." successfully!");
                            }
                        }
                    }
                    break;

                /*
                 *  Remove group
                 */
                case "removegroup":
                case "rmgroup":
                case "delgroup":
                case "delgrp":
                if($args[1] == null){
                    $sender->sendMessage(TextFormat::YELLOW . "Usage: /pp delgroup <Group name>");
                } else {
                        if ($this->getPlugin()->getGroup($args[1]) == false) {
                            $sender->sendMessage(TextFormat::RED . "[PP] That group doesn't exist!");
                        } else {
                            $this->getPlugin()->deleteGroup($args[1]);
                            $sender->sendMessage(TexFormat::GREEN . "[PP] Group ". $args[1] . " has successfully been removed");
                        }
                    }
                break;

            }
        } else {
            $sender->sendMessage(PocketPerms::RUN_FROM_CONSOLE);
        }
    }
    public function getPlugin(){

        return $this->plugin;
    }

    public function getServer(){

        return $this->getPlugin()->getServer();
    }
}
