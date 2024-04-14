<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\Wrappers\wpWrapper;

class powerBIsettingsConfig{
    private static $instance;
    private static $API_ENDPOINT = pluginConstants::API_ENDPOINT_VAL;
    private $config = [];

    public static function getController()
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
    
    public function mo_epbr_save_settings(){
        $option = sanitize_text_field($_POST['option']);
        switch ($option){
            case 'mo_epbr_report_settings':{
                $this->mo_epbr_update_report_settings();
            }
        }
    }

    private function mo_epbr_update_report_settings(){
        check_admin_referer('mo_epbr_report_settings');
        if(isset($_POST['mo_epbr_add_filters_pane']) && $_POST['mo_epbr_add_filters_pane'] == 'on') {
            update_option('mo_epbr_add_filters_pane',true);
        }else{
            update_option('mo_epbr_add_filters_pane',false);
        }
        if(isset($_POST['mo_epbr_add_page_navigation']) && $_POST['mo_epbr_add_page_navigation']=='on'){
            update_option('mo_epbr_add_page_navigation',true);
        }else{
            update_option('mo_epbr_add_page_navigation',false);
        }
        if (isset($_POST['languages'])){
            $selected_language = sanitize_text_field($_POST['languages']);
            update_option('mo_epbr_selected_language_for_embed',$selected_language);
        }
        if(isset($_POST['localelanguages'])){
            $selected_locale = sanitize_text_field($_POST['localelanguages']);
            update_option('mo_epbr_selected_locale_language_for_embed',$selected_locale);
        }
        if(isset($_POST['embed_mobile_height'])){
            $mobile_height = sanitize_text_field($_POST['embed_mobile_height']);
            update_option('mo_epbr_embed_mobile_height',$mobile_height); 
        }
        if(isset($_POST['embed_mobile_width'])){
            $mobile_width = sanitize_text_field($_POST['embed_mobile_width']);
            update_option('mo_epbr_embed_mobile_width',$mobile_width);  
        }
        if(isset($_POST['embed_mobile_breakpoint'])){
            $breakpoint = sanitize_text_field($_POST['embed_mobile_breakpoint']);
            update_option('mo_epbr_mobile_display_breakpoint',$breakpoint);
        }
        wpWrapper::mo_epbr__show_success_notice("Settings Updated Successfully.");
    }
}



