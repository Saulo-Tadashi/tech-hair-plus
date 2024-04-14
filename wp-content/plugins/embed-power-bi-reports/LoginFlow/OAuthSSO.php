<?php
namespace MoEmbedPowerBI\LoginFlow;

use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\API\Authorization;

class OAuthSSO{

    private static $instance;
    public static function getController(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    } 

    function mo_epbr_perform_sso() {

        if(isset($_GET['option'])) {
            if($_GET['option']=='oauthlogin') {
                $this->mo_epbr_config_oauth();
            }
        }

        if(isset($_COOKIE['Oauth_User_Cookie']) && !is_user_logged_in()){
            echo "<script> document.cookie = 'Oauth_User_Cookie=UsedCookie;path=/;max-age=0;' </script>";
        }

        if(isset($_REQUEST['code']) && !empty($_REQUEST['code'] && $_REQUEST['state']=="cGhvdG9zeW5j")){
            $code = sanitize_text_field($_REQUEST['code']);
            wpWrapper::mo_epbr_set_option("mo_epbr_code", $code);
            $this-> mo_epbr_retrieve_access_token($code);
        }
    }

        function mo_epbr_config_oauth(){
            if(! isset($_REQUEST['code'])){
            $app = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
            $client_id = !empty($app['client_id'])?$app['client_id']:exit();
            $redirect_uri = !empty($app['redirect_uri'])?$app['redirect_uri']:site_url();
            $tenant_id = !empty($app['tenant_id'])?$app['tenant_id']:'';
            $scope = "openid email";
            $authorizeURL = wpWrapper::mo_epbr_get_url_endpoint()."authorize";
            $authorizationRedirectUrl = $authorizeURL."?response_type=code&client_id=".$client_id."&redirect_uri=".$redirect_uri."&state=cGhvdG9zeW5j&scope=".$scope;
            header("Location: ".$authorizationRedirectUrl);
            exit();}
           } 
    
        function  mo_epbr_retrieve_access_token($authorization_code){
            $app = wpWrapper::mo_epbr_get_option('mo_epbr_application_config');
            $clientid = $app['client_id'];
            if(!$clientid){
                return;
            }
            $redirectUrl = !empty($app['redirect_uri'])?$app['redirect_uri']:site_url();
            $tenantid = !empty($app['tenant_id'])?$app['tenant_id']:'';
            if(isset($app['client_secret']) && !empty($app['client_secret'])){
                $clientsecret = wpWrapper::mo_epbr_decrypt_data($app['client_secret'],hash("sha256",$clientid));
            }else{
                $clientsecret = '';
            }
            $scope = "openid email offline_access";
            $token_endpoint = wpWrapper::mo_epbr_get_url_endpoint()."token";
            $headers = array(
                'Accept'        => 'application/json',
                'charset'       => 'UTF - 8',
                'Content-Type'  => pluginConstants::CONTENT_TYPE_VAL,
            );
            $body = array(
                'grant_type'    => pluginConstants::GRANT_TYPE_AUTHCODE,
                'client_id'     => $clientid,
                'client_secret' => $clientsecret,
                'scope'         => $scope ,
                'redirect_uri'  => $redirectUrl,
                'code'          => $authorization_code,
            );
            foreach ( $body as $key => $value ) {
                $body[ $key ] = html_entity_decode( $value );
            }
            $controller =  Authorization::getController();
            $content = $controller->mo_epbr_post_request(esc_url_raw($token_endpoint),$headers,$body);
            $access_token = !empty($content['access_token'])?$content['access_token']:'';
            $refresh_token = !empty($content['refresh_token'])?$content['refresh_token']:'';
            wpWrapper::mo_epbr_set_option('mo_epbr_refresh_token', $refresh_token);
            echo "<script> document.cookie = 'Oauth_User_Cookie=SSOUser; path=/';</script>";
            $this->mo_epbr_login_validate($access_token);
    }

    function mo_epbr_login_validate($access_token)
    {           
            $exploded_access_token = explode('.',$access_token);
            $decoded_access_token = isset($exploded_access_token)?json_decode(base64_decode($exploded_access_token[1]),true):"";
            if(isset($decoded_access_token["upn"])){
                $email_id = $decoded_access_token["upn"];
            }
            $user = isset($email_id)?get_user_by("login",$email_id):"";
            if($user){
                $user_id = $user->ID;
                wp_set_current_user($user->ID);
                wp_set_auth_cookie($user->ID);
                $user  = get_user_by( 'ID',$user->ID );
                do_action( 'wp_login', $user->user_login, $user );
                wp_redirect(home_url());						
                exit;
            } 
            else{
            isset($email_id)?$this->mo_epbr_handle_user_register($email_id):"";
            }
    }

     function mo_epbr_handle_user_register($email_id)
     { 
        $random_password = wp_generate_password( 10, false );
        if( strlen($email_id) > 60 ){	
            wp_die( $message = 'You are not allowed to login. Please contact your administrator' );
         }
        $user_id = 	wp_create_user( $email_id, $random_password,$email_id);
        $user = get_user_by( 'login', $email_id);			
        wp_update_user( array( 'ID' => $user_id ) );
        wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID);
        $user  = get_user_by( 'ID',$user->ID );
		do_action( 'wp_login', $user->user_login, $user );
		wp_redirect(home_url());						
		exit;
     }

    }
