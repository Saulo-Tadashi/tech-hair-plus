=== PowerBI Embed Reports ===
Contributors: miniOrange
Donate link: https://miniorange.com
Tags: Azure, Power BI, PowerBI, Embed Reports, Office365, Microsoft, powerbi-embedded, wordpress-plugin, powerbi, wordpress
Requires at least: 5.5
Tested up to: 6.4
Requires PHP: 7.0
Stable tag: 1.1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Embed Microsoft Power BI reports, tiles, dashboards, Q&A, etc in WordPress site with support for Row-level security (RLS).[24*7 Support]

== Description ==

Embed PowerBI content/report seamlessly on the WordPress site with the <a href="https://plugins.miniorange.com/microsoft-power-bi-embed-for-wordpress" target="_blank">PowerBI Embed Reports plugin</a>. The plugin uses Microsoft's graph API to embed Power BI content such as dashboards, reports, Q&A, and report visuals.

You can check out the following video to embed the Power BI report on WordPress:
[youtube https://youtu.be/mGPagEu8K8Y ]

PowerBI Embed Reports provides you the option to embed the PowerBI content on a WordPress page or post using a shortcode with specified width and height. Generate multiple shortcodes based on PowerBI Workspace ID or Report ID to easily embed different PowerBI resources. Check out the setup guide to learn more about <a href="https://plugins.miniorange.com/wordpress-power-bi-embed" target="_blank">Integrating Power BI with WordPress</a>. 

The plugin allows you to embed PowerBI analytics which present data that your app owns through your own PowerBI account, or data that the user owns through their PowerBI accounts. Support for PowerBI users to view any type of embedded artifact.

PowerBI Embed Reports allows you to embed PowerBI content in different modes with different settings such as language, locale, mobile height, mobile width and much more.. In this manner you may configure different settings as per your requirements.

PowerBI Embed Reports also allows users to access reports using SSO service from Azure or Microsoft, that is users can log into WordPress using credentials of Azure portal account.

This WordPress plugin in all manner supports Microsoft Power BI Embedded, including  dashboards, reports, report visuals, Q&A, and tiles. Power BI is a sophisticated data analytics software and service package from Microsoft. More information on Power BI is available at [www.powerbi.com](http://www.powerbi.com).

**Row-level security (RLS) with Power BI**

Support of row-level security (RLS) for restricting PowerBI data access to your users. Filters restrict PowerBI data access at the row level, and you can define filters within roles.

Row Level Security in Power BI is a data governance capability of Power BI that restricts data based on the authorization context of the logged-in user. RLS forms an integral part of an organization’s data protection strategy as it implements appropriate data visibility for end-users. Power BI Row Level Security ensures that end users have visibility only into the data of Power BI they are supposed to see. Inappropriate access management can lead to chaos and unforeseen circumstances in any organization.

Row Level Security in Power BI is a way to protect sensitive data by limiting visibility access to Power BI data and reports. Row Level Security Power BI is a horizontal limitation applied to rows within a table. Power BI applies filters on the data for the users with limited visibility based on the instructions outlined by the administrator. The filters in Power BI apply data access limitations at the row level, and these filters can be defined within roles.

**Power BI Row Level Security Use Cases :**

Implementing Row Level Security in Power BI is a must if your dataset includes sensitive information (for example, information related to company financial accounts, customer information, or patient information). Below-mentioned is a list of the Row Level Security use cases seen across many organizations.

*   **Location-based RLS in Power BI**: When the company wants a user to only view information within a specific area or location (City/State/Country).
Employee-based RLS in Power BI: When the company wants an employee to only view information pertaining to his job responsibility. For example, a Store Manager should only view information related to the store’s business.

*   **Business Line-based RLS in Power BI**: When the company wants a user to only view information within a specific business line (Product/Service/Unit).

*   **Other RLS in Power BI**: Apart from the above-mentioned use cases, RLS can also be implemented with respect to Time (Month/Year), Customer (Specific Customer/Group of Customers), etc.

Power BI is all about Data Analytics, Data Visualization, and Business Intelligence. It is used by Data Professionals all over the world to examine data from multiple sources and create attractive Charts, Dashboards, and Reports according to user-specified data. However, it is quite necessary to protect sensitive Power BI data and one of the best practices to do so is by implementing Power BI Row Level Security (RLS). 

**Restrict / Filter PowerBI Content**

Embed PowerBI reports plugin allows you to restrict the Power BI report content based on the logged in status or the WordPress roles. The plugin also allows you to embed PowerBI reports based on Memberships for your Organization as well as manage permissions for users or security groups of the active directory on different artifacts like PowerBI dashboards, reports, etc.

**Integration with 3rd Party Plugins**

Integrate with MemberPress, Paid Membership Pro, Ultimate members, and many more to provide access to the Power BI Content based on the WordPress Memberships. Seamless integration with WooCommerce, WooCommerce memberships, WooCommerce Teams.

**Features**

**1) SSO via Azure AD** :  You can configure <a href="https://plugins.miniorange.com/wordpress-power-bi-embed" target="_blank">SSO via Azure AD</a> so as to show the content of the reports via toggle button provided in the PowerBI Embed Reports plugin.

**2) Resource Type Report Embed** : You can embed multiple reports from PowerBI by just embedding a shortcode generated by PowerBI Embed Reports Plugin and also can define different Height and Width for the embedded resource.

