<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Controller\powerBIsettingsConfig;
use MoEmbedPowerBI\Wrappers\pluginConstants;

include_once 'support_form.php';

class demorequest{
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
            <div>
                <div class="mo-ms-tab-content-left-border" style="display: flex;flex-direction: column;">
                    <?php $this->mo_epbr_display__demo_request_tab(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function mo_epbr_display__demo_request_tab(){
        
        $wp_integrations = pluginConstants::WP_Integration_Title;
        $azure_integrations = pluginConstants::AZURE_Integrations_Title;
        $prem_features = pluginConstants::features_advertise;
        ?>
        <div class="mo-ms-tab-content-tile">
            <div class="mo-ms-tab-content-tile-content">
            <form class="mo_epbr_ajax_submit_form" method="post" action="">
                <?php wp_nonce_field("mo_epbr_demo_request_option");?>
                <input type="hidden" name="mo_epbr_tab" value="demorequest_tab">
                <input type="hidden" name="option" value="mo_epbr_demo_request_option"/>
                <span style="font-size:18px;padding-top:10px;font-size:x-large;"><b>Request For Demo</b></span>
                <div class="mo-ms-settings-tab-content" style="padding-top:10px;">
                <div style="content:'';display: block;height: 5px;background: #1f3668;margin-top: 9px;border-radius: 30px"></div>
                    <h1 style="box-sizing:border-box;margin-top: 1rem!important;padding: 1.5rem!important;text-align:center!important;border-radius:0.25rem!important;background:#d5e2ff;font-family:sans-serif;font-size:17px;">Want to try out the paid features before purchasing the license? 
                    Just let us know you're interested in which features and we will setup a demo for you.</h1>
                    <table class="mo-ms-tab-content-app-config-table">
                    <tr>
                        <td class="left-div" style="font-size:15px;margin:auto;margin-top:10px;"><b>Email </b></td>
                        <td class="right-div"><input style="width:206px;" type="email" name="mo_epbr_demo_email" placeholder="We will use this email to setup the demo for you" required value="<?php echo ( get_option( 'mo_epbr_admin_email' ) == '' ) ? get_option( 'admin_email' ) : get_option( 'mo_epbr_admin_email' ); ?>"></td>
                    </tr>
                    <tr>
                        <td class="left-div" style="font-size:15px;margin:auto;margin-top:10px;"><b>Description </b></td>
                        <td class="right-div">
                        <textarea style="width:50%;" rows="6" cols="5" name="mo_epbr_demo_description" placeholder="Write us about your requirement" class="w-100"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="left-div" style="font-size:15px;margin:auto;margin-top:10px;"><b>Features </b></td>
                        <td class="right-div" style="display:flex;font-size:15px;position:relative;padding-bottom: 7px;">
                            <div>
                        <?php
                        foreach($prem_features as $key => $value){?>
                        <div style="margin-top:2px;">
                            <input type="checkbox" name="<?php esc_attr_e($key, 'mo_epbr_demo_features_array'); ?>" value="true"> <span><?php esc_html_e($value, 'mo_epbr_demo_features_array'); ?></span>
                        </div>
                        <?php } ?>   
                            </div> 
                        </td>
                    </tr>

                    </table>


                    <div class="area"></div >

                    <h6 style="font-size:15px;margin:auto;margin-top:10px;font-weight:400;position:relative;margin-left:5px;"><b>Select the Integrations you are interested in (Optional) </b></h6>
                    <div style="display:flex;gap:180px;margin:5px;font-size:16px;position:relative;margin-left:25px;">
                        <div>
                        <h>WordPress Integrations : </h>
                        <?php
                        foreach($wp_integrations as $key => $value){?>
                            <div style="margin-top:2px;">
                                <input type="checkbox" name="<?php esc_attr_e($key, 'mo_epbr_demo_array'); ?>" value="true"> <span><?php esc_html_e($value, 'mo_epbr_demo_array'); ?></span>
                            </div>
                            <?php 
                        }
                        ?>
                        </div>
                        <div>
                        <h>Azure Integrations : </h>
                        <?php
                        foreach($azure_integrations as $key => $value){?>
                            <div style="margin-top:2px;">
                                <input type="checkbox" name="<?php esc_attr_e($key, 'mo_epbr_demo_array'); ?>" value="true"> <span><?php esc_html_e($value, 'mo_epbr_demo_array'); ?></span>
                            </div>
                        <?php } ?>   
                        </div>
                    </div>

                    <div class="text-center" style="margin-top:20px;">
                        <input type="submit" class="mo-ms-tab-content-button" style="margin-top:10px;justify-content:center;border-radius:7px;height:30px;" name="submit" value="Send Request">
                    </div>
                </div>
            </form>
            </div>
        </div>
     <?php
    }
}