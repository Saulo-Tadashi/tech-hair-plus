<?php
use MoEmbedPowerBI\Wrappers\pluginConstants;
if ( !defined( 'WP_UNINSTALL_PLUGIN' ))
    exit();

delete_option(pluginConstants::APPLICATION_CONFIG_OPTION);
delete_option('mo_epbr_notice_message');
delete_option('mo_epbr_power_bi_url');