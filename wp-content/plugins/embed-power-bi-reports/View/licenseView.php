<?php

namespace MoEmbedPowerBI\View;

use MoEmbedPowerBI\Wrappers\wpWrapper;
use MoEmbedPowerBI\Wrappers\pluginConstants;

class licenseView
{
    private static $instance;
    public static function getView()
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }


    public function mo_epbr_display_licensing_view()
    {
        $this->mofinalview();
    }




    public function  mo_epbr_license()
    {

        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace("licensing_plans", "account_setup", $url)
?>
    <a id="mobacktoaccountsetup" style="display:none;" href="<?php echo esc_url(add_query_arg(array('tab' => 'account_setup_tab'), sanitize_url($_SERVER['REQUEST_URI']))); ?>"><?php esc_html_e('Back', 'miniorange-embed-power-bi-reports'); ?></a>
        <input type="hidden" value="<?php echo wpWrapper::mo_epbr_is_customer_registered(); ?>" id="mo_customer_registered">
        <form style="display:none;" id="loginform" action="<?php echo pluginConstants::NEW_HOSTNAME . '/initializePayment?requestOrigin=wp_power_bi_premium_plan'; ?>" target="_blank" >
            <input type="email" name="username" value="<?php echo get_option('mo_epbr_admin_email'); ?>" />
            <input type="text" name="redirectUrl" value="<?php echo  pluginConstants::NEW_HOSTNAME . '/initializePayment?requestOrigin=wp_power_bi_premium_plan'; ?>" />
            <input type="text" name="requestOrigin" id="requestOrigin" />
        </form>

        <div class="license-plan-box-saml" id="box2">
            <table id="mo_lv_table" class="w-full" style="width:100%;">
                <colgroup>
                    <col>
                    <col class="bg-gray-50">
                    <col class="bg-mehroon-50">
                    <col class="bg-gray-50">
                    <col>
                </colgroup>
                <thead class="mo-lv-thead">

                    <tr class="border-gray-300 border-b-1">

                        <th id="save_money" class="w-1/4 py-4 font-bold text-black" style="
                        border-top: 1px solid #ffffff;width:20%;vertical-align:middle;">
                            <div>
                                <h3 style="font-size:1.5em;">Why You Should Consider Purchasing a Premium Plan?<br></h3>
                                <p style="text-align:center;">
                                Upgrading to the Premium plugin will allow you to fetch regular updates/compatibility patches for the plugin as well as our dedicated Power BI team would be there to assist you via screenshare meeting on priority basis.<br><br>
                                Additionally, the Premium version of the plugin will provide you all the features you need to embed resources like Dashboard, Q&A, Tile, Visuals from Power BI into WordPress site. Users can access or modify the resources from embedded view. Provide access to Power BI content based on WordPress roles, Azure AD security groups, Memberships, etc. Paid version also allows you to filter the Power BI content based on <u style="font-size: initial;">Row Level Security</u>
                                </p>
                                <div>
                                    <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/profits.webp'); ?>" style="width:10rem;height:10rem;">
                                </div>
                            </div>
                        </th>
                        <th id="card_0" class="mo_lv_table_th w-1/6 py-4 font-bold text-center text-black rounded-tl-lg rounded-tr-lg bg-gray-50" style="
                        border-top:none; display:none;
                        ">
                            <div>
                                <h1 class="subs" style="margin:3.2em;text-decoration:underline;">FEATURES</h1>
                            </div>
                        </th>

                        <th id="card_1" class="mo_lv_table_th w-1/6 py-4 font-bold text-center text-black rounded-tl-lg rounded-tr-lg bg-gray-50" style="
                        border-top:none;
                        ">

                            <div>
                                <div class="subs" style="margin-bottom:30px;">FREE</div>
                                <div style="color:red;margin-bottom:25px;font-size: 17px;">(For Power BI Users - </br>Power BI per user license required)</div>
                                <div id="card_details_1" class="beautiful_class mt-1 fs-td grant-bg-l text-sm text-white-500" style="padding-block-end: 80px;">
                                    <div style="display:flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                            <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                            
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Embed Content for your Organization 
                                        </div>
                                    </div>

                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Content accesible only after Azure AD SSO
                                        </div>
                                    </div>

                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">       
                                            Embedding Content via Shortcode only 
                                        </div>
                                    </div>

                                </div>
                                <hr class="hr-pricing">
                                <div class="d-none d-md-block">
                                    <div class="price-block">
                                        <span class="js-computed-value" data-plan="free">$0*</span>
                                    </div>
                                    <a href="https://wordpress.org/plugins/embed-power-bi-reports/" target="_blank"><input type="button" style="cursor: pointer;" class="license-plan-btn" value="DOWNLOAD NOW"></a>
                                </div>
                            </div>
                        </th>
                        <th id="card_2" class="mo_lv_table_th w-1/6 py-4 font-bold text-center text-black rounded-tl-lg rounded-tr-lg bg-gray-50" style="
                        border-top:none;box-shadow:rgb(105 65 198 / 20%) 0px 5px 30px 2px;overflow:hidden;
                        ">
                            <div>
                                <div class="subs" style="margin-bottom:30px;">PREMIUM & ENTERPRISE</div>
                                <div style="color:red;margin-bottom:25px;font-size: 17px;">(For Non-PowerBI </br> or Guest Users)</div>
                                <div id="card_details_2" class="beautiful_class mt-1 fs-td grant-bg-l text-sm text-white-500">
                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Embed Content for Customers
                                        </div>
                                    </div>


                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Configure Row Level Security for Embedded Resource
                                        </div>
                                    </div>

                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Provide access based on WordPress roles / membership/ Azure AD security groups
                                        </div>
                                    </div>

                                    <div style="display: flex;align-items: center;">
                                        <div style="align-items: flex-end">
                                        <svg class="pricing-svg" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="28" height="28" rx="14" fill="#D0E4FF" fill-opacity="0.6"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9457 8.62145L11.5923 16.6831L9.37568 14.3148C8.96734 13.9298 8.32568 13.9064 7.85901 14.2331C7.40401 14.5714 7.27568 15.1664 7.55568 15.6448L10.1807 19.9148C10.4373 20.3114 10.8807 20.5564 11.3823 20.5564C11.8607 20.5564 12.3157 20.3114 12.5723 19.9148C12.9923 19.3664 21.0073 9.81145 21.0073 9.81145C22.0573 8.73811 20.7857 7.79311 19.9457 8.60978V8.62145Z" fill="#000ABD"></path>
                                            </svg>
                                        </div>
                                        <div style="align-items:flex-start;padding-left: 5px;padding-top: 5px;line-height: 1.4rem;text-align: left;">
                                        Domain based Power BI content access
                                        </div>
                                    </div>

                                </div>
                                <hr class="hr-pricing">
                                <div class="d-none d-md-block">
                                    <div class="price-block">
                                        <span class="js-computed-value" data-plan="free">$199* AND $299*</span>
                                    </div>
                                    <input type="button" style="cursor: pointer;" class="license-plan-btn" value="UPGRADE NOW" onclick="upgradeform('wp_power_bi_premium_plan')">
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Unlimited Resource Embedding </p>
                            <div class="mt-0 text-sm font-normal text-gray-600"> </div>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black rounded-tl-lg rounded-tr-lg">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black rounded-tl-lg rounded-tr-lg">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">
                            Embed Resource Type Report
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black"> Content Mode [View/Modify/Edit]
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Support for Azure AD SSO</p>
                            <!-- <div class="mt-0 text-sm font-normal text-gray-600"> Syncs user profile from IDP to WordPress</div>-->
                        </td>
                        <td class="w-1/6 py-2 text-center text-black rounded-tl-lg rounded-tr-lg">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">    
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Customizable width, height, language, locale of the embedded resource
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Customize Filter pane and navigation bar for embedded resource
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Power BI License requirement
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            ━ 
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">
                                Unlimited Resource Emdedding for all Resource Types :
                                Dashboard,Q&A,Tiles,Visuals
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>

                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Configure Row Level Security for Embedded Resource</p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Integration with 3rd party plugins like Paid Membership Pro, Woo Commerce and many more  <span class="dashicons dashicons-info-outline tooltip" style="margin-left:10px;margin-top:5px;">
                                    <span class="tooltipfont tooltiptext" style="white-space: pre-line;">
                                        1. MemberPress Integrator<br>
                                        2. WP-Members Integrator<br>
                                        3. PaidMembership Pro Integrator<br>
                                        4. User Sync and Group Sync for Azure AD<br>
                                        5. Dynamic CRM 365 Integration<br>
                                        6. SharePoint Integration<br>
                                    </span>
                                </span>
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Access based on WordPress roles / membership/ Azure AD security groups
                            </p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                            <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Domain based Power BI Content access</p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>
                    <tr class="border-gray-300 border-b-1">
                        <td class="w-1/4 py-4 pr-3">
                            <p class="fs mb-0 font-bold text-black">Embed specific pages of Report</p>
                        </td>
                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        ━
                        </td>

                        <td class="w-1/6 py-2 text-center text-black fs-td">
                        <img src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../images/tick.svg'); ?>" class="inline w-8 h-8 text-blue-500 ">
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    <?php

    }


    public function mofinalview()
    {

    ?>
        <script>
            jQuery(window).scroll(function() {
                if (jQuery(window).scrollTop() + 25 >= jQuery('#card_1').offset().top) {
                    jQuery('#card_details_2').slideUp("fast");
                    jQuery('#card_details_1').slideUp("fast");
                    jQuery('.price-block').css('padding', '0rem');
                    jQuery('.price-block').css('font-size', '25px');
                    jQuery('#card_0').show();
                    jQuery('#save_money').hide();
                } else {
                    jQuery('#card_details_2').slideDown('fast');
                    jQuery('#card_details_1').slideDown('fast');
                    jQuery('.price-block').css('padding', '2rem');
                    jQuery('.price-block').css('font-size', '35px');
                    jQuery('.price-block').css('transition', '0.5s');
                    jQuery('#card_0').hide();
                    jQuery('#save_money').show();
                }
            });

            function upgradeform(planType) {
                if (planType === "" || planType == "wp_epbr_client_standard_plan") {
                    location.href = "https://wordpress.org/plugins/embed-power-bi-reports/";
                    return;
                } else {
                    jQuery('#requestOrigin').val(planType);
                    if (jQuery('#mo_customer_registered').val() == 1)
                        jQuery('#loginform').submit();

                    else {
                        location.href = jQuery('#mobacktoaccountsetup').attr('href');
                    }
                }

            }
        </script>
        '<div style="display:contents;justify-content:space-between;align-items:flex-start;padding-top:5px;">
            <div style="width:100%;" id="mo_epbr_container" class="mo-container">
                <table style="width:76%;">
                    <tr>
                        <td style="width:fit-content;   ">
                            <span><a href='<?php echo esc_url(remove_query_arg("tab")); ?>' class="button button-primary mo-ms-tab-content-button" style="margin-left:5px;"><span class="dashicons dashicons-arrow-left-alt" style="margin:4px"></span>Back To Plugin Configuration</a> </span>
                        </td>
                        
                        <td style="display:flex;justify-content:center;align-items:center;flex-direction:column;height:1.5rem;margin-top:20px;">
                            <h2>YOU ARE CURRENTLY ON THE FREE VERSION OF THE PLUGIN</h2>
                        </td>

                        <td style="display:flex;justify-content:center;align-items:center;flex-direction:column;height:1.5rem;">
                            <h1><label for="sync_integrator">Choose Your Licensing Plan</label></h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>

                    </tr>
                </table>

                <div style="display:flex;justify-content:center;align-items:center;flex-direction:column;">

                    <hr style="border:solid 1px #eee;width:80%;" />
                </div>'
                <?php
                self::mo_epbr_license();
                ?>

            </div>
        </div>
<?php
    }
}
