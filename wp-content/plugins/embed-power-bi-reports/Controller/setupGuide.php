<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\API\Azure;
use MoEmbedPowerBI\Wrappers\wpWrapper;

class setupGuide{

    private static $instance;

    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

}
?>