<?php

namespace MoEmbedPowerBI\View;
use MoEmbedPowerBI\Wrappers\wpWrapper;

include_once 'support_form.php';

class integrations{
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
        <div>
            <div class="mo-ms-tab-content-left-border" style="display: flex;flex-direction: column;">
                <?php $this->mo_epbr_display__integrations_tab(); ?>
            </div>
        </div>
    </div>
    <?php
    }

    public function mo_epbr_display__integrations_tab(){
        wp_enqueue_style( 'mo_epbr_css_powerbi_settings_display', plugins_url( '../includes/css/mo_epbr_integrations.css', __FILE__ ) );
        wp_enqueue_script( 'mo_epbr_js_powerbi_settings_display', plugins_url( '../includes/js/mo_epbr_integrations.js', __FILE__ ) );
        ?>
                <div class="categories_div" style="display:flex;flex-direction:row;z-index:100;gap:10px;margin: 7px 0px -40px 45px;" id="all_categories_div">
                    <input style="height:30px;border-radius:20px;border-block-color:gray;cursor:pointer;background-color: white;color:gray;" type="button" id="AllCategoryButton" class="mo-ms-tab-content-button active" onclick="all_categories()"
                    value="All Integrations">
                    <input style="height:30px;border-radius:20px;border-block-color:gray;cursor:pointer;background-color: white;color:gray;" type="button" id="WordpressCategoryButton" class="mo-ms-tab-content-button" onclick="wordpress_categories()"
                    value="WordPress Integrations">
                    <input style="height:30px;border-radius:20px;border-block-color:gray;cursor:pointer;background-color: white;color:gray;" type="button" id="AzureCategoryButton" class="mo-ms-tab-content-button" onclick="azure_categories()"
                    value="Office 365 Integrations">
                </div>

            
            <div style="margin-left: 40px;width: 100%;">
            <div id="wordpress_integrations" style="display:flex;flex-direction:column;margin-top:3rem;">
            
                <div style="display:flex;flex-direction:row;justify-content:space-around;"> 
                <div class="item" style="background-color: white;position:relative;">
                    <div class="title_image" style="display:flex;">
                    <span class="spanstyle" style="width:auto !important;">MemberPress Integrator</span>
                    <img src="<?php echo plugins_url('../images/MemberPress-Integration.png',__FILE__);?>" style="height: 70px;margin-left: 20px;width: 100px;margin-top: 10px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Map users to membership levels created by the MemberPress plugin using the group information sent by your Identity Provider.</p>
                    </div>
                    <div style="margin-left:10px;margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/wordpress-memberpress-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+MemberPress+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

                <div class="item" style="background-color:white;position:relative;">
                    <div class="title_image" >
                    <span class="spanstyle">WP-Members Integrator</span>
                    <img src="<?php echo plugins_url('../images/wp_members-Integration.png',__FILE__);?>" style="height: 50px;width: 70px;margin-left: 25px;margin-top:10px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Integrate WP-members fields using the attributes sent by your SAML Identity Provider in the SAML Assertion.</p>
                    </div>
                    <div style="margin-left:10px;margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/wordpress-members-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+WP-Members+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>
                </div>

                <div style="display:flex;flex-direction:row;">
                <div class="item" style="background-color: white;position:relative;">
                    <div class="title_image">
                    <span class="spanstyle">PaidMembership Pro Integrator</span>
                    <img src="<?php echo plugins_url('../images/PaidMembershipsPro-Integration.png',__FILE__);?>" style="height:70px;width: 70px;margin-top: 2px;margin-left: 30px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:-1em 0;">Map your users to different Paid MembershipPro membership levels as per the group information sent by your Identity Provider.</p>
                    </div>
                    <div style="margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/paid-membership-pro-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+PaidMembership+Pro+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

                <div class="item" style="background-color:white;position:relative;">
                    <div class="title_image">
                    <span class="spanstyle">Ultimate Member Integrator</span>
                    <img src="<?php echo plugins_url('../images/UltimateMember-Integration.webp',__FILE__);?>" style="height:110px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Enable you to create almost any type of site where users can join and become members with absolute ease.</p>
                    </div>
                    <div style="margin-bottom:2px;display:grid;grid-template-columns:2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/guide-to-setup-ultimate-member-login-integration-with-ldap-credentials">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+Ultimate+Member+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>
                </div>
            </div>

            <div id="azure_integrations">
                <div style="display:flex;flex-direction:row;">
                <div class="item" style="background-color: white;">
                    <div class="title_image">
                    <span class="spanstyle" >Sharepoint Integrator</span>
                    <img src="<?php echo plugins_url('../images/SharePoint-Integration.png',__FILE__);?>" style="height:90px;margin-top:5px;margin-left: 15px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:-1em 0;">Provides an option to secure a place to store, organize, share, and access information from any device.</p>
                    </div>
                    <div style="margin-left:0px;margin-bottom:2px;display: grid;grid-template-columns: 1fr 1fr 1fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://wordpress.org/plugins/embed-sharepoint-onedrive-documents/">Download</a></button>
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/microsoft-sharepoint-wordpress-integration">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+Sharepoint+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

                <div class="item large" style="background-color: white;">
                    <div class="title_image">
                    <span class="spanstyle">Dynamic CRM 365 Integration</span>
                    <img src="<?php echo plugins_url('../images/Dynamic365-Integrations.png',__FILE__);?>" style="height:100px;margin-left:-45px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:-1em 0;">Provides an option for connecting with on-premise version or cloud versions of Microsoft Dynamics 365 CRM and other business apps.</p>
                    </div>
                    <div style="margin-left:0px;margin-bottom:2px;display: grid;grid-template-columns: 1fr 1fr 1fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://wordpress.org/plugins/integrate-dynamics-365-crm/">Download</a></button>
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/wordpress-integration-with-dynamics-crm-365-apps">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+Dynamic+CRM+365+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>
                </div>

                <div class="item medium" style="background-color: white;width: 97%;">
                    <div class="title_image">
                    <span class="spanstyle spanstyler" style="border-radius: 9px 30px 36px !important;width: 167px !important;padding: 12px !important;"> User Sync and Group Sync for Azure AD</span>
                    <img src="<?php echo plugins_url('../images/AzureAD-Integration.webp',__FILE__);?>" style="height: 125px;margin-left: 10px;    width: 65%;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Enables seamless user sync/user synchronization into your WordPress site from your Azure AD, Azure B2C, Microsoft Office 365 tenant into your WordPress site.</p>
                    </div>
                    <div style="margin-left:0px;display: grid;grid-template-columns: 1fr 1fr 1fr;margin-bottom:2px;">
                        <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://wordpress.org/plugins/user-sync-for-azure-office365/">Download</a></button>
                        <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/azure-ad-user-sync-wordpress-with-microsoft-graph">Learn More</a></button>
                        <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+UserSync+GroupSync+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

            </div>
            </div>

            <div id="wordpress_integration" style="display:flex;flex-direction:column;margin-top:3rem;margin-left: 40px;width: 100%;">
                <div style="display:flex;flex-direction:row;">
                <div class="item" style="background-color: white;position:relative;">
                    <div class="title_image">
                    <span class="spanstyle">PaidMembership Pro Integrator</span>
                    <img src="<?php echo plugins_url('../images/PaidMembershipsPro-Integration.png',__FILE__);?>" style="height:70px;width: 70px;margin-top: 2px;margin-left: 30px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:-1em 0;">Map your users to different Paid MembershipPro membership levels as per the group information sent by your Identity Provider.</p>
                    </div>
                    <div style="margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/paid-membership-pro-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+PaidMembership+Pro+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

                <div class="item" style="background-color:white;position:relative;">
                    <div class="title_image">
                    <span class="spanstyle">Ultimate Member Integrator</span>
                    <img src="<?php echo plugins_url('../images/UltimateMember-Integration.webp',__FILE__);?>" style="height:110px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Enable you to create almost any type of site where users can join and become members with absolute ease.</p>
                    </div>
                    <div style="margin-bottom:2px;display:grid;grid-template-columns:2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/guide-to-setup-ultimate-member-login-integration-with-ldap-credentials">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+Ultimate+Member+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>
                </div>

                <div style="display:flex;flex-direction:row;justify-content:space-around;"> 
                <div class="item" style="background-color: white;position:relative;">
                    <div class="title_image" style="display:flex;">
                    <span class="spanstyle" style="width:auto !important;">MemberPress Integrator</span>
                    <img src="<?php echo plugins_url('../images/MemberPress-Integration.png',__FILE__);?>" style="height: 70px;margin-left: 20px;width: 100px;margin-top: 10px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Map users to membership levels created by the MemberPress plugin using the group information sent by your Identity Provider.</p>
                    </div>
                    <div style="margin-left:10px;margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/wordpress-memberpress-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+MemberPress+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>

                <div class="item" style="background-color:white;position:relative;">
                    <div class="title_image" >
                    <span class="spanstyle">WP-Members Integrator</span>
                    <img src="<?php echo plugins_url('../images/wp_members-Integration.png',__FILE__);?>" style="height: 50px;width: 70px;margin-left: 25px;margin-top:10px;">
                    </div>
                    <div class="details">
                    <p class="detailsofintegration" style="margin:0em 0;">Integrate WP-members fields using the attributes sent by your SAML Identity Provider in the SAML Assertion.</p>
                    </div>
                    <div style="margin-left:10px;margin-bottom:2px;display: grid;grid-template-columns: 2fr 2fr;">
                    <button class="fuller-button"><a style="text-decoration:none;" target="_blank" href="https://plugins.miniorange.com/wordpress-members-integrator">Learn More</a></button>
                    <button class="fuller-button" style="color:#4169e1;"><a style="text-decoration:none;" href="https://mail.google.com/mail/u/0/?fs=1&amp;tf=cm&amp;source=mailto&amp;su=Query+for+WordPress+and+AzureAD+Integration+with+WordPress.&amp;to=samlsupport@xecurify.com,info@xecurify.com&amp;body=I+would+like+to+enquire+about+WP-Members+Integration+with+WordPress.+" target="_blank" rel="nofollow" class="btn-add  mt-2">Contact Us</a></button>
                    </div>
                </div>
                </div>
            </div>

        <?php
    }
}