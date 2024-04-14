<?php

/*
Plugin Name: PowerBI Embed Reports
Plugin URI: https://plugins.miniorange.com/
Description: This plugin will allow you to embed Microsoft Power BI reports, dashboards, tiles, Q & A, etc in the WordPress site.
Version: 1.1.5
Author: miniOrange
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

namespace MoEmbedPowerBI;
require_once __DIR__ . '/vendor/autoload.php';

use MoEmbedPowerBI\Controller\powerBIConfig;
use MoEmbedPowerBI\View\adminView;
use MoEmbedPowerBI\Controller\adminController;
use MoEmbedPowerBI\Observer\adminObserver;
use MoEmbedPowerBI\View\feedbackForm;
use MoEmbedPowerBI\LoginFlow\LoginButton;
use MoEmbedPowerBI\LoginFlow\OAuthSSO;

define('MO_EPBR_PLUGIN_FILE',__FILE__);

class MOEPBR{

    private static $instance;

    public static function mo_epbr_load_instance(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
            self::$instance->mo_epbr_load_hooks();
        }
        return self::$instance;
    }

    public function mo_epbr_load_hooks(){
        add_action( 'login_form', [LoginButton::getController(),'mo_epbr_login_button' ]);
        add_action('init',[OAuthSSO::getController(),'mo_epbr_perform_sso']);
        add_action('wp_login',[$this,'mo_epbr_redirect_user'],10,2);

        add_action('admin_menu',[$this,'mo_epbr_admin_menu']);
        add_action( 'admin_enqueue_scripts', [$this, 'mo_epbr_settings_style' ] );
        add_action( 'admin_enqueue_scripts', [$this, 'mo_epbr_settings_script' ] );
        add_action( 'admin_footer', [feedbackForm::getView() , 'mo_epbr_display_feedback_form'] );
        add_action('admin_init',[adminController::getController(),'mo_epbr_admin_controller']);
        add_action('init',[adminObserver::getObserver(),'mo_epbr_admin_observer']);
        add_shortcode('MO_API_POWER_BI',[powerBIConfig::getController(),'mo_embed_shortcode_power_bi']);
    }

    public function mo_epbr_admin_menu(){
        $page = add_menu_page(
            'WP Embed Power BI reports Settings ' .__('API Configuration'),
            'Embed Power BI Reports',
            'administrator',
            'mo_epbr',
            [adminView::getView(),'mo_epbr_menu_display'],
            plugin_dir_url( __FILE__ ) . 'images/miniorange.png'
        );
    }

    function mo_epbr_redirect_user(){  
            $current_wordpress_home_url = home_url();
            if(isset($_COOKIE['rurlcookie']) && !empty($_COOKIE['rurlcookie']))
            {$rurl = $_COOKIE['rurlcookie'];}else{$rurl = "";};
            if(isset($_COOKIE['rurlcookie'])){echo "<script>window.location.href = '$rurl'</script>";}
            else{echo "<script>window.location.href = '$current_wordpress_home_url'</script>";}
        exit;
    }

    function mo_epbr_settings_style($page){
        if( $page != 'toplevel_page_mo_epbr'){
            return;
        }
        $css_url = esc_url(plugins_url('includes/css/mo_epbr_settings.css',__FILE__));
        wp_enqueue_style('mo_epbr_css',$css_url,array());
        $css_license_view_url = plugins_url('includes/css/license.css',__FILE__);
        wp_enqueue_style('mo_epbr_license_view_css',$css_license_view_url,array());
        if((isset($_REQUEST['page']) && $_REQUEST['page'] == 'mo_epbr')){
        wp_enqueue_style( 'mo_power_bi_phone_css', esc_url(plugins_url( 'includes/css/phone.css', __FILE__ )),array());
        wp_enqueue_style( 'mo_power_bi_date_time_css', esc_url(plugins_url( 'includes/css/datetime_style_settings.css', __FILE__ )),array());  
        wp_enqueue_style( 'mo_epbr_css_powerbi_demo', plugins_url( '/includes/css/mo_epbr_demorequest.css', __FILE__ ) ); 
        }
    }

    function mo_epbr_settings_script($page){
        if( $page != 'toplevel_page_mo_epbr'){
            return;
        }
        $phone_js_url = plugins_url('includes/js/phone.js',__FILE__);
        $timepicker_js_url = plugins_url('includes/js/timepicker.min.js',__FILE__);
        $select2_js_url = plugins_url('includes/js/select2.min.js',__FILE__);
        wp_enqueue_script('jquery-ui-datepicker'); 
        wp_enqueue_script('mo_epbr_phone_js',$phone_js_url,array());
        wp_enqueue_script('mo_epbr_timepicker_js',$timepicker_js_url,array());
        wp_enqueue_script('mo_epbr_select2_js',$select2_js_url,array());
        wp_enqueue_script ('mo_epbr_js_powerbi_display', plugins_url('includes/js/mo_epbr_powerBI_display.js', __FILE__ ));

    }

}
MOEPBR::mo_epbr_load_instance();