**3) Settings for Embedded Resource** :

*  **Filter Pane** : This feature enables or disables the display of the filter pane on the embedded PowerBI resource.

*   **Page Navigation** : This feature enables or disables the display of the page navigation bar below the embedded PowerBI content.

*   **Language** : If you wish to view the PowerBI embedded content in any specific language then you may configure it from this option.

*   **Format Locale**: With this feature, you may change the locale format for PowerBI embedded resource.

*   **Mobile Breakpoint**: This is the value that will be considered for embedding the PowerBI report in the mobile layout. Any width less than the entered amount will trigger the Mobile Report Embed functionality.

*   **Mobile Height** : This is the height for the mobile layout when width is less than the value entered in Mobile Breakpoint.

*   **Mobile Width** : This is the width for the mobile layout when width is less than the value entered in Mobile Breakpoint.
    You may configure any of the settings above as per your requirements.

**4) Modes for Embedding**:

 You can embed PowerBI content in three different modes namely

*    **View Mode**: Embedded PowerBI content will not be in editable mode i.e would be only viewable and no changes would be made.
*    **Edit Mode**: Embedded PowerBI content would be in editable format i.e. we can modify the content as we can at the PowerBI end.
*    **Create Mode**: Embed container would open a specified dataset by which you can create your own resource and also save it on the PowerBI end.

**Premium Version Features** 

**5) Other resource type embedding (Premium)**:

*   **Dashboards**: If you want to embed PowerBI dashboards in WordPress pages or posts then you can embed them using a generated shortcode generated by just giving some value of id's and also can configure different settings for the embedded resource.
*   **Q&A**: If you want to embed PowerBI Q&A's in WordPress pages or posts then you can embed it using a generated shortcode generated by just giving some values and also can configure different settings for the embedded resource.
*   **Tile**: If you want to embed PowerBI Tiles in WordPress pages or posts then you can embed it using a generated shortcode generated by just giving some details and also can configure different settings for the embedded resource.
*   **Report Visuals**: If you want to embed PowerBI report visuals in WordPress pages or posts then you can embed it using a generated shortcode generated by just giving some information and also can configure different settings for the embedded resource.

**6) Configure Row Level Security (Premium)**:
Row-level security (RLS) allows you to create a single or a set of reports that targets data for a specific user. In this feature, you will be able to implement RLS by using the Power BI roles configured and also matching them with respective WordPress roles or 3rd party memberships.

**7) Integration with 3rd party plugins like Paid Membership Pro, WooCommerce and many more (Premium)**:
Implement RLS or Row-level Security with any memberships created in a 3rd party plugin such as MemberPress, WP-Members, Paid Membership Pro, Ultimate Member etc.

**8) Access based on WordPress roles / Membership/ Azure AD security groups (Premium)**:
The plugin  <a href="https://plugins.miniorange.com/microsoft-power-bi-embed-for-wordpress" target="_blank">**"PowerBI Embed Reports"**</a> provides seamless support for Row-Level Security which filters the content of reports based on assigned roles in Power BI Desktop. You can also restrict the Power BI report content based on WordPress user logged-in status, WordPress roles, WordPress Membership levels, etc.

**9) Domain-based Power BI Content access (Premium)**:
Domain-based access can be achieved by our PowerBI Embed Reports plugin. But just keep in mind that the user email domain and RLS role name should be the same in order to apply RLS.

**10) Embed specific pages of Report (Premium)**:
So as to embed a specific page of a report and not show other pages or none other pages to be accessible then you can also embed a specific page of the PowerBI Resource.

==Use cases==

**1) PowerBI Embed Reports for Customers**

You can display the PowerBI reports / PowerBI dashboards on your WordPress site to different clients or employees from other organizations. These Clients / Employees can be from multiple Azure AD / Office 365 tenants.

**2) PowerBI Embed Reports for an Organization**

You can display the Power BI artifacts (Power BI dashboards, Power BI datasets, Power BI Reports, Power BI tiles,etc) to Employees within your organization on the WordPress site. Employees can perform SSO with Azure AD credentials in order to be able to access the embedded Power BI reports.

**3) Filter Embedded PowerBI Report according to Roles**

