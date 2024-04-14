<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\View\powerBI;

include_once 'support_form.php';

class adminView{

    private static $instance;

    public static function getView(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function mo_epbr_menu_display(){
        if( isset( $_GET[ 'tab' ] ) ) {
            $active_tab = sanitize_text_field($_GET['tab']);
        }else{
            $active_tab = 'app_config';
        }
        echo '<div style="display:flex;">';
        $this->mo_epbr_display_tabs($active_tab);
      
        echo '</div>';

    }

    private function mo_epbr_display_tabs($active_tab){

        if($active_tab != 'licensing_plans') {

        echo '<div style="display:flex;justify-content:space-between;align-items:flex-start;padding-top:8px;margin-right:-1.5rem;width:100%">
        <div style="width:100%;" id="mo_epbr_container" class="mo-container">';
            $this->mo_epbr_display__header_menu();
            $this->mo_epbr_display__tabs($active_tab);
            echo '<div style="display:flex;justify-content:space-between;align-items:flex-start;">';
            $this->mo_epbr_display__tab_content($active_tab);
            mo_epbr_display_support_form();
            echo '</div></div>';

        echo '</div>';
        }
        else{
            $handler = licenseView::getView();
            $handler->mo_epbr_display_licensing_view();
        }
         
    }

    private function mo_epbr_display__header_menu(){
       ?>
        <div style="display: flex;">
            <img id="mo-ms-title-logo" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE).'images/miniorange.png');?>">
            <h1><label for="power_bi_integrator">WP Embed Power BI Reports</label></h1>

            <span><a href="<?php echo esc_url_raw(admin_url('admin.php?page=mo_epbr&tab=licensing_plans'));?>" class="button button-primary" style="display:block;font-weight:600;cursor:pointer;border-width:1px;border-style: solid;margin:18px;background-color: #0078d4;border-color: #0078d4;margin-right:20px;">Licensing Plans</a> </span>
        </div>
        <?php
    }

    private function mo_epbr_display__tabs($active_tab){
        ?>
        <div class="mo-ms-tab ms-tab-background mo-ms-tab-border">
            <ul class="mo-ms-tab-ul">
                <li id="app_config" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','app_config'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'app_config'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="Application" title="Application Configuration" role="button" tabindex="0">
                            <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <span class="dashicons dashicons-align-wide"></span>
                            </div>
                            <div id="add_app_label" class="mo-ms-tab-li-label">
                                Manage Application
                            </div>
                            </div>

                        </div>
                    </a>
                </li>
                &nbsp
                <li id="pb_app_config" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','pb_app_config'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'pb_app_config'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="PowerBI" title="PowerBI Configuration" role="button" tabindex="0">
                        <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <img class="power_bi_tab_image" src="<?php echo esc_url(plugin_dir_url(__FILE__).'../images/power-bi.svg');?>">
                            </div>
                            <div id="add_app_label" class="mo-ms-tab-li-label">
                                Embed Power BI
                            </div>
                        </div>
                        </div>
                    </a>
                </li>
                &nbsp
                <li id="settings_tab" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','settings_tab'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'settings_tab'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="Settings Tab" title="Settings Tab" role="button" tabindex="0">
                           <div class="mo-ms-tab-centre">
                           <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <span class="dashicons dashicons-admin-tools"></span>
                            </div>
                            <div id="settings_tab" class="mo-ms-tab-li-label">
                               Settings
                            </div>
                           </div>
                        </div>
                    </a>
                </li>
                &nbsp
                <li id="setup_guide" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','setup_guide'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'setup_guide'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="Setup Guide" title="Setup Guide" role="button" tabindex="0">
                        <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <img  src="<?php echo esc_url(plugin_dir_url(__FILE__).'../images/users.svg');?>">
                            </div>
                            <div id="setup_guide" class="mo-ms-tab-li-label">
                               Setup Guide
                            </div>
                        </div>
                        </div>
                    </a>
                </li>
                &nbsp
                <li id="demorequest_tab" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','demorequest_tab'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'demorequest_tab'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="Demo Request Tab" title="Demo Request Tab" role="button" tabindex="0">
                        <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <span class="dashicons dashicons-email-alt"></span>
                            </div>
                            <div id="demorequest_tab" class="mo-ms-tab-li-label">
                               Demo Request
                            </div>
                        </div>

                        </div>
                    </a>
                </li>
                &nbsp
                <li id="integrations_tab" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','integrations_tab'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'integrations_tab'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="integrations Tab" title="Integrations Tab" role="button" tabindex="0">
                        <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <span class="dashicons dashicons-networking"></span>
                            </div>
                            <div id="integrations_tab" class="mo-ms-tab-li-label">
                               Integrations
                            </div>
                        </div>

                        </div>
                    </a>
                </li>
                &nbsp
                <li id="account_setup_tab" class="mo-ms-tab-li">
                    <a href="<?php echo esc_url_raw(add_query_arg('tab','account_setup_tab'));?>">
                        <div id="application_div_id" class="mo-ms-tab-li-div <?php
                        if($active_tab == 'account_setup_tab'){
                            echo 'mo-ms-tab-li-div-active';
                        }
                        ?>" aria-label="account setup tab" title="Account Setup Tab" role="button" tabindex="0">
                        <div class="mo-ms-tab-centre">
                            <div id="add_icon" class="mo-ms-tab-li-icon" >
                                <!-- <span class="dashicons dashicons-share-alt"></span> -->
                                <img class="account_setup_logo" src="<?php echo esc_url(plugin_dir_url(__FILE__).'../images/login.png');?>">
                            </div>
                            <div id="account_setup_tab" class="mo-ms-tab-li-label">
                               Account Setup
                            </div>
                        </div>

                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }

    private function mo_epbr_display__tab_content($active_tab){
        $handler = self::getView();
        switch ($active_tab){
            case 'app_config':{
                $handler = appConfig::getView();
                break;
            }
            case 'pb_app_config':{
                $handler = powerBI::getView();
                break;
            }
            case 'setup_guide':{
                $handler = setupGuide::getView();
                break;
            }
            case 'settings_tab':{
                $handler = powerBIsettings::getView();
                break;
            }
            case 'demorequest_tab':{
                $handler = demorequest::getView();
                break;
            }
            case 'integrations_tab':{
                $handler = integrations::getView();
                break;
            }
            case 'account_setup_tab':{
                $handler = accountSetup::getView();
                break;
            }

        }
        $handler->mo_epbr_display__tab_details();
    }
  
    private function mo_epbr_display__tab_details(){
       esc_html_e("Class missing. Please check if you've installed the plugin correctly.");
    }
}