<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\API\Authorization;
use MoEmbedPowerBI\API\Azure;
use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\LoginFlow\oauth_flow;
use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\Controller\appConfig;

class powerBIConfig
{
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
            case 'mo_epbr_resource_config_option':{
                $this->mo_epbr_save_resource_config();
                break;
            }
            case 'mo_epbr_shortcode_container':{
                $this->mo_epbr_delete_shortcode();
                break;
            }
            case 'mo_epbr_allshortcode_delete' :{
                $this->mo_epbr_delete_all_shortcodes();
                break;
            }
            case 'mo_epbr_powerbi_resource_integration' :{
                $this->mo_epbr_more_resource_configurations();
                break;
            }
        }
    }

    private function mo_epbr_more_resource_configurations(){
        if (isset($_POST['res_embed_mode_dropdown'])){
            $selected = sanitize_text_field($_POST['res_embed_mode_dropdown']);
            wpWrapper::mo_epbr_set_option('mo_epbr_res_embed_mode',$selected);
            }
            wpWrapper::mo_epbr__show_success_notice("Embed Mode Changed Successfully.");
    }

    private function mo_epbr_delete_all_shortcodes(){
        check_admin_referer('mo_epbr_allshortcode_delete');
        wpWrapper::mo_epbr_set_option('mo_epbr_all_generated_shortcodes', "");
        wpWrapper::mo_epbr_set_option("mo_epbr_resourceids_array","");
        wpWrapper::mo_epbr__show_success_notice(esc_html__("All Shortcodes Deleted Successfully."));
    }

    private function mo_epbr_delete_shortcode(){
        check_admin_referer('mo_epbr_shortcode_container');
        $shortcode_config = sanitize_text_field(str_replace("\\","",$_POST['mo_epbr_current_clicked_value']));
        $shortcode__config = explode('"',$shortcode_config);
        $shortcode_wid = $shortcode__config[1];
        $shortcode_rid = $shortcode__config[3];
        $all_generated_shortcodes = wpWrapper::mo_epbr_get_option("mo_epbr_all_generated_shortcodes");
        $element=array_search($shortcode_config,$all_generated_shortcodes);
        unset($all_generated_shortcodes[$element]);
        $resource_ids = wpWrapper::mo_epbr_get_option("mo_epbr_resourceids_array");
        if(in_array($shortcode_rid ."=". $shortcode_wid,$resource_ids)){
            $key = array_search($shortcode_rid ."=". $shortcode_wid, $resource_ids, true);
            if ($key !== false) {
                unset($resource_ids[$key]);
            }
        }
        wpWrapper::mo_epbr_set_option("mo_epbr_resourceids_array",$resource_ids);
        wpWrapper::mo_epbr_set_option('mo_epbr_all_generated_shortcodes', $all_generated_shortcodes);
        wpWrapper::mo_epbr__show_success_notice(esc_html__("Shortcode Deleted Successfully."));
    }

    private function mo_epbr_save_resource_config(){
        check_admin_referer('mo_epbr_resource_config_option');
        $wid = isset($_POST['wid']) ? sanitize_text_field($_POST['wid']) : '';
        $rid = isset($_POST['rid']) ? sanitize_text_field($_POST['rid']) : '';
        $height = isset($_POST['height']) ? sanitize_text_field($_POST['height']) : '';
        $width = isset($_POST['width']) ? sanitize_text_field($_POST['width']) : '';
        $dataset_id = isset($_POST['datasetid'])?sanitize_text_field($_POST['datasetid']):'';
        wpWrapper::mo_epbr_set_option('mo_epbr_dataset_id',$dataset_id);
        if(is_numeric($height)){$height=$height."px";}
        if(is_numeric($width)){$width=$width."px";}
        if (!isset($resourceids_arr)) {
            $mo_epbr_resourceids_array = [];
          }
        if(wpWrapper::mo_epbr_get_option("mo_epbr_resourceids_array")) {
            $mo_epbr_resourceids_array = wpWrapper::mo_epbr_get_option("mo_epbr_resourceids_array");
        }

        $generated_shortcode='[MO_API_POWER_BI workspace_id="'.$wid.'" report_id="'.$rid.'" width="'.$width.'" height="'.$height.'" ]';

        if(wpWrapper::mo_epbr_get_option("mo_epbr_all_generated_shortcodes")) {
            $shortcodes_array = wpWrapper::mo_epbr_get_option("mo_epbr_all_generated_shortcodes");
            
            if(! in_array($generated_shortcode, $shortcodes_array) && (! in_array($rid ."=". $wid, $mo_epbr_resourceids_array))) {
                array_push($shortcodes_array,$generated_shortcode);
            }elseif(in_array($rid ."=". $wid,$mo_epbr_resourceids_array)){
                $shortcode_value='[MO_API_POWER_BI workspace_id="'.$wid.'" report_id="'.$rid.'" ';
                $index=0;
                foreach($shortcodes_array as $shortcode ){
                       if(str_contains($shortcode, $shortcode_value)) {
                       $shortcodes_array[$index]=$generated_shortcode;
                    }
                    $index++;
                }
            }
            wpWrapper::mo_epbr_set_option("mo_epbr_all_generated_shortcodes",$shortcodes_array);
        } else {
            $new_shortcodes_array=array($generated_shortcode);
            wpWrapper::mo_epbr_set_option("mo_epbr_all_generated_shortcodes", $new_shortcodes_array );
        }

        if(! in_array($rid,$mo_epbr_resourceids_array)) {
            array_push($mo_epbr_resourceids_array, $rid ."=". $wid);
        }
        wpWrapper::mo_epbr_set_option("mo_epbr_resourceids_array",$mo_epbr_resourceids_array);
        wpWrapper::mo_epbr__show_success_notice(esc_html__("Shortcode Saved Successfully."));

    }

    public function mo_embed_shortcode_power_bi($attrs='',$content='')
    {
        $attrs = shortcode_atts([
            'width'=>'800px',
             'height'=>'800px',
             'workspace_id'=>'',
             'report_id'=>'',
         ],$attrs,'MO_API_POWER_BI');
         if(!isset($attrs['workspace_id']) || !isset($attrs['report_id'])){
             return "";
         }
         $this->config['rid'] = $attrs['report_id'];
         $this->config['wid'] = $attrs['workspace_id'];
         $this->config['width'] = $attrs['width'];
         $this->config['height'] = $attrs['height'];
         
        if(!(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')==false) || !(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post.php')==false) || !(strpos($_SERVER['REQUEST_URI'],'wp-json/wp/v2/pages')==false))
            ob_start();
     
        if(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')==false || !(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post.php')==false) || !(strpos($_SERVER['REQUEST_URI'],'wp-json/wp/v2/pages')==false))
            $content = $this->load_power_bi_content_js(); 
        
        if(!(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')==false) || !(strpos($_SERVER['REQUEST_URI'], 'wp-admin/post.php')==false) || !(strpos($_SERVER['REQUEST_URI'],'wp-json/wp/v2/pages')==false))
            ob_get_clean();

        return $content;
    }

    public function mo_epbr_shortcode_user_not_logged_in_content(){
        $url = wpWrapper::mo_epbr_get_current_page_url();
        $current_wordpress_home_url = home_url() ;
        $loginpage = $current_wordpress_home_url."/wp-admin";
        $content =  '
        <div id="powerbi-embed-not-loggedin_user" style="width:'.$this->config['width'].';height:'.$this->config['height'].';display:flex;justify-content:center;flex-direction:column;align-items:center;color:#000;
        background-image:url('.plugin_dir_url(MO_EPBR_PLUGIN_FILE).'images/restrictedcontent-bg.png'.');background-size:cover;opacity:0.75;">          
        <span style="text-align:center;width:65%;display:inline-block;background:white;"> Please <a onclick="mo_epbr_azure_redirect()" style="color:blue;cursor:pointer;text-decoration:underline;">login</a> via Azure AD to view the Power BI content.</span>
        </div>
        <script>
        document.cookie = "rurlcookie='.$url.'; path=/";
        function mo_epbr_azure_redirect(){window.location.href="'.$loginpage.'";}
        </script>';
        return $content;
    }   

    public function getReportContent()
    {
        $client_config = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
        $handler = azure::getClient($client_config);
        $handler->setScope(pluginConstants::SCOPE_DEFAULT_OFFLINE_ACCESS);
        $access_token = $handler->mo_epbr_get_new_access_token();
        if($access_token){
            $this->config['access_token'] = $access_token;
            $report_details = $this->get_report_details();
            if(isset($report_details['error'])){
                return false;
            }
            if(isset($report_details['datasetId']) || isset($report_details['embedUrl'])) {
                $this->config['datasetId'][0] = $report_details['datasetId'];
                $this->config['embedUrl'] = $report_details['embedUrl'];
                return $access_token;
            }
        }
        return false;
    }

    public function get_report_details(){
        $reports_endpoint = self::$API_ENDPOINT.$this->config['wid'].'/reports/'.$this->config['rid'];
        $headers = [
            'Authorization' => 'Bearer '.$this->config['access_token'],
            'Content-Type' => 'application/json'
        ];
        $handle = Authorization::getController();
        $response = $handle->mo_epbr_get_request($reports_endpoint,$headers);
        if(isset($response['error'])){  return false;  }
        return $response;
    }

    public function load_power_bi_content_js(){
        if(!is_user_logged_in()){
            $content = $this->mo_epbr_shortcode_user_not_logged_in_content();
            return $content;
        } 
        elseif(is_user_logged_in()){
        $token_status = $this->getReportContent();
        if(! $token_status){
            $html = '<div id="powerbi-embed" style="width:'.$this->config['width'].';height:'.$this->config['height'].';display:flex;justify-content:center;flex-direction:column;align-items:center;color:#000;
            background-image:url('.plugin_dir_url(MO_EPBR_PLUGIN_FILE).'images/restrictedcontent-bg.png'.');background-size:cover;
            ">          
            <div style="width:'.$this->config['width'].';height:'.$this->config['height'].';background-color:#3a3a3a;opacity:0.75;position:absolute"></div>
            <span style="font-size:1.2rem;text-align:center;color:#fff;font-weight:700;font-family:sans-serif;z-index:1">The Page is restricted for Premium Users only.</span>
            <span style="font-size:1.2rem;text-align:center;color:#fff;font-weight:700;font-family:sans-serif;z-index:1">Please upgrade to view the content.</span>
            <span style="margin:20px;z-index:1"><a class="restrictedcontent_anchor" style="height:30px;font-size:15px;display:flex;justify-content:center;align-items:center;text-transform:none;text-decoration:none;color:blue;background:white;padding:5px;cursor: pointer;" onclick="window.location.href=\''.home_url().'\'">Go back to site</a></span>
            </div>';
            return $html;
        }else{
            $embedurl= isset($this->config['embedUrl']) ? $this->config['embedUrl']:'';
            $access_token =  isset($this->config['access_token']) ? $this->config['access_token']:'';
            $filterpane = wpWrapper::mo_epbr_get_option('mo_epbr_add_filters_pane')==='1'?"true":"false";
            $pagenav = wpWrapper::mo_epbr_get_option('mo_epbr_add_page_navigation')==='1'?"true":"false";
            $lang = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_selected_language_for_embed'))?wpWrapper::mo_epbr_get_option('mo_epbr_selected_language_for_embed'):'en';
            $localelang = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_selected_locale_language_for_embed'))?wpWrapper::mo_epbr_get_option('mo_epbr_selected_locale_language_for_embed'):'en';
            if($lang){$embedurl=$embedurl."&language=".$lang;}
            if($localelang){$embedurl=$embedurl."&formatLocale=".$localelang;}
            $breakpoint = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_mobile_display_breakpoint'))?wpWrapper::mo_epbr_get_option('mo_epbr_mobile_display_breakpoint'):320;
            $mobileHeight = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_height'))?wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_height'):'100px';
            $mobileWidth = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_width'))?wpWrapper::mo_epbr_get_option('mo_epbr_embed_mobile_width'):'100%';
            $mode = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_res_embed_mode'))?wpWrapper::mo_epbr_get_option('mo_epbr_res_embed_mode'):"";
            $datasetid = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_dataset_id'))?wpWrapper::mo_epbr_get_option('mo_epbr_dataset_id'):""; 
            $content ='<div id="powerbi-embed'.$this->config['rid'].'" style="width:'.$this->config['width'].';height:'.$this->config['height'].';">Loading Content...</div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.19.1/powerbi.min.js" integrity="sha512-JHwXCdcrWLbZo78KFRzEdGcFJX1DRR+gj/ufcoAVWNRrXCxUWj2W2Hxnw61nFfzfWAdWchR9FQcOFjCNcSJmbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.19.1/powerbi.js" integrity="sha512-Mxs/3Mam3+Beg4YdPJjPkwI7yN5GvsOx9J23MM03lrnAzIIGpZB3Eicz7H/TOEfMEyIJNXPAoufedL1I3Zc6Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
            embedConfiguration = {
                type:"report",
                embedUrl: "'. $embedurl .'",
                tokenType: window["powerbi-client"].models.TokenType.Aad,
                accessToken: "'.$access_token.'",
                settings: {
                    filterPaneEnabled: '.$filterpane.',
                        navContentPaneEnabled: '.$pagenav.',
                        background: window["powerbi-client"].models.BackgroundType.Transparent,
                        },
                    localeSettings: {
                    language: "'.$lang.'",
                    formatLocale: "'.$localelang.'",
                        }
            };
            switch("'.$mode.'"){
                case "Edit": 
                            embedConfiguration.viewMode = window["powerbi-client"].models.ViewMode.Edit;
                            embedConfiguration.permissions = window["powerbi-client"].models.Permissions.All;
                            embedConfiguration.allowEdit = true;
                            break;
                case "Create": 
                            embedConfiguration.datasetId = "'.$datasetid.'";
                            embedConfiguration.permissions = window["powerbi-client"].models.Permissions.All;
                            break;
            }

            if("Create" === "'.$mode.'"){
                var report = powerbi.createReport(
                    document.getElementById("powerbi-embed'.$this->config['rid'].'"),embedConfiguration 
                );
            }
            else{
            var report = powerbi.embed(
                document.getElementById("powerbi-embed'.$this->config['rid'].'"),embedConfiguration 
            );}

            var container = document.getElementById("powerbi-embed'.$this->config['rid'].'");
            if("'.$breakpoint.'" !== "" && window.outerWidth <= '.$breakpoint.'){
                container.style.width = "'.$mobileWidth.'";
                container.style.height="'.$mobileHeight.'";
                window.report.on("rendered", function(e){
                    let pages = report.getPages().then(pages => {
                        if(pages.length && '.$pagenav.'){
                            let pagesHTML = "";
                            for(let page in pages){
                                pagesHTML += pages[page].isActive ? `<li class=active>pages[page].displayName</li>` : `<li onclick=\'window.report.setPage(pages[page].name)\'>pages[page].displayName</li>`; 
                            }
                            let mobileNav = `
                                <style>
                                    .powerbi_page_nav {
                                        list-style:none; 
                                        cursor:pointer;
                                        padding: 0;
                                    }
                                    .powerbi_page_nav li {
                                        text-align:center;
                                        padding:15px 0;
                                        width:100%;
                                        border-bottom:1px solid;
                                        background-color: #f3f2f1;
                                        font-size: 16px;
                                    }
                                    .powerbi_page_nav li.active {
                                        background-color:#fff;
                                        border-bottom: 4px solid #f2c811;
                                    }
                                </style>
                                <ul class="powerbi_page_nav">
                                    ${pagesHTML}
                                </ul>    
                            `;
                            let mobileNavE = $(".powerbi_page_nav");
                            if (mobileNavE.length){
                                mobileNavE.html(mobileNav);
                            } else {
                                container.after(mobileNav);
                            }
                            
                        }
                    });
                });
                const newSettings = {
                    layoutType: window["powerbi-client"].models.LayoutType.MobileLandscape
                };
                report.updateSettings(newSettings);
            }
            </script> 
            ';
            return $content;
        }}
    }
}