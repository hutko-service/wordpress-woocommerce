<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// if uninstall not called from WordPress exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete options.
delete_option( 'oplata_woocommerce_version' );
delete_option( 'woocommerce_oplata_settings' );
delete_option( 'oplata_unique' ); // <3.0.0 option
