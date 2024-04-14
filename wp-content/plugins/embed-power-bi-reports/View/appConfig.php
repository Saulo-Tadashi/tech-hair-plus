<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Wrappers\pluginConstants;

class appConfig{

    private static $instance;

    public static function getView(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function mo_epbr_display__tab_details(){
        ?>
        <div class="mo-ms-tab-content">
            <div >
                <div style="display:flex;flex-direction:row;">
                <h1><b>Configure Microsoft Graph Application</b></h1>
                    <h1><a href="https://plugins.miniorange.com/microsoft-power-bi-embed-for-wordpress" target="_blank" style="padding-left:5px;font-size: small;"> (Setup Guide) </a><h1>
                </div>
                <div class="mo-ms-tab-content-left-border" style="display:flex;flex-direction:column">
                    <?php
                    $this->mo_epbr_display__client_config();
                    ?>         
                </div>
            </div>
        </div>
        <?php
    }

    private function mo_epbr_display__client_config(){
        wp_enqueue_style( 'mo_epbr_css_appConfig', plugins_url( '../includes/css/mo_epbr_appConfig.css', __FILE__ ) );
        $app = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
        $client_id = !empty($app['client_id'])?$app['client_id']:'';
        $redirect_uri = !empty($app['redirect_uri'])?$app['redirect_uri']:site_url();
        $tenant_id = !empty($app['tenant_id'])?$app['tenant_id']:'';
        $upn_id = !empty($app['upn_id'])?$app['upn_id']:'';
        if(isset($app['client_secret']) && !empty($app['client_secret'])){
            $client_secret = wpWrapper::mo_epbr_decrypt_data($app['client_secret'],hash("sha256",$client_id));
        }else{
            $client_secret = '';
        }
        ?>
        <form class="mo_epbr_ajax_submit_form" action="" method="post" style="margin-right: 10px;">
            <input type="hidden" name="option" id="app_config" value="mo_epbr_client_config_option">
            <input type="hidden" name="mo_epbr_tab" value="app_config">
            <?php wp_nonce_field('mo_epbr_client_config_option');?>
            <div class="mo-ms-tab-content-tile">
                <div class="mo-ms-tab-content-tile-content">
                    <span style="font-size: 18px;font-weight: 200;display:flex;"> <b>Basic App Configuration </b></span>
                    <table class="mo-ms-tab-content-app-config-table">
                        <tr>
                            <td class="left-div"><span>Application ID <span style="color:red;font-weight:bold;">*</span></span></td>
                            <td class="right-div"><input placeholder="Enter Your Application (Client) ID" style="width:60%;" type="text" name="client_id" value="<?php echo esc_html($client_id);?>"></td>
                        </tr>
                        <tr>
                            <td class="left-div"><span>Client Secrets <span style="color:red;font-weight:bold;">*</span></span></td>
                            <td class="right-div"><input placeholder="Enter Your Client Secret" style="width:60%;" type="password" name="client_secret" value="<?php echo esc_html($client_secret);?>"></td>
                        </tr>
                        <tr>
                            <td class="left-div"><span>Redirect URI <span style="color:red;font-weight:bold;">*</span></span></td>
                            <td class="right-div"><input placeholder="Enter Redirect URI of Your Application" style="width:60%;" type="url" name="redirect_uri" value="<?php echo esc_html($redirect_uri);?>"></td>
                        </tr>
                        <tr>
                            <td class="left-div"><span>Tenant ID <span style="color:red;font-weight:bold;">*</span></span></td>
                            <td class="right-div"><input placeholder="Enter Your Directory (Tenant) ID" style="width:60%;" type="text" name="tenant_id" value="<?php echo esc_html($tenant_id);?>"></td>
                        </tr>
                        <tr>
                            <td class="left-div"><span>Test UPN/ID</span></td>
                            <td  class="right-div"><input style="width:60%;" placeholder="Enter UserPrincipalName/ID of User To Test (optional)" type="text" name="upn_id" value="<?php echo esc_html($upn_id);?>"></td>
                        </tr>

                        <tr><td colspan="2"></br></td></tr>
                    </table>
                    <div style="display: flex;justify-content:flex-start;align-items:center;">
                        <div style="display: flex;margin:10px;">
                            <input style="height:30px;" type="submit" id="saveButton" class="mo-ms-tab-content-button" value="Save">
                        </div>
                        <div style="margin:10px;">
                            <input style="height:30px;" id="view_attributes" type="button" class="mo-ms-tab-content-button" value="Test Configuration" onclick="showAttributeWindow()">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form id="mo_epbr_add_sso_button_wp_form" method="post" class="mo_epbr_ajax_submit_form" style="margin-right: 10px;">
        <?php wp_nonce_field('mo_epbr_add_sso_button_wp_login'); ?>
        <input type="hidden" name="option" value="mo_epbr_add_sso_button_wp_login" />
        <input type="hidden" name="mo_epbr_tab" value="app_config">
        <div class="mo-ms-tab-content-tile">
        <div class="mo-ms-tab-content-tile-content">
            <span style="font-size:18px;padding-top:10px;"><b>Use Single Sign-On to view Power BI Content </b></span>
            <ul class="form-fields">    
            <li class="field check-round slide-inverse" style="float:left;" >
            <input type="checkbox" id="switch-sso-button" name="mo_epbr_add_sso_button_wp" <?php if(get_option('mo_epbr_add_sso_button_wp')) echo "checked" ?> onchange="document.getElementById('mo_epbr_add_sso_button_wp_form').submit();" />
            <label for="switch-sso-button">Add a Single Sign-On button on the Wordpress login page &nbsp &nbsp <span></span></label>
            </li></ul>  
            </tr>
        </div></div>
        </form>

        <script>
            function showAttributeWindow(){
                document.getElementById("app_config").value = "mo_epbr_app_test_config_option";
                var myWindow = window.open("<?php echo esc_url_raw($this->mo_epbr_get_test_url()); ?>", "TEST User Attributes", "scrollbars=1 width=800, height=600");
            }
        </script>
        <?php
    }

    private function mo_epbr_get_test_url(){
        return admin_url('?option=testUser');
    }
}