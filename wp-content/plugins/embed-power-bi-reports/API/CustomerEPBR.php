<?php
namespace MoEmbedPowerBI\API;

use MoEmbedPowerBI\Wrappers\pluginConstants;
use MoEmbedPowerBI\Wrappers\wpWrapper;

/**
 * This library is miniOrange Authentication Service.
 *
 * Contains Request Calls to Customer service.
 */

class CustomerEPBR {
	public $email;
	public $phone;

   /*
	 * * Initial values are hardcoded to support the miniOrange framework to generate OTP for email.
	 * * We need the default value for creating the first time,
	 * * As we don't have the Default keys available before registering the user to our server.
	 * * This default values are only required for sending an One Time Passcode at the user provided email address.
	 */
    private $defaultCustomerKey = "16555";
    private $defaultApiKey = "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";
	
	function mo_epbr_send_email_alert($email,$phone,$message, $demo_request=false){

		$url = pluginConstants::HOSTNAME . '/moas/api/notify/send';

		$customerKey = $this->defaultCustomerKey;
		$apiKey =  $this->defaultApiKey;

		$currentTimeInMillis = $this->mo_epbr_get_timestamp();
		$currentTimeInMillis = number_format ( $currentTimeInMillis, 0, '', '' );
		$stringToHash 		= $customerKey .  $currentTimeInMillis . $apiKey;
		$hashValue 			= hash("sha512", $stringToHash);
		$fromEmail			= 'no-reply@xecurify.com';
		$subject            = "Feedback: Embed Power BI reports";
		if($demo_request)
			$subject = "DEMO REQUEST: Embed Power BI reports";

		global $user;
		$user         = wp_get_current_user();


		$query        = '[Embed Power BI reports]: ' . $message;


		$content='<div >Hello, <br><br>First Name :'.$user->user_firstname.'<br><br>Last  Name :'.$user->user_lastname.'   <br><br>Company :<a href="'.$_SERVER['SERVER_NAME'].'" target="_blank" >'.$_SERVER['SERVER_NAME'].'</a><br><br>Phone Number :'.$phone.'<br><br>Email :<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br><br>Query :'.$query.'</div>';


		$fields = array(
			'customerKey'	=> $customerKey,
			'sendEmail' 	=> true,
			'email' 		=> array(
								'customerKey' 	=> $customerKey,
								'fromEmail' 	=> $fromEmail,
								'bccEmail' 		=> $fromEmail,
								'fromName' 		=> 'Xecurify',
								'toEmail' 		=> 'info@xecurify.com',
								'toName' 		=> 'samlsupport@xecurify.com',
								'bccEmail'		=> 'samlsupport@xecurify.com',
								'subject' 		=> $subject,
								'content' 		=> $content
								),
		);
		$field_string = json_encode($fields);

		$headers = array(
			"Content-Type" => "application/json",
			"Customer-Key" => $customerKey,
			"Timestamp" => $currentTimeInMillis,
			"Authorization" => $hashValue
		);
		$args = array(
			'method' => 'POST',
			'body' => $field_string,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => $headers
		);
		$response = wp_remote_post(esc_url_raw($url),$args);
		
		if(!is_wp_error($response)){
			return $response['body'];
		} else {
			wpWrapper::mo_epbr__show_error_notice('Unable to connect to the Internet. Please try again.');
			return null;
        }

	}

	

		function mo_epbr_submit_contact_us($email, $phone, $query) {
			$url = pluginConstants::HOSTNAME. '/moas/rest/customer/contact-us';
			$current_user = wp_get_current_user();
	
			$fields = array (
				'firstName' => $current_user->user_firstname,
				'lastName' => $current_user->user_lastname,
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
				'redirection' => '6',
				'httpversion' => '1.0',
				'blocking' => true,
				'headers' => $headers
			);
			$response = wp_remote_post(esc_url_raw($url),$args);
		
			if(!is_wp_error($response)){
				return $response['body'];
			} else {
				wpWrapper::mo_epbr__show_error_notice('Unable to connect to the Internet. Please try again.');
				return null;
			}
			
	
		}

		function mo_epbr_get_timestamp() {
			$url = pluginConstants::HOSTNAME . '/moas/rest/mobile/get-timestamp';
			$response = wp_remote_post(esc_url_raw($url));
			return $response['body'];
	
		}

		function mo_epbr_check_customer() {
			$url = pluginConstants::HOSTNAME . "/moas/rest/customer/check-if-exists";
	
			$email = get_option ( "mo_epbr_admin_email_setup" );
	
			$fields = array (
					'email' => $email
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
			$response = wpWrapper::mo_epbr_sync_wp_remote_call($url,$args);
			return $response;
	
		}
	
		function mo_epbr_get_customer_key() {
			$url = pluginConstants::HOSTNAME . "/moas/rest/customer/key";
	
			$email = get_option ( "mo_epbr_admin_email_setup" );
	
			$password = get_option ( "mo_epbr_admin_password" );
	
			$fields = array (
					'email' => $email,
					'password' => $password
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
			$response = wpWrapper::mo_epbr_sync_wp_remote_call($url,$args);
			return $response;
	
		}

		function mo_epbr_create_customer() {
			$url = pluginConstants::HOSTNAME . '/moas/rest/customer/add';
			
			$this->email = get_option ( 'mo_epbr_admin_email_setup' );
			$password = get_option ( 'mo_epbr_admin_password' );
	
			$fields = array (
					'areaOfInterest' => 'WP Embed Power BI Content',
					'email' => $this->email,
					'password' => $password
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
			$response = wpWrapper::mo_epbr_sync_wp_remote_call($url,$args);
			return $response;
	
		}
	}

?>