We can show reports according to the memberships configured in WordPress as something like :
1. Free Membership Level  : None of the reports are to be displayed
2. Premium Membership Level  : Only REPORT1 is to be displayed
3. Enterprise Membership Level  : Both REPORT1 and REPORT2 are to be displayed

You can acquire any of such use cases mentioned above in the 3rd point.
If you require any help with this PowerBI Embed Reports Plugin, please feel free to email us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a> or <a href="http://miniorange.com/contact">Contact us</a>.

== Frequently Asked Questions ==

= How to configure the plugin ? =
You can follow the <a href="https://plugins.miniorange.com/wordpress-power-bi-embed" target="_blank">Guide to embed Power BI reports</a> and configure the plugin. If you face any issues please email us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a>. 

= Can I restrict or filter Power BI Content to be embedded in WordPress ? =
The plugin provides seamless support for Row-Level Security which filters the content of reports based on assigned roles in Power BI Desktop. You can also restrict the Power BI report content based on WordPress user logged-in status, WordPress roles, WordPress Membership levels, etc.

= How to embed Power Bi reports ?=
You will have to configure your AzureAD application, and set up our PowerBi plugin. After that you can simply copy and paste the specific shortcode from the **"Embed Power BI"** tab in the plugin. You can refer to our <a href="https://plugins.miniorange.com/microsoft-power-bi-embed-for-wordpress" target="_blank">setup guide for plugin configurations</a>.

=How to configure SSO with power bi to embed reports ?=
You just have to enable a toggle button in the **"Manage Application"** tab under the "**Use Single Sign-On to view Power BI Content**" section and you would be able to see a button on your default WordPress login page.
For further support: you can contact us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a>.

== Screenshots ==
1. Configure application for WP Embed Power BI plugin.
2. Generate shortcode by resource type.
3. Custom settings for embedded resources.
4. Generate the resource shortcode.
5. Web Layout
6. Mobile Layout

== Website ==
Check out our website for other plugins <a href="http://miniorange.com/plugins" >http://miniorange.com/plugins</a> or <a href="https://wordpress.org/plugins/search.php?q=miniorange" >click here</a> to see all our listed WordPress plugins.
For more support or info email us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a> or <a href="http://miniorange.com/contact" >Contact us</a>.

== Installation ==

= From WordPress.org =
1. Download miniOrange PowerBI Embed Reports plugin.
2. Unzip and upload the `PowerBI Embed Reports` directory to your `/wp-content/plugins/` directory.
3. Activate PowerBI Embed Reports from your Plugins page.

= From your WordPress dashboard =
1. Visit `Plugins > Add New`.
2. Search for `PowerBI Embed Reports`. Find and Install `PowerBI Embed Reports`.
3. Activate the plugin from your Plugins page.

= For any query/problem/request =
Visit Help & FAQ section in the plugin OR email us at <a href="mailto:samlsupport@xecurify.com">samlsupport@xecurify.com</a> or <a href="http://miniorange.com/contact">Contact us</a>.

== Changelog ==

= 1.1.5 =
* Updated licensing

= 1.1.4 =
* Fixed notification issue on plugin deactivation
* Readme Updates
* Screenshots Added

= 1.1.3 =
* Added Licensing Plans and Account Setup tab
* Added Demo Request tab for requesting trial
* UI Improvements

= 1.1.2 =
* Customizable height, width, mobile breakpoint for the embedded Power BI resource
* Support for customizing Language, Locale Format for the embedded Power BI resource
* Setting to enable Filter Pane and Page Navigation 
* Multiple Power BI reports embedding

= 1.1.1 =
* Azure AD SSO support for viewing Power BI Content
* Shortcode to PowerBI Embed Reports for your Organization

= 1.1.0 =
* Added feedback and Support form 
* Introduced setup guide in the plugin

= 1.0.0 =
* First version of PowerBI Embed Reports.

== Upgrade Notice ==

= 1.1.5 =
* Updated licensing

= 1.1.4 =
* Fixed notification issue on plugin deactivation
* Readme Updates
* Screenshots Added

= 1.1.3 =
* Added Licensing Plans and Account Setup tab
* Added Demo Request tab for requesting a trial
* UI Improvements

= 1.1.2 =
* Customizable height, width, mobile breakpoint for the embedded Power BI resource
* Support for customizing Language, Locale Format for the embedded Power BI resource
* Setting to enable Filter Pane and Page Navigation 
* Multiple Power BI reports embedding

= 1.1.1 =
* Azure AD SSO support for viewing Power BI Content
* Shortcode to PowerBI Embed Reports for your Organization

= 1.1.0 =
* Added feedback and Support form 
* Introduced setup guide in the plugin

= 1.0.0 =
* First version of PowerBI Embed Reports.