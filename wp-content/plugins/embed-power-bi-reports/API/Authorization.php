<?php

namespace MoEmbedPowerBI\API;

use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Observer\adminObserver;
use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\API\Azure;

class Authorization{
    private static $instance;

    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function mo_epbr_get_access_token($endpoints,$config,$scope){
        $args=array();
        if($scope !== pluginConstants::SCOPE_DEFAULT_OFFLINE_ACCESS){
            $args = $this->mo_epbr_get_access_token_using_client_credentials($config,$scope);
        }else{
        $refresh_token = wpWrapper::mo_epbr_get_option('mo_epbr_refresh_token');
        if(empty($refresh_token)){
            $args = $this->mo_epbr_get_token_using_authorization_code($config,$scope);
        }
        elseif(isset($_COOKIE['Oauth_User_Cookie']) && $_COOKIE['Oauth_User_Cookie']=="SSOUser"){
            $args = $this->mo_epbr_get_token_using_refresh_token($config,$scope);
        }
        }
        $client = Azure::getClient($config);
        $args_header = isset($args['headers'])?$args['headers']:"";
        $args_body = isset($args['body'])?$args['body']:"";
        $body = $this->mo_epbr_post_request(esc_url_raw($client->getEndpoints('token')),$args_header,$args_body);
        if(isset($body['error']) && isset($_REQUEST['option']) && $_REQUEST['option']=="testUser"){
            return $body;
        }
        if(isset($body['refresh_token'])){
            wpWrapper::mo_epbr_set_option('mo_epbr_refresh_token',$body['refresh_token']);
        }
        if(isset($body["access_token"])){

            return $body["access_token"];
        }
        return false;
    }

    public function mo_epbr_get_access_token_using_client_credentials($config,$scope){
        $client_secret = wpWrapper::mo_epbr_decrypt_data($config['client_secret'],hash("sha256",$config['client_id']));
        $args =  [
            'body' => [
                'grant_type' => pluginConstants::GRANT_TYPE_CLIENTCRED,
                'client_secret' => $client_secret,
                'client_id' => $config['client_id'],
                'scope' => $scope,
            ],
            'headers' => [
                'Content-type' => pluginConstants::CONTENT_TYPE_VAL
            ]
        ];
        return $args;
    }

    public function mo_epbr_get_token_using_authorization_code($config,$scope){
        $client_secret = wpWrapper::mo_epbr_decrypt_data($config['client_secret'],hash("sha256",$config['client_id']));
        $code = wpWrapper::mo_epbr_get_option("mo_epbr_code");
        $args =  [
            'body' => [
                'grant_type' => pluginConstants::GRANT_TYPE_AUTHCODE,
                'client_secret' => $client_secret,
                'client_id' => $config['client_id'],
                'scope' => $scope,
                'code'=>$code,
                'redirect_uri'=>$config['redirect_uri']
            ],
            'headers' => [
                'Content-type' => pluginConstants::CONTENT_TYPE_VAL
            ]
        ];
        return $args;
    }

    public function mo_epbr_get_token_using_refresh_token($config,$scope){
        $client_secret = wpWrapper::mo_epbr_decrypt_data($config['client_secret'],hash("sha256",$config['client_id']));  
        $refresh_token = wpWrapper::mo_epbr_get_option('mo_epbr_refresh_token');
        $args =  [
            'body' => [
                'grant_type' => pluginConstants::GRANT_TYPE_REFTOKEN,
                'client_secret' => $client_secret,
                'client_id' => $config['client_id'],
                'scope' => $scope,
                'refresh_token'=>$refresh_token,
                'redirect_uri'=>$config['redirect_uri']
            ],
            'headers' => [
                'Content-type' => pluginConstants::CONTENT_TYPE_VAL
            ]
        ];
        return $args;
    }

    public function mo_epbr_get_request($url,$headers){
        $args = [
            'headers' => $headers
        ];
        $response = wp_remote_get(esc_url_raw($url),$args);
        if ( is_array( $response ) && ! is_wp_error( $response ) ) {
            return json_decode($response["body"],true);
        } else {
            error_log("Error occurred: ".esc_html($response->get_error_message()));
            return pluginConstants::Process_Failed;
        }
    }

    public function mo_epbr_post_request($url,$headers,$body){
        $args = [
            'body' => $body,
            'headers' => $headers
        ];
        $response = wp_remote_post(esc_url_raw($url),$args);
        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            error_log("Error Occurred : ".esc_html($error_message));
            return pluginConstants::Process_Failed;
        } else {
            $body= json_decode($response["body"],true);
            return $body;
        }
        return false;
        
    }
}