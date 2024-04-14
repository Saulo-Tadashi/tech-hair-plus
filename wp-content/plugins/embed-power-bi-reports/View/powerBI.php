<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\Wrappers\wpWrapper;

include_once 'support_form.php';

class powerBI{
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
    <h1><b>Add ShortCode by Resource Type</b></h1>
    <div>
        <div class="mo-ms-tab-content-left-border power_bi_tab_content_header">
            <?php $this->mo_epbr_display__powerbi_tab(); ?>
        </div>
    </div>
</div>
<?php
    }

    private function mo_epbr_display__powerbi_tab(){
        $power_bi_embed_url=wpWrapper::mo_epbr_get_option('mo_epbr_power_bi_url');
        $datasetid = !empty(wpWrapper::mo_epbr_get_option('mo_epbr_dataset_id'))?wpWrapper::mo_epbr_get_option('mo_epbr_dataset_id'):""; 
        $shortcodes = wpWrapper::mo_epbr_get_option("mo_epbr_all_generated_shortcodes");
        wp_enqueue_style( 'mo_epbr_css_powerbi_display', plugins_url( '../includes/css/mo_epbr_powerBI_display.css', __FILE__ ) );
        wp_enqueue_style( 'mo_epbr_css_checkboxround', plugins_url( '../includes/css/mo_epbr_appConfig.css', __FILE__ ) );
        ?>

<div class="mo-ms-tab-content-tile col-md-8 mt-4 ms-5 rls_advertise" style="margin-right:10px;background: #f4f4f4;border: 4px solid #d5e2ff;border-radius: 5px;">
            <ul class="form-fields" style="margin-bottom: 17px;"><li class="field check-round slide-inverse" style="float:left;margin-left: -5px;" >
            <input type="checkbox" id="switch-filters-button" name="mo_epbr_add_filters_pane" style="margin-left: 70px;" disabled/>
            <label for="switch-filters-button" class="input_label" style="font-size: 18px;font-weight: 200;"><b>Configure Row Level Security &nbsp &nbsp </b><span style="background: lightgray;"></span></label></li></ul>
        <img class="premium_crown" style="width:3%;position:relative;margin-bottom:-7px;margin-left: 4px;" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />   
        <p class="nameid-prem-text" style="left:425px;top:170px;">This feature is available in Premium version of the plugin. Please <a style="color:#ffd700;cursor:pointer;" href="https://www.miniorange.com/contact" target="_blank">upgrade</a> to use the following functionality.</p>
        <div style="margin-top:21px;"><p>Lets you apply restrictions on data row access in your application. For example, limit user access to rows relevant to their department, or restrict customer access to only the data relevant to their company.</p></div>
</div>

<form class="mo_epbr_ajax_submit_form" action="" method="post" id="mo_epbr_resource_form">
    <input type="hidden" name="option" id="pb_app_config" value="mo_epbr_powerbi_resource_integration">
    <input type="hidden" name="mo_epbr_tab" value="pb_app_config">
    <?php wp_nonce_field('mo_epbr_powerbi_resource_integration');?>
    <div class="mo-ms-tab-content-tile col-md-8 mt-4 ms-5" style="display:flex;margin-top: -7px;margin-bottom: 7px;">
        <div><p class="resource_details"><b>Resource Embed Type </b>
            <select name="res_type" id="res_type_dropdown" style="margin-left:20px;">
                <option value="Report">Report</option>
                <option value="Dashboard">Dashboard</option>
                <option value="Tile">Tile</option>
                <option value="Q&A">Q&A</option>
                <option value="ReportVisual">Report Visual</option>
            </select>
        </p></div>
        <div style="margin-left: 60px;">
        <p class="resource_details" style="margin-left:10px;"><b>Resource Embed Mode </b>
            <select name="res_embed_mode_dropdown" id="res_embed_mode" style="margin-left:20px;" onchange="document.getElementById('mo_epbr_resource_form').submit();" >
                <option value="View" id="view_mode_rad" <?php if(wpWrapper::mo_epbr_get_option('mo_epbr_res_embed_mode')=="View"){ echo "selected"; } ?> >View Mode</option>
                <option value="Edit" id="edit_mode_rad" <?php if(wpWrapper::mo_epbr_get_option('mo_epbr_res_embed_mode')=="Edit"){ echo "selected"; } ?>>Edit Mode</option>
                <option value="Create" id="create_mode_rad" <?php if(wpWrapper::mo_epbr_get_option('mo_epbr_res_embed_mode')=="Create"){ echo "selected"; } ?>>Create Mode</option>
            </select>
        </p>
        </div>
    </div>
</form>

<form class="mo_epbr_ajax_submit_form" action="" method="post" style="margin-right: 10px;" name="formforreport"
    id="report_form">
    <input type="hidden" name="option" id="powerBI_config" value="mo_epbr_resource_config_option">
    <input type="hidden" name="mo_epbr_tab" value="pb_app_config">
    <?php wp_nonce_field('mo_epbr_resource_config_option');?>
    <div class="mo-ms-tab-content-tile">
        <div class="mo-ms-tab-content-tile-content">
            <span class="resource_details"> <b>Resource Details</b></span>
            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td class="left-div"><span>Workspace ID <span class="resource_specific_detail">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Workspace ID" style="width:60%;" name="wid"
                            required type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Resource ID <span class="resource_specific_detail">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Resource ID" style="width:60%;" name="rid"
                            required type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Height <span class="resource_specific_detail">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Height eg.500" style="width:60%;" name="height"
                            required type="text" id="resource_height" oninvalid="this.setCustomValidity('Enter height as numeric or ending with px or %')" oninput="this.setCustomValidity('')"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Width <span class="resource_specific_detail">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Width eg.500" style="width:60%;" name="width"
                            required type="text" id="resource_width" oninvalid="this.setCustomValidity('Enter width as numeric or ending with px or %')" oninput="this.setCustomValidity('')"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Dataset ID</span>
                    </td>
                    <td class="right-div"><input placeholder="Required for Create Mode Only" style="width:60%;" name="datasetid" value="<?php echo esc_html($datasetid);?>"
                            type="text"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
            </table>
            <div style="display:flex;flex-direction:row;">
                <div class="generate_shortcode_div1">
                    <div style="margin:10px;">
                        <input style="height:30px;" type="submit" id="saveButton" class="mo-ms-tab-content-button" onclick="return validate_pbi_report_form()"
                            value="Generate Shortcode">
                    </div>
                </div>
                <div class="view_shortcode_div" >
                    <div style="margin:10px;">
                        <button style="height:30px;width:141px;" id="viewButton" class="mo-ms-tab-content-button" onclick="focusonshortcode()" type="button">View Shortcodes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php if($shortcodes) { ?>
<div style="position:relative;">
    <div style="right: -53px;position: absolute;top: 28px;z-index: 100;">
    <form method="post" id="mo_epbr_delete_allshortcode" action="">
    <input type="hidden" name="option" id="allshortcode_id" value="mo_epbr_allshortcode_delete">
    <input type="hidden" name="mo_epbr_tab" value="pb_app_config">
    <?php wp_nonce_field('mo_epbr_allshortcode_delete');?>
    <a style="position:absolute;left:-9rem;width: 100px;text-decoration:none;color:white;" id="deletebtn" onclick="document.getElementById('confirm_delete').style.display='block'"
        class="mo-ms-tab-content-button" title="Delete all Shortcodes" >Delete All</a>
        <div id="confirm_delete" class="modal">
        <span onclick="document.getElementById('confirm_delete').style.display='none'" class="close" title="Close Modal">&times;</span>
        <div class="modal-content">
            <div class="container">
            <h1>Delete Shortcodes</h1>
            <p>Are you sure you want to delete all shortcodes?</p>
            <div class="clearfix">
                <button type="button" class="cancelbtn" onclick="document.getElementById('confirm_delete').style.display='none'">Cancel</button>
                <button type="button" class="deletebutton" type="submit" onclick="document.getElementById('mo_epbr_delete_allshortcode').submit();">Delete</button>
            </div>
            </div>            
        </div>
        </div>
</form>

    </div>
<form class="shortcode-content" action="" method="post">
    <input type="hidden" name="option" id="shortcode_contentid" value="mo_epbr_shortcode_content">
    <input type="hidden" name="mo_epbr_tab" value="pb_app_config">
    <?php wp_nonce_field('mo_epbr_shortcode_content');?>
    <div class="mo-ms-tab-content-tile col-md-8 mt-4 ms-5" style="margin-right:10px;" id="res_form_output">
        <div class="mo-ms-tab-content-tile-content" style="position:relative;">
            <div style="font-size: 18px;font-weight: 200;display:flex;"><b>ShortCodes Generated</b>
            
            </div></br>
            <?php
            $j=1;
            foreach ( $shortcodes as $value ) {?>
            <form action="" method="post" name="shortcode-containerform" id="shortcode-containerform">
                <div class="shortcode-container">
                    <input type="hidden" name="option" id="shortcode_containerid" value="mo_epbr_shortcode_container" />
                    <input type="hidden" name="mo_epbr_tab" value="pb_app_config" />
                    <input type="hidden" name="mo_epbr_current_clicked_value" value='<?php echo $value ?>' />
                    <?php wp_nonce_field('mo_epbr_shortcode_container');?>
                    <strong class="selected-radio">Report Shortcode <?php echo $j; ?></strong>
                    <div style="background-color:#eee;display:flex;border-left:5px solid #0078d4;">
                        <div class="shortcode-val" style="padding:15px">
                            <?php echo $value; ?>
                        </div>
                        <input type="text" style="display:none" value="<?php echo esc_html($value);?>"
                            id="ShortcodeInput<?php echo $j ?>" />
                        <div class="button-container"  >
                            <div class="tooltip_cshortcode" onmouseout="copyshortcode_msg(<?php echo $j ?>)">
                                <button class="shortcode_copy_button" style="height:70%;margin-top:10px;" onclick="copyshortcode(<?php echo $j ?>)" id="copybtn" type="button">
                                    <span class="dashicons dashicons-admin-page"></span>
                                </button>
                                <span class='tooltiptext_cshortcode' id='custom-copy-shrtcd-tooltip<?php echo $j ?>'>Copy to Clipboard</span>
                            </div>
                            <div class="tooltip_cshortcode">
                                <button class="shortcode_del_button" type="submit" style="height:70%;margin-top:10px;">
                                    <span class="dashicons dashicons-trash" title="Delete Shortcode"></span>
                                </button>
                                <span class='tooltiptext_cshortcode' >Delete Shortcode</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php $j++; } ?>
        </div>
    </div>
</form>
</div>
<?php }  ?>

<form class="mo_epbr_ajax_submit_form" action="" style="margin-right: 10px;" name="formfordashboard"
    id="dashboard_form">
    <div class="mo-ms-tab-content-tile premium_resource_types">
        <div class="mo-ms-tab-content-tile-content">
            <span class="header_span">
                <b style="margin-block-start:12px;">Dashboard Details</b>
                <img class="premium_crown" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />
                <p class="nameid-prem-text" style="left:210px;top:-30px;">This feature is available in Premium version of the plugin. Please <a style="color:#ffd700;cursor:pointer;" href="https://www.miniorange.com/contact" target="_blank">upgrade</a> to use the following functionalities.</p>
            </span>

            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td class="left-div"><span>Workspace ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Workspace ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Dashboard ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Resource ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Height <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Height eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Width <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Width eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td colspan="2"></br></td>
                </tr>
            </table>
            <div class="generate_shortcode_div1">
                <div style="display:flex;margin:10px;">
                    <input style="height:30px;cursor:not-allowed;" type="submit" id="saveButton"
                        value="Generate Shortcode" disabled>
                </div>
            </div>
        </div>
    </div>
</form>


<form class="mo_epbr_ajax_submit_form" action="" style="margin-right: 10px;" name="formforReportVisual"
    id="ReportVisual_form">
    <div class="mo-ms-tab-content-tile premium_resource_types">
        <div class="mo-ms-tab-content-tile-content">
            <span class="header_span">
                <b style="margin-block-start:12px;">Report Visual Details</b>
                <img class="premium_crown" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />
                <p class="nameid-prem-text" style="left: 230px;top: -30px;">This feature is available in Premium version of the plugin. Please <a style="color:#ffd700;cursor:pointer;" href="https://www.miniorange.com/contact" target="_blank">upgrade</a> to use the following functionalities.</p>
            </span>

            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td class="left-div"><span>Report ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Report ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Group ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Group ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Page Name <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Page Name" style="width:60%;cursor:not-allowed;" disabled type="text">
                    </td>
                </tr>
                <tr>
                    <td class="left-div"><span>Visual Name <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Visual Name" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Height <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Height eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Width <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Weight eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td colspan="2"></br></td>
                </tr>
            </table>
            <div class="generate_shortcode_div1">
                <div style="display:flex;margin:10px;">
                    <input style="height:30px;cursor:not-allowed;" type="submit" id="saveButton" 
                        value="Generate Shortcode" disabled>
                </div>
            </div>
        </div>
    </div>
</form>

<form class="mo_epbr_ajax_submit_form" action="" style="margin-right: 10px;" name="formforTile" id="Tile_form">
    <div class="mo-ms-tab-content-tile premium_resource_types">
        <div class="mo-ms-tab-content-tile-content">
            <span class="header_span">
                <b style="margin-block-start:12px;">Tile Details</b>
                <img class="premium_crown" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />
                <p class="nameid-prem-text" style="left:150px;top:-30px;">This feature is available in Premium version of the plugin. Please <a style="color:#ffd700;cursor:pointer;" href="https://www.miniorange.com/contact" target="_blank">upgrade</a> to use the following functionalities.</p>
            </span>

            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td class="left-div"><span>Dashboard ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Dashboard ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Group ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Group ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Tile ID <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Tile Id" style="width:60%;cursor:not-allowed;" disabled type="text">
                    </td>
                </tr>
                <tr>
                    <td class="left-div"><span>Height <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Height eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Width <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Weight eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td colspan="2"></br></td>
                </tr>
            </table>
            <div class="generate_shortcode_div1">
                <div style="display: flex;margin:10px;">
                    <input style="height:30px;cursor:not-allowed;" type="submit" id="saveButton" 
                        value="Generate Shortcode" disabled>
                </div>
            </div>
        </div>
    </div>
</form>

<form class="mo_epbr_ajax_submit_form" action="" style="margin-right: 10px;" name="formforQ&A" id="qa_form">
    <div class="mo-ms-tab-content-tile premium_resource_types">
        <div class="mo-ms-tab-content-tile-content">
            <span class="header_span">
                <b style="margin-block-start:12px;">Q&A Details</b>
                <img class="premium_crown" src="<?php echo plugin_dir_url( __FILE__ ) . '../images/crown.png'; ?>" />
                <p class="nameid-prem-text" style="left: 160px;top: -30px;">This feature is available in Premium version of the plugin. Please <a style="color:#ffd700;cursor:pointer;" href="https://www.miniorange.com/contact" target="_blank">upgrade</a> to use the following functionalities.</p>
            </span>

            <table class="mo-ms-tab-content-app-config-table">
                <tr>
                    <td class="left-div"><span>Q&A Input Question <span
                                style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Q&A Input Question" style="width:60%;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Group ID <span style="color:red;font-weight:bold;">*</span></span>
                    </td>
                    <td class="right-div"><input placeholder="Enter Your Group ID" style="width:60%;cursor:not-allowed;" disabled
                            type="text"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Dataset ID <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Dataset Id" style="width:60%;cursor:not-allowed;" disabled type="text">
                    </td>
                </tr>
                <tr>
                    <td class="left-div"><span>Height <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Height eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td class="left-div"><span>Width <span style="color:red;font-weight:bold;">*</span></span></td>
                    <td class="right-div"><input placeholder="Enter Weight eg.500" style="width:60%;cursor:not-allowed;" disabled
                            type="number"></td>
                </tr>
                <tr>
                    <td colspan="2"></br></td>
                </tr>
            </table>
            <div class="generate_shortcode_div1">
                <div style="display: flex;margin:10px;">
                    <input style="height:30px;cursor:not-allowed;" type="submit" id="saveButton"
                        value="Generate Shortcode" disabled>
                </div>
            </div>
        </div>
    </div>
</form>




<?php    
    }
}