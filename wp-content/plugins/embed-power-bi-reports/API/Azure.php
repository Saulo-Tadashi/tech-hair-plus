<?php

namespace MoEmbedPowerBI\API;

class Azure{

    private static $obj;
    private $endpoints;
    private $config;
    private $scope = "https://graph.microsoft.com/.default";
    private $handler;

    private function __construct($config){
        $this->config = $config;
        $this->handler = Authorization::getController();
    }

    public static function getClient($config){
        if(!isset(self::$obj)){
            self::$obj = new Azure($config);
            self::$obj->setEndpoints();
        }
        return self::$obj;
    }

    private function setEndpoints(){
        $this->endpoints['authorize'] = 'https://login.microsoftonline.com/'.$this->config['tenant_id'].'/oauth2/v2.0/authorize';
        $this->endpoints['token'] = 'https://login.microsoftonline.com/'.$this->config['tenant_id'].'/oauth2/v2.0/token';
        $this->endpoints['users'] = 'https://graph.microsoft.com/beta/users/';
    }

    public function getEndpoints($endpoint){
        if($endpoint=='token'){return $this->endpoints['token'];}
        if($endpoint=='authorize'){return $this->endpoints['authorize'];}
        if($endpoint=='users'){return $this->endpoints['users'];}
    }

    public function mo_epbr_get_specific_user_detail(){
        $this->access_token = $this->handler->mo_epbr_get_access_token($this->endpoints,$this->config,$this->scope);
        $args = [
            'Authorization' => 'Bearer '.$this->access_token
        ];
        $user_info_url = $this->endpoints['users'].$this->config['upn_id'];
        $users = $this->handler->mo_epbr_get_request($user_info_url,$args);
        if(!is_array($users) || count($users)<=0){
            wp_die(esc_html("Unknown error occurred. Please try again later."));
        }
        return $users;
    }
    
    public function mo_epbr_get_new_access_token(){
        $access_token = $this->handler->mo_epbr_get_access_token($this->endpoints,$this->config,$this->scope);
        if(!isset($access_token['error'])){
            $this->access_token = $access_token;
            $this->args = [
                'Authorization' => 'Bearer '.$access_token
            ];
            return $access_token;
        }
        return false;
    }
    public function setScope($scopes){
        $this->scope = $scopes;
    }
}