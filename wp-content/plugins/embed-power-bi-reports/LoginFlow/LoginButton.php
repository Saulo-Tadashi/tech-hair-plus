<?php

namespace MoEmbedPowerBI\LoginFlow;

use MoEmbedPowerBI\Wrappers\wpWrapper;

class LoginButton{

private static $instance;
    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

public function mo_epbr_login_button() {
    if(! get_option("mo_epbr_add_sso_button_wp")){ return;}
    wp_enqueue_style( 'mo_epbr_css_login_button', plugins_url( '../includes/css/mo_epbr_login_button.css', __FILE__ ) );
    ?>
   <div class=pbibutton>
   <button type="button" id="ssobutton" onclick="window.location.href='?option=oauthlogin'" class="ssobutton"><span class="ssobutton_logo"><img src="<?php echo esc_url(plugin_dir_url(__DIR__).'includes/images/microsoft.png');?>"></span><span class="ssobutton_text">Login with Azure AD</span></button>
   <p style="text-align: center;">OR</p>
   </div>
   <?php
}

}