<?php

namespace MoEmbedPowerBI\View;

use MoEmbedPowerBI\Wrappers\wpWrapper;

class setupGuide
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

    public function mo_epbr_display__tab_details()
    { ?>
   <table>
     <tbody>
      <td style="vertical-align:top; width:65%;">
      <div class="mo-epbr-setup-tab-content">
		<h1>
            <b>How to configure the plugin</b>
            <a title="Visit online guide" style="text-decoration:none" target="_blank" href="https://plugins.miniorange.com/microsoft-power-bi-embed-for-wordpress#guide">
                <span class="dashicons dashicons-admin-links"></span>
            </a>
        </h1>
        <div class="mo-epbr-setup-tab-content-tile">
            <div class="mo-epbr-setup-tab-content-tile-content mo-epbr-guide-text">
              <h3>1. Creating the Azure AD application for basic authentication</h3>
              <ul class="mo-epbr-guide-ul">
                 <li>
                    Azure AD application needs to be created for basic authentication and to access the Azure APIs on the behalf of the user.
                 </li>
                 <li>
                    Please follow step-by-step instructions here to create a <a href="https://plugins.miniorange.com/azure-ad-user-sync-wordpress-with-microsoft-graph" target="_blank"><b><u>Azure AD application</u></b></a>. Once you have configured, proceed to <a href="#step2"><b><u>step 2</u></b></a>
                 </li>
                 <li>
                    In addition to the permissions configured in Azure AD in the above step,<b>Kindly configure the following permissions as mentioned below</b> and also <b>'Grant admin consent'</b> for permissions so as to embed reports.
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/PermissionAzureADforSetupGuide.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">
                 </li>
                 <li>Permissions to be configured are as follows : <br>
                    1. User.Read <br>
                    2. User.Read.All  <br>
                    3. Report.Read.All <br>
                 </li>
              </ul>
                <h3>2. Configure the Azure AD Security Group Settings</h3>
                <ul class="mo-epbr-guide-ul">
                    <li>
                        In Azure Active Directory Home page, navigate to the <b>Groups</b> from the left pane.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/go-to-groups.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">
                    <li>
                        Click on <b>New Group</b> to add new security group.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/new-group.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">

                    <li>
                        Select the <b>Group type</b> as <b>Security</b> from the dropdown and enter the <b>Group Name</b> as <b>Allow
                            Power BI Admin APIs</b>.
                    </li>
                    <li>
                        Click on <b>Create</b> button to create a new security group.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/create-security-group.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">
                    <li>
                        Search and select newly created security group (Allow Power BI Admin APIs).
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/select-group.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">
                    <li>
                        Navigate to the <b>Members</b> from the left pane and click on <b>Add Members</b>.
                    </li>
                    <li>
                        Search for the application name you have previously configured and click on <b>Select</b> button.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/add-group-member.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - Admin consent">
                </ul>
                <p>
                    <b> You have successfully configured Azure AD app to achieve User Sync and Power BI Integration into your WordPress Site.</b>
                </p>
                <h3>3. Configure the Power BI settings</h3>
                <ul class="mo-epbr-guide-ul">
                    <li>
                        Go to the <a href="https://app.powerbi.com/home" target="_blank"><u><b>Power BI</b></u> </a>dashboard and login as an administrator.
                    </li>
                    <li>
                        You will be represented with the home screen of the Power BI.
                    </li>
                    <li>
                        On the top right corner, click on icon as shown below.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/three-dots.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Under the <b>Settings</b> tab, click on the <b>Admin portal</b> option.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/go-to-admin-prtal.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        In the <b>Admin Portal</b> section, under the <b>Tenant settings</b>, scroll down to the <b>Developer settings</b>.
                    </li>
                    <li>
                        Click on <b>Allow service principals to use Power BI APIs </b>.
                    </li>
                    <li>
                        <b>Enable the toggle</b> and configure <b>apply to</b> as shown in image below , then click on <b>Apply</b>.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/add-developer-setting.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>Navigate back to the Home page. Select the <b>Workspaces</b> tab from the left pane and then select your workspace from the list.</li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/go-to-workspaces.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Navigate to the <b>Access</b> tab.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/select-access.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        In the <b>Access</b> section, search for the application that you have previously configured.
                    </li>
                    <li>
                        From the below dropdown, select the <b>Admin</b> and click on <b>Add</b> button to assign this Azure AD application to your Power BI workspace.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/manage-workspace-access.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Select the report that you want to embedd in WordPress page or post.
                    </li>
                    <li>
                        Then copy the Workspace_ID and Report_ID from the URL as shown in the below image and keep it handy as you will need it further.
                    </li>
                    <li>
                        <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/copy-report-ids.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    </li>
                </ul>
                <h3>4. Azure AD SSO for viewing Power BI Content</h3>
                <ul class="mo-epbr-guide-ul">
                    <li>
                        Now you can enable Azure AD SSO into WordPress so that the users in your Organization can view the Power BI content.
                    </li>
                    <li>
                        You can find the option to enable SSO in the <b>Manage Application</b> section of the plugin.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/SetupGuideSSOImage.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        By enabling this Option, a <b>SSO button</b> would be added on the default WordPress login page.
                    </li>
                </ul>
                <h3>5. Embed Power BI Report into WordPress</h3>
                <ul class="mo-epbr-guide-ul">
                    <li>
                        Navigate to the <b>Embed Power BI </b> tab in the plugin.
                    </li>
                    <li>
                        You would be able to see a dropdown with resource types mentioned,select the appropriate <b>resource type</b>.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/EmberPowerBITabforGenerateShortcode.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Enter the Workspace ID, Report ID and height & width as per your wish and click on <b>Generate Shortcode</b> button.
                    </li>
                    <li>
                        Now after successful generation of shortcode, you can access the shortcodes in the <b>ShortCodes Generated</b> section just below as :
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/ShortcodesGeneratedDiv.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        You can have <b>multiple shortcodes</b> generated and also <b>copy</b> as well as <b>delete</b> functionality is provided for each shortcode.
                    </li>
                    <li>
                        Copy the shortcode using copy button provided with the shortcode you want to use for embedding purpose.
                    </li>
                    <li>
                        Go to the <b>Pages</b> tab form the left side bar and click on <b>Add New</b> button or you can <b>edit</b> your existing page.
                    </li>
                      <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/add-new-page.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                         Click on <b>+</b> symbol, search for the <b>Shortcode</b>.
                    </li>
                    <img width="95%" src="  <?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/Pages-power-bi.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Paste the <b>Shortcode</b> copied from the <b>ShortCodes Generated</b> section in the area as highlighted in below image. Click on <b>Publish / Update</b> button in the top right corner.
                    </li>
                      <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/image-10.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        Visit the page via Azure AD SSO in order to view the Power BI report.
                    </li>
                        <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/power-bi-report.webp'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        You can now also <b>embed multiple reports</b> in single page by adding multiple shortcodes.
                    </li>
                    <li>
                        If a user is not logged in via Azure AD SSO, user will see a notice to login via SSO in embed container as shown below.
                    </li>
                        <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/SetupGuideUserNotLoggedImage.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                </ul>
                <h3>6. Configure Additional Settings for Embedded Resource:</h3>
                <ul class="mo-epbr-guide-ul">
                    <li>
                        You may now navigate to the<b>Settings</b> tab of the plugin for configuring additional settings for the embedded resource.
                    </li>
                    <img width="95%" src="<?php echo esc_url(plugin_dir_url(MO_EPBR_PLUGIN_FILE) . 'images/SettingsTab.png'); ?>" loading="lazy" class="mo-epbr-guide-image" alt="Azure AD user sync with WordPress - App registraton">
                    <li>
                        1. <b><u>Filter Pane</u></b> : This feature enables or disables the display of filter pane on the mebdded resource.
                    </li>
                    <li>
                        2. <b><u>Page Navigation</u></b> : This feature enables or disables the display of page navigation bar below the embedded content.
                    </li>
                    <li>
                        3. <b><u>Language</u></b> : If you wish to view the embedded content in any specific language then you may configure it from this option.
                    </li>
                    <li>
                        4. <b><u>Format Locale</u></b> : By this feature, you may change the locale format for embedded resource.
                    </li>
                    <li>
                        5. <b><u>Mobile Breakpoint</u></b> : This is the value which will be considered for embedding report in mobile layout. Any width less than the entered amount will trigger the <b>Mobile Report Embed</b> functionality.
                    </li>
                    <li>
                        6. <b><u>Mobile Height</u></b> : This is the height for the mobile layout when width is less than the value entered in Mobie Breakpoint.
                    </li>
                    <li>
                        7. <b><u>Mobile Width</u></b> : This is the width for the mobile layout when width is less than the value entered in Mobie Breakpoint.
                    </li>
                    <li>
                        You may configure any of the settings above as per your requirements.
                    </li>
                </ul>
                <div>
                    <p><b>Now you have successfully embedded your Power BI report into the WordPress page and provided access to the Power BI report via Azure AD SSO .</b></p>
                </div><br>
                <hr style="width: 95%;">
                <h3 style="text-align: center;">Reach out to us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a> if you need any assistance or have any additional requirements.</h3>
            </div>
        </div>
      </div>
      </td>
     </tbody>
   </table>
<?php
    }
}
