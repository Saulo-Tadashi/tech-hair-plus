<?php

namespace MoEmbedPowerBI\Observer;

use DateTime;
use DateTimeZone;
use MoEmbedPowerBI\API\Azure;
use MoEmbedPowerBI\API\CustomerEPBR;
use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Wrappers\pluginConstants;

class adminObserver{

    private static $obj;

    public static function getObserver(){
        if(!isset(self::$obj)){
            self::$obj = new adminObserver();
        }
        return self::$obj;
    }
    
    public function mo_epbr_admin_observer(){
        if(isset($_REQUEST['option']) && $_REQUEST['option'] == 'testUser'){
            $option = sanitize_text_field($_REQUEST['option']);
            $config = wpWrapper::mo_epbr_get_option(pluginConstants::APPLICATION_CONFIG_OPTION);
            if(!isset($config['upn_id']) || empty($config['upn_id'])){
                $error_code = [
                     "Error" => "EmptyUPN",
                    "Description" => "UPN is not configured in the plugin or incorrect."
                ];
                $this->mo_epbr_display_error_message($error_code);
            }
            $client = Azure::getClient($config);
            $user_details = $client->mo_epbr_get_specific_user_detail();

            $user_details = wpWrapper::mo_epbr_array_flatten_attributes($user_details);
            if(isset($user_details['error|code'])){
                $this->mo_epbr_display_error_message($user_details);
            }
            $this->mo_epbr_display_test_attributes($user_details);
        }
		if(isset($_REQUEST['option']) && $_REQUEST['option'] == 'mo_epbr_feedback'){	
            $submited = $this->mo_epbr_send_email_alert();
            if ( json_last_error() == JSON_ERROR_NONE ) {
                if ( is_array( $submited ) && array_key_exists( 'status', $submited ) && $submited['status'] == 'ERROR' ) {
                    wpWrapper::mo_epbr__show_error_notice(esc_html__($submited['message']));
                }
                else {
                    if ( $submited == false ) {
                        wpWrapper::mo_epbr__show_error_notice(esc_html__("Error while submitting the query."));
                    }
                }
            }

            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
           
            deactivate_plugins( MO_EPBR_PLUGIN_FILE );
            wpWrapper::mo_epbr__show_success_notice(esc_html__("Thank you for the feedback."));

            wp_redirect(admin_url().'/plugins.php');
            exit();
            
        }
		if(isset($_REQUEST['option']) && $_REQUEST['option'] == 'mo_epbr_skip_feedback'){
            $submited = $this->mo_epbr_send_email_alert(true);
            if ( json_last_error() == JSON_ERROR_NONE ) {
                if ( is_array( $submited ) && array_key_exists( 'status', $submited ) && $submited['status'] == 'ERROR' ) {
                    wpWrapper::mo_epbr__show_error_notice(esc_html__($submited['message']));
                }
                else {
                    if ( $submited == false ) {
                        wpWrapper::mo_epbr__show_error_notice(esc_html__("Error while submitting the query."));
                    }
                }
            }

            wpWrapper::mo_epbr__show_success_notice(esc_html__("Plugin deactivated successfully."));
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
           
            deactivate_plugins( MO_EPBR_PLUGIN_FILE );

            wp_redirect(admin_url().'/plugins.php');
            exit();
        }
        if(isset($_REQUEST['option']) && $_REQUEST['option'] == 'mo_epbr_contact_us_query_option'){
            $submited = $this->mo_epbr_send_support_query();
            if(!is_null($submited)){
                if ( $submited == false ) {
                    wpWrapper::mo_epbr__show_error_notice(esc_html__("Your query could not be submitted. Please try again."));
                } else {
                    wpWrapper::mo_epbr__show_success_notice(esc_html__("Thanks for getting in touch! We shall get back to you shortly."));
                }
            }
        }

	}

