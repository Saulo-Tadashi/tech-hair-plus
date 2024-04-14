<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\API\Azure;
use MoEmbedPowerBI\Wrappers\wpWrapper;

class appConfig{

    private static $instance;
    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function mo_epbr_save_settings(){
        $option = sanitize_text_field($_POST['option']);
        switch ($option){
            case 'mo_epbr_client_config_option':{
                $this->mo_epbr_save_client_config();
                break;
            }
            case 'mo_epbr_add_sso_button_wp_login' :{
                $this->mo_epbr_add_sso_button();
                break;
            }
        }
    }

    private function mo_epbr_check_for_empty_or_null(&$input,$arr){
        foreach ($arr as $key){
            if(!isset($_POST[$key]) || empty($_POST[$key])){
                return false;
            }
            $input[$key] = sanitize_text_field($_POST[$key]);
        }
        return $input;
    }

    private function mo_epbr_save_client_config(){
        check_admin_referer('mo_epbr_client_config_option');
        $input_arr = ['client_id','client_secret','redirect_uri','tenant_id'];
        $sanitized_arr = [];
        if(!$this->mo_epbr_check_for_empty_or_null($sanitized_arr,$input_arr)){
            wpWrapper::mo_epbr__show_error_notice(esc_html__("Input is empty or present in the incorrect format."));
            return;
        }
        $sanitized_arr['upn_id'] = isset($_POST['upn_id'])?sanitize_text_field($_POST['upn_id']):'';
        $sanitized_arr['client_secret'] = wpWrapper::mo_epbr_encrypt_data($sanitized_arr['client_secret'],hash("sha256",$sanitized_arr['client_id']));
        wpWrapper::mo_epbr_set_option(pluginConstants::APPLICATION_CONFIG_OPTION,$sanitized_arr);
        wpWrapper::mo_epbr__show_success_notice(esc_html__("Settings Saved Successfully."));
    }

    private function mo_epbr_add_sso_button(){
        check_admin_referer('mo_epbr_add_sso_button_wp_login');
        $app_id = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
        $app_id = $app_id["client_id"];
        if($app_id){
            if(isset($_POST['option'] ) && $_POST['option']=='mo_epbr_add_sso_button_wp_login') {
                if(isset($_POST['mo_epbr_add_sso_button_wp']) && $_POST['mo_epbr_add_sso_button_wp'] == 'on') {
                    wpWrapper::mo_epbr_set_option('mo_epbr_add_sso_button_wp', true);
                } else{
                    wpWrapper::mo_epbr_set_option('mo_epbr_add_sso_button_wp', false);
                }
        wpWrapper::mo_epbr__show_success_notice(esc_html__("Settings Updated Successfully."));}
    }
    else{
        wpWrapper::mo_epbr__show_error_notice("Kindly configure the application to use the login functionality.");
        }
    }

}