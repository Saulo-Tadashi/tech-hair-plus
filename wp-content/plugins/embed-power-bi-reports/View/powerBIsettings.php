<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Controller\powerBIsettingsConfig;
use MoEmbedPowerBI\Wrappers\pluginConstants;

include_once 'support_form.php';

class powerBIsettings{
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
            <h1><b>Resource Settings</b></h1>
            <div>
                <div class="mo-ms-tab-content-left-border" style="display: flex;flex-direction: column;">
                    <?php $this->mo_epbr_display__powerbi_settings_tab(); ?>
                </div>
            </div>
        </div>
        <?php
    }

    private function mo_epbr_display__powerbi_settings_tab(){
        
        wp_enqueue_style( 'mo_epbr_css_powerbi_settings_display', plugins_url( '../includes/css/mo_epbr_powerbi_settings.css', __FILE__ ) );
        wp_enqueue_style( 'mo_epbr_css_app_display', plugins_url( '../includes/css/mo_epbr_appConfig.css', __FILE__ ) );
        $mobile_height = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_height'))?wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_height'):"100px";
        $mobile_width = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_width'))?wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_width'):"100%";
        $mobile_breakpoint =!empty (wpWrapper::mo_epbr_get_option('mo_epbr_mobile_display_breakpoint'))?wpWrapper::mo_epbr_get_option('mo_epbr_mobile_display_breakpoint'):'320';
        $languagesarray = pluginConstants::languages;
        if(empty(wpWrapper::mo_epbr_get_option('mo_epbr_selected_locale_language_for_embed'))){wpWrapper::mo_epbr_set_option('mo_epbr_selected_locale_language_for_embed',"en-US");}
        if(empty(wpWrapper::mo_epbr_get_option('mo_epbr_selected_language_for_embed'))){wpWrapper::mo_epbr_set_option('mo_epbr_selected_language_for_embed',"en-US");} 
        $res_tenant_id = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_resource_tenantid'))?wpWrapper::mo_epbr_get_option('mo_epbr_resource_tenantid'):'';
        $res_subscription_id = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_resource_subscriptionid'))?wpWrapper::mo_epbr_get_option('mo_epbr_resource_subscriptionid'):'';
        $res_name = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_resource_name'))?wpWrapper::mo_epbr_get_option('mo_epbr_resource_name'):'';
        $res_grp_name = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_resource_groupname'))?wpWrapper::mo_epbr_get_option('mo_epbr_resource_groupname'):'';
        
        ?>
        <form id="mo_epbr_report_settings_form" action="" method="post" class="mo_epbr_ajax_submit_form" style="margin-right: 10px;">
    <?php wp_nonce_field('mo_epbr_report_settings'); ?>
    <input type="hidden" name="option" value="mo_epbr_report_settings"/>
    <input type="hidden" name="mo_epbr_tab" value="settings_tab">
    <div class="mo-ms-tab-content-tile">
    <div class="mo-ms-tab-content-tile-content">
        <span style="font-size:18px;padding-top:10px;"><b>Settings For Embedded Resource</b></span>
        <div class="mo-ms-settings-tab-content" style="padding-top:20px;padding-bottom:0px;">
            <ul class="form-fields" style="margin-bottom: 21px;"><li class="field check-round slide-inverse" style="float:left;margin-left: -5px;" >
            <input type="checkbox" id="switch-filters-button" name="mo_epbr_add_filters_pane" <?php if(get_option('mo_epbr_add_filters_pane')) echo "checked" ?> style="margin-left: 70px;"/>
            <label for="switch-filters-button" class="input_label">Filter Pane &nbsp &nbsp <span style="margin-left: 65px;"></span></label>
            </li></ul>
            <span class="info_span" style="margin-left:10px;"> Enable the filter pane on the embedded resource </span>
        </div>
        <div class="mo-ms-settings-tab-content" style="padding-bottom: 25px;">
            <ul class="form-fields" style="margin-bottom: 21px;"><li class="field check-round slide-inverse" style="float:left;margin-left: -5px;" >
            <input type="checkbox" id="switch-pagenav-button" name="mo_epbr_add_page_navigation" <?php if(get_option('mo_epbr_add_page_navigation')) echo "checked" ?> style="margin-left: 28px;"/>
            <label for="switch-pagenav-button" class="input_label">Page Navigation &nbsp &nbsp <span style="margin-left:25px;"></span></label>
            </li></ul>
            <span class="info_span" style="margin-left:10px;"> Enable the filter pane on the embedded resource </span>
        </div>
        <div class="mo-ms-settings-tab-content">
        <label for="languages" class="input_label">Language &nbsp &nbsp</label>
        <select id="languages" name="languages" style="padding-left:10px;margin-left:76px;width:44%;">
        <option disabled>Select your Language</option>
        <?php
        foreach($languagesarray as $key => $value) {
            if(wpWrapper::mo_epbr_get_option('mo_epbr_selected_language_for_embed')==$key){
                echo "<option value='$key' selected >$value</option>";
            }else{
                echo "<option value='$key'>$value</option>";
            }
          }
        ?>
        </select>
        </div>
        <div class="mo-ms-settings-tab-content">
        <label for="localelanguages" class="input_label">Format Locale &nbsp &nbsp</label>
        <select id="localelanguages" name="localelanguages" style="padding-left:10px;margin-left:47px;width:44%;">
        <option disabled>Select your Locale Language</option>
        <?php
        foreach($languagesarray as $key => $value) {
            if(wpWrapper::mo_epbr_get_option('mo_epbr_selected_locale_language_for_embed')==$key){
                echo "<option value='$key' selected >$value</option>";
            }else{
                echo "<option value='$key'>$value</option>";
            }
          }
        ?>
        </select>
        </div>
        <div class="mo-ms-settings-tab-content" style="padding-bottom: 0px;">
        <label for="embed_mobile_breakpoint" class="input_label">Mobile Breakpoint &nbsp &nbsp <span></span></label>
        <input id="embed_mobile_breakpoint" name="embed_mobile_breakpoint" style="margin-left:16px;width: 44%;" placeholder="Only Numeric Value" value="<?php echo esc_html($mobile_breakpoint);?>" type="text" pattern="[1-9][0-9]*"/>
        <p class="info_p"> Enter the mobile width display breakpoint in pixels(Numeric value only). Any width less than the entered amount will trigger the mobile report functionality. </p>    
        </div>
        <div class="mo-ms-settings-tab-content" style="padding-bottom: 0px;">
        <label for="embed_mobile_height" class="input_label">Mobile Height &nbsp &nbsp <span></span></label>
        <input id="embed_mobile_height" name="embed_mobile_height" style="margin-left: 44px;width: 44%;" placeholder="" value="<?php echo esc_html($mobile_height);?>" type="text" pattern="(([1-9][0-9]*(px|%|))|(auto)?)"/>
        <p class="info_p"> Enter mobile height in pixels(px) or percentage (%) or type auto</p>    
        </div>
        <div class="mo-ms-settings-tab-content" style="padding-bottom: 0px;">
        <label for="embed_mobile_width" class="input_label">Mobile Width &nbsp &nbsp <span></span></label>
        <input id="embed_mobile_width" name="embed_mobile_width" style="margin-left:49px;width: 44%;" placeholder="" value="<?php echo esc_html($mobile_width);?>" type="text" pattern="([1-9][0-9]*(px|%|)"/>
        <p class="info_p"> Enter mobile width in pixels(px) or percentage (%) </p>    
        </div>
        <div class="mo-ms-settings-tab-content" style="padding-bottom: 0px;position:relative;">
        <label for="embed_pageName" class="input_label">Page Name &nbsp &nbsp <span></span></label>
        <input id="embed_pageName" name="embed_pageName" style="margin-left:65px;width:44%;" placeholder="Premium Feature" type="text" disabled/>
        <img class="premium_crown" style="width:3%;position:relative;margin-bottom:-7px;margin-left: 4px;" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />
        <p class="info_p"> Enter page name if you specifically want to embed particular page. Example:ReportSectionf9df106e1f2181da5afc </p>    
        </div>
        <div class="save_configs_report">
                <div style="margin:10px;">
                    <input style="height:30px;float:left;" type="submit" id="saveButton" class="mo-ms-tab-content-button" value="Save">
                </div>
            </div>
    </div></div>
</form>

<?php
    }
}