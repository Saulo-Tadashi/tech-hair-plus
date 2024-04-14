<?php

namespace MoEmbedPowerBI\Wrappers;

class wpWrapper{

    private static $instance;

    public static function getWrapper(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public static function mo_epbr_set_option($key, $value){
        update_option($key,$value);
    }

    public static function mo_epbr_get_option($key){
        return get_option($key);
    }

    public static function mo_epbr_delete_option($key){
        return delete_option($key);
    }

    public static function mo_epbr__show_error_notice($message){
        self::mo_epbr_set_option(pluginConstants::notice_message,$message);
        $hook_name = 'admin_notices';
        remove_action($hook_name,[self::getWrapper(),'mo_epbr_success_notice']);
        add_action($hook_name,[self::getWrapper(),'mo_epbr_error_notice']);
    }

    public static function mo_epbr__show_success_notice($message){
        self::mo_epbr_set_option(pluginConstants::notice_message,$message);
        $hook_name = 'admin_notices';
        remove_action($hook_name,[self::getWrapper(),'mo_epbr_error_notice']);
        add_action($hook_name,[self::getWrapper(),'mo_epbr_success_notice']);
    }

    public function mo_epbr_success_notice(){
        $class = "updated";
        $message = self::mo_epbr_get_option(pluginConstants::notice_message);
        echo "<div class='" . esc_attr($class) . "'> <p>" . esc_html($message) . "</p></div>";
    }

    public function mo_epbr_error_notice(){
        $class = "error";
        $message = self::mo_epbr_get_option(pluginConstants::notice_message);
        echo "<div class='" . esc_attr($class) . "'> <p>" . esc_html($message) . "</p></div>";
    }

    /**
     * @param string $data - the key=value pairs separated with &
     * @return string
     */
    public static function mo_epbr_encrypt_data($data, $key) {
        $key    = openssl_digest($key, 'sha256');
        $method = 'aes-128-ecb';
        $strCrypt = openssl_encrypt ($data, $method, $key,OPENSSL_RAW_DATA||OPENSSL_ZERO_PADDING);
        return base64_encode($strCrypt);
    }


    /**
     * @param string $data - crypt response from Sagepay
     * @return string
     */
    public static function mo_epbr_decrypt_data($data, $key) {
        $strIn = base64_decode($data);
        $key    = openssl_digest($key, 'sha256');
        $method = 'AES-128-ECB';
        $ivSize = openssl_cipher_iv_length($method);
        $iv     = substr($strIn,0,$ivSize);
        $data   = substr($strIn,$ivSize);
        $clear  = openssl_decrypt ($data, $method, $key, OPENSSL_RAW_DATA||OPENSSL_ZERO_PADDING, $iv);

        return $clear;
    }

    public static function mo_epbr_array_flatten_attributes($details){
        $arr = [];
        foreach ($details as $key => $value){
            if(empty($value)){continue;}
            if(!is_array($value)){
                $arr[$key] = sanitize_text_field($value);
            }else{
                wpWrapper::mo_epbr_flatten_lvl_2($key,$value,$arr);
            }
        }
        return $arr;
    }

    public static function mo_epbr_flatten_lvl_2($index,$arr,&$haystack){
        foreach ($arr as $key => $value) {
            if(empty($value)){continue;}
            if(!is_array($value)){
                if(!strpos(strtolower($index),'error'))
                    $haystack[$index."|".$key] = $value;
            }else{
                wpWrapper::mo_epbr_flatten_lvl_2($index."|".$key,$value,$haystack);
            }
        }
    }

    public static function mo_epbr_get_current_page_url()
    {
        $http_host = sanitize_url($_SERVER['HTTP_HOST']);
        $is_https = (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') == 0);
    
        if(filter_var($http_host, FILTER_VALIDATE_URL)) {
            $http_host = parse_url($http_host, PHP_URL_HOST);
        }
        $request_uri = sanitize_url($_SERVER['REQUEST_URI']);
        if (substr($request_uri, 0, 1) == '/') {
            $request_uri = substr($request_uri, 1);
        }
        if (strpos($request_uri, '?option=saml_user_login') !== false) {
            return strtok(sanitize_url($_SERVER["REQUEST_URI"]), '?');
        }
        $relay_state = 'http' . ($is_https ? 's' : '') . '://' . $http_host . '/' . $request_uri;
        return $relay_state;
    }

    public static function mo_epbr_get_url_endpoint(){
        $app = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
        $tenantid = !empty($app['tenant_id'])?$app['tenant_id']:'';
        $endpoint_url = "https://login.microsoftonline.com/".$tenantid."/oauth2/v2.0/";
        return $endpoint_url;
    }

    public static function mo_epbr_is_customer_registered() {

        $email       = get_option( 'mo_epbr_admin_email_setup' );
        $customerKey = get_option( 'mo_epbr_admin_customer_key' );

        if ( ! $email || ! $customerKey || ! is_numeric( trim( $customerKey ) ) ) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function mo_api__checkPasswordPattern($password)
    {
        $pattern = '/^[(\w)*(\!\@\#\$\%\^\&\*\.\-\_)*]+$/';
        return !preg_match($pattern, $password);
    }

    public static function mo_epbr_sync_wp_remote_call($url, $args = array(), $is_get=false){
        if(!$is_get)
            $response = wp_remote_post($url, $args);
        else
            $response = wp_remote_get($url, $args);
        if(!is_wp_error($response)){
            return $response['body'];
        } else {
            self::mo_epbr__show_error_notice('Unable to connect to the Internet. Please try again.');
            error_log("Unable to connect to the Internet, following error occured : "+$response['body']);
            return false;
        }
    }

    public static function mo_epbr_deactivate(){
        delete_option('mo_epbr_admin_password');
        delete_option('mo_epbr_admin_customer_key');
        delete_option('mo_epbr_admin_api_key');
        delete_option('mo_epbr_customer_token');
    }
}