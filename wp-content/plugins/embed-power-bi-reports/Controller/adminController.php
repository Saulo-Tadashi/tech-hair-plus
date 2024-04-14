<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\View\accountSetup;
use MoEmbedPowerBI\View\integrations;

class adminController{
    private static $instance;

    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function mo_epbr_admin_controller(){
        if(!current_user_can('administrator') || !isset($_POST['mo_epbr_tab']) || !isset($_POST['option'])){
            return;
        }

        $tabSwitch = sanitize_text_field($_POST['mo_epbr_tab']);
        $handler = self::getController();
        switch ($tabSwitch){
            case 'app_config':{
                $handler = appConfig::getController();
                break;
            }
            case 'pb_app_config':{
                $handler = powerBIConfig::getController();
                break;
            }
            case 'setup_guide':{
                $handler = setupGuide::getController(); 
                break; 
            }
            case 'settings_tab':{
                $handler = powerBIsettingsConfig::getController();
                break;
            }
            case 'demorequest_tab':{
                $handler = demorequestConfig::getController();
                break;
            }
            case 'account_setup_tab':{
                $handler = accountSetupConfig::getController();
                break;
            }
        }
        $handler->mo_epbr_save_settings();
    }

    private function mo_epbr_save_settings(){
        echo esc_html_e("It seems class is incomplete. Please check if you've installed the plugin correctly.");
    }
}