    private function mo_epbr_send_email_alert($isSkipped = false){
        $user = wp_get_current_user();

        $message = 'Plugin Deactivated';

        $deactivate_reason_message = array_key_exists( 'query_feedback', $_POST ) ? htmlspecialchars($_POST['query_feedback']) : false;

        if($isSkipped)
            $deactivate_reason_message = "skipped";

        $reply_required = '';
        if(isset($_POST['get_reply']))
            $reply_required = htmlspecialchars($_POST['get_reply']);
        if(empty($reply_required)){
            $reply_required = "don't reply";
            $message.='<b style="color:red";> &nbsp; [Reply :'.$reply_required.']</b>';
        }else{
            $reply_required = "yes";
            $message.='[Reply :'.$reply_required.']';
        }

        if(is_multisite())
            $multisite_enabled = 'True';
        else
            $multisite_enabled = 'False';

        $message.= ', [Multisite enabled: ' . $multisite_enabled .']';
        
        $message.= ', Feedback : '.$deactivate_reason_message.'';
            
        $email = '';
        $rate_value = '';

        if (isset($_POST['rate']))
            $rate_value = htmlspecialchars($_POST['rate']);
        
        $message.= ', [Rating :'.$rate_value.']';

        if (isset($_POST['query_mail']))
            $email = $_POST['query_mail'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = get_option('mo_epbr_admin_email');
            if(empty($email))
                $email = $user->user_email;
        }
        $phone = get_option( 'mo_epbr_admin_phone' );
        $feedback_reasons = new CustomerEPBR();

        $response = json_decode( $feedback_reasons->mo_epbr_send_email_alert( $email, $phone, $message ), true );

        return $response;

    } 
    private function mo_epbr_send_support_query(){
        $email    = sanitize_email($_POST['mo_epbr_contact_us_email']);
        $phone    = htmlspecialchars($_POST['mo_epbr_contact_us_phone']);
        $query    = htmlspecialchars($_POST['mo_epbr_contact_us_query']);

        $query = '[Embed Power BI Reports] ' . $query;
                
        if(array_key_exists('mo_epbr_setup_call',$_POST)===true){
            $time_zone = $_POST['mo_epbr_setup_call_timezone'];
            $call_date = $_POST['mo_epbr_setup_call_date'];
            $call_time = $_POST['mo_epbr_setup_call_time'];

            $local_timezone='Asia/Kolkata';
            $call_datetime=$call_date.$call_time;
            $convert_datetime = strtotime ( $call_datetime );
            $ist_date = new DateTime(date ( 'Y-m-d H:i:s' , $convert_datetime ), new DateTimeZone($time_zone));
            $ist_date->setTimezone(new DateTimeZone($local_timezone));

            $query = $query .  '<br><br>' .'Meeting Details: '.'('.$time_zone.') '. date('d M, Y  H:i',$convert_datetime). ' [IST Time -> '. $ist_date->format('d M, Y  H:i').']'.'<br><br>';

            $query = '[Call Request - Embed Power BI Reports] ' . $query ;
        }

        $customer = new CustomerEPBR();
        $response = $customer->mo_epbr_submit_contact_us($email,$phone,$query);

        return $response;
    }


    private function mo_epbr_display_error_message($error_code){
        ?>
            <div style="width:100%;background-color:#ffebee;display:flex;justify-content:center;align-items:center;font-size:15px;">
                <table class="mo-ms-tab-content-app-config-table">
                    <tr>
                        <td style="padding: 10px 5px 10px 5px;" colspan="2"><h2><span style="color:red;">Test Configuration failed</span></h2></td>
                    </tr>
                    <?php foreach ($error_code as $key => $value){
                       echo '<tr><td style="padding: 10px 5px 10px 5px;" class="left-div"><span style="color:red;margin-right:10px;">'.esc_html($key).':</span></td><td style="padding: 10px 5px 10px 5px;" class="right-div"><span>'.esc_html($value).'</span></td></tr>';
                    }?>
                </table>
            </div>
        <?php
        exit();
    }

    public function mo_epbr_display_test_attributes($details){
        ?>
        <div class="test-container">
            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td style="background: #f1f1f1" colspan="2">
                        <span><h1>Test Attributes:</h1></span>
                    </td>
                </tr>
                <?php
                foreach ($details as $key => $value){
                    if(!is_array($value) && !empty($value)){
                    ?>
                    <tr>
                        <td class="left-div"><span><?php echo esc_html($key);?></span></td>
                        <td class="right-div"><span><?php echo esc_html($value);?></span></td>
                    </tr>
                    <?php
                    }
                }
                ?>
            </table>
        </div>
        <?php
        $this->load_css();
        exit();
    }

    private function load_css(){
        ?>
        <style>
            .test-container{
                width: 100%;
                background: #f1f1f1;
                margin-top: -30px;
            }

            .mo-ms-tab-content-app-config-table{
                max-width: 1000px;
                background: white;
                padding: 1em 2em;
                margin: 2em auto;
                border-collapse:collapse;
                border-spacing:0;
                display:table;
                font-size:14pt;
            }

            .mo-ms-tab-content-app-config-table td.left-div{
                width: 40%;
                word-break: break-all;
                font-weight:bold;
                border:2px solid #949090;
                padding:2%;
            }
            .mo-ms-tab-content-app-config-table td.right-div{
                width: 40%;
                word-break: break-all;
                padding:2%;
                border:2px solid #949090;
                word-wrap:break-word;
            }

        </style>
        <?php
    }
}