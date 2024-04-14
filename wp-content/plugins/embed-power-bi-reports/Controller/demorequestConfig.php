<?php

namespace MoEmbedPowerBI\Controller;

use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\Wrappers\wpWrapper;

class demorequestConfig{
    private static $instance;
    private static $API_ENDPOINT = pluginConstants::API_ENDPOINT_VAL;
    private $config = [];
	static $status="Demo Request Successful";
	
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
            case 'mo_epbr_demo_request_option':{
                $this->mo_epbr_request_demo();
                break;
            }
        }
    }

    private function mo_epbr_request_demo(){ 
        check_admin_referer('mo_epbr_demo_request_option');
		$demo_request = array();
		$demo_request['mo_epbr_demo_email'] = isset($_POST['mo_epbr_demo_email']) ? sanitize_email($_POST['mo_epbr_demo_email']) : get_option('mo_epbr_admin_email');
		$demo_request['mo_epbr_demo_plan'] = 'Premium Plan';

		if(!self::mo_epbr_validate_demo_request_fields($demo_request))
			return;

		$demo_request['mo_epbr_demo_description'] = sanitize_text_field($_POST['mo_epbr_demo_description']);
		foreach(pluginConstants::features_advertise as $key => $value){
			if(isset($_POST[$key]) && $_POST[$key] == "true")
				$features_selected[$key] = $value;
		}
		$demo_request['mo_epbr_features_request'] = $features_selected;
        foreach(pluginConstants::Integrations as $key => $value){
			if(isset($_POST[$key]) && $_POST[$key] == "true")
				$Integration_selected[$key] = $value;
		}
		$demo_request['mo_epbr_demo_integrations_request'] = $Integration_selected;
		$query = self::set_demo_query($demo_request);
		self::send_demo_request($query);
        wpWrapper::mo_epbr__show_success_notice("Thank you for contacting us.We will get back to you shortly via email.");
    }

    private function mo_epbr_validate_demo_request_fields($demo_request){
        $validate_fields_array = array($demo_request['mo_epbr_demo_email'], $demo_request['mo_epbr_demo_plan']);
		if(self::mo_epbr_check_empty_or_null($validate_fields_array)) {
			$post_save = wpWrapper::mo_epbr__show_error_notice("CONTACT_EMAIL_EMPTY");
			self::$status = __('Error: Email address or Demo plan is Empty','miniorange-epbr');
		}
		if (!filter_var($demo_request['mo_epbr_demo_email'],FILTER_VALIDATE_EMAIL)) {
			$post_save = wpWrapper::mo_epbr__show_error_notice("CONTACT_EMAIL_INVALID");
		}
		if(isset($post_save)) {
			return false;
		}
		return true;
    }

    public static function mo_epbr_check_empty_or_null( $validate_fields_array ) {
		foreach ( $validate_fields_array as $fields ) {
			if ( !isset( $fields ) || empty( $fields ) )
	        return true;
	    }
	    return false;
	}

    private function set_demo_query($demo_request){
		$plan_name = 'Premium Plan';
		$message = "[Demo For Customer] : " . $demo_request['mo_epbr_demo_email'];
		$message .= " <br>[Selected Plan] : " . $plan_name;

		if(!empty($demo_request['mo_epbr_demo_description']))
			$message .= " <br>[Requirements] : " . $demo_request['mo_epbr_demo_description'];

		$message .= " <br>[Status] : " .self::$status;

		if(!empty($demo_request['mo_epbr_demo_integrations_request'])){
			$message .= " <br>[Integrations Requested] : ";
			foreach($demo_request['mo_epbr_demo_integrations_request'] as $key => $value){
				$message .= $value;
				if(next($demo_request['mo_epbr_demo_integrations_request']))
					$message .= ", ";
			}
		}
		if(!empty($demo_request['mo_epbr_features_request'])){
			$message .= " <br>[Features Requested] : ";
			foreach($demo_request['mo_epbr_features_request'] as $key => $value){
				$message .= $value;
				if(next($demo_request['mo_epbr_features_request']))
					$message .= ", ";
			}
		}

		return $message;
    }

    private function send_demo_request($query){
		$user = wp_get_current_user();
		$email = !empty($_POST['mo_epbr_demo_email']) ? sanitize_text_field($_POST['mo_epbr_demo_email']) : get_option("mo_epbr_admin_email");
		$phone = !empty(get_option( 'mo_epbr_admin_phone')) ? get_option( 'mo_epbr_admin_phone'):"" ;
		$demo_status = strpos(self::$status,"Error");

		$response =  $this->send_email_alert( $email, $phone, $query, true );

		if (is_array($response) && array_key_exists('status', $response) && $response['status'] == 'ERROR') {
			$post_save = wpWrapper::mo_epbr__show_error_notice($response['message']);
		}
		else if ($response == false || $demo_status !== false) {
			$post_save =  wpWrapper::mo_epbr__show_error_notice(self::$status);
		}
		else if (json_last_error() == JSON_ERROR_NONE) {
			$post_save = wpWrapper::mo_epbr__show_success_notice("Query Submitted");
		}
    }

	function send_email_alert($email,$phone,$message, $demo_request=false){
		$url = pluginConstants::HOSTNAME . '/moas/rest/customer/contact-us';
		global $user;
		$user         = wp_get_current_user();
		$query        = '[Embed Power BI Reports ]: ' . $message;
		$fields = array (
			'firstName' => $user->user_firstname,
			'lastName' => $user->user_lastname,
			'company' => $_SERVER ['SERVER_NAME'],
			'email' => $email,
			'ccEmail'=>'samlsupport@xecurify.com',
			'phone' => $phone,
			'query' => $query
		);
		$field_string = json_encode ( $fields );
		$headers = array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic");
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '10',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = wp_remote_post($url, $args);
		return $response;
	}
	function get_timestamp() {
		$url = pluginConstants::HOSTNAME . '/moas/rest/mobile/get-timestamp';
		$response = wp_remote_post($url);
		return $response;
	}
}