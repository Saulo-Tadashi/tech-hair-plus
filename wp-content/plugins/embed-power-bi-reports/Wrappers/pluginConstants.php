<?php

namespace MoEmbedPowerBI\Wrappers;

class pluginConstants{
    const HOSTNAME = "https://login.xecurify.com";
    const NEW_HOSTNAME = "https://portal.miniorange.com";
    const notice_message = 'mo_epbr_notice_message';
    const SCOPE_DEFAULT_OFFLINE_ACCESS = "https://analysis.windows.net/powerbi/api/.default offline_access";
    const GRANT_TYPE_CLIENTCRED = 'client_credentials';
    const GRANT_TYPE_AUTHCODE = 'authorization_code';
    const GRANT_TYPE_REFTOKEN = 'refresh_token';
    const CONTENT_TYPE_VAL = 'application/x-www-form-urlencoded';
    const API_ENDPOINT_VAL = "https://api.powerbi.com/v1.0/myorg/groups/";
    const Process_Failed = "FAILED TO PROCESS REQUEST";
    const APPLICATION_CONFIG_OPTION= "mo_epbr_application_config";

    const WP_Integration_Title = array(
        'memberpress'                   =>  'MemberPress Integrator',
        'wp_members'                    =>  'WP-Members Integrator',
        'paid_mem_pro'                  =>  'PaidMembership Pro Integrator',
        'ultimate_member'               =>  'Ultimate Member Integrator'
    );
    const AZURE_Integrations_Title = array(     
        'user_sync'                   =>  'User Sync and Group Sync for Azure AD',
        'dynamic_crm'                 =>  'Dynamic CRM 365 Integration',
        'sharepoint'                  =>  'SharePoint Integration'
    );
    const license_plans = array (
        'premium'                   => 'Premium Plan',
        'help'                      => 'Not Sure'
    );
    const features_advertise = array (
        'rls' => 'Row-Level Security',
        'cust_rep_embed' => 'Customer Report Embedding',
        'service_principal_rep_embed' =>'Service Principal Report Embedding',
        'dashboard_embed' => 'Dashboard Embedding',
        'tile_embed' => 'Tile Embedding',
        'Q&A_embed' => 'Q&A Embedding',
        'rep_visuals_embed' => 'Report Visuals Embedding',
        'res_scheduling' => 'Resource Scheduling',
        'modes_embed' => 'Embedding in Different Modes'
    );

	const languages = [
        'ar-SA' =>'العربية (Arabic)',
        'bg-BG' =>'български (Bulgarian)',
        'ca-ES' =>'català (Catalan)',
        'cs-CZ' =>'čeština (Czech)',
        'da-DK'	=>'dansk (Danish)',
        'de-DE'	=>'Deutsche (German)',
        'el-GR'	=>'ελληνικά (Greek)',
        'en-US'	=>'English (English)',
        'es-ES'	=>'español service (Spanish)',
        'et-EE'	=>'eesti (Estonian)',
        'eU-ES'	=>'Euskal (Basque)',
        'fi-FI'	=>'suomi (Finnish)',
        'fr-FR'	=>'français (French)',
        'gl-ES'	=>'galego (Galician)',
        'he-IL' =>'עברית (Hebrew)',
        'hi-IN'	=>'हिन्दी (Hindi)',
        'hr-HR'	=>'hrvatski (Croatian)',
        'hu-HU'	=>'magyar (Hungarian)',
        'id-ID'	=>'Bahasa Indonesia (Indonesian)',
        'it-IT'	=>'italiano (Italian)',
        'ja-JP'	=>'日本の (Japanese)',
        'kk-KZ'	=>'Қазақ (Kazakh)',
        'ko-KR'	=>'한국의 (Korean)',
        'lt-LT'	=>'Lietuvos (Lithuanian)',
        'lv-LV'	=>'Latvijas (Latvian)',
        'ms-MY'	=>'Bahasa Melayu (Malay)',
        'nb-NO'	=>'norsk (Norwegian)',
        'nl-NL'	=>'Nederlands (Dutch)',
        'pl-PL'	=>'polski (Polish)',
        'pt-BR'	=>'português (Portuguese)',
        'pt-PT'	=>'português (Portuguese)',
        'ro-RO'	=>'românesc (Romanian)',
        'ru-RU'	=>'русский (Russian)',
        'sk-SK'	=>'slovenský (Slovak)',
        'sl-SI'	=>'slovenski (Slovenian)',
        'sr-Cyrl-RS'=>'српски (Serbian)',
        'sr-Latn-RS'=>'srpski (Serbian)',
        'sv-SE'	=>'svenska (Swedish)',
        'th-TH'	=>'ไทย (Thai)',
        'tr-TR'	=>'Türk (Turkish)',
        'uk-UA'	=>'український (Ukrainian)',
        'vi-VN'	=>'tiếng Việt (Vietnamese)',
        'zh-CN'	=>'中国 (Chinese-Simplified)',
        'zh-TW'	=>'中國 (Chinese-Tranditional)'
		];

    const Integrations = array(
        'memberpress'                   =>  'MemberPress Integrator',
        'wp_members'                    =>  'WP-Members Integrator',
        'paid_mem_pro'                  =>  'PaidMembership Pro Integrator',
        'user_sync'                   =>  'User Sync and Group Sync for Azure AD',
        'dynamic_crm'                 =>  'Dynamic CRM 365 Integration',
        'sharepoint'                  =>  'SharePoint Integration'
    );
}