<?php

global $modules;
$modules[] = array(
	'name'		=> 'cbp-animated-header',
	'version'	=> '1.0.0'
);

function cbp_animated_header_scripts() {
	$lib_path = '/lib/cbp-animated-header';
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {
		wp_register_script( 'cbp-animated-header', get_template_directory_uri() . $lib_path . '/js/cbpAnimatedHeader.min.js', array( 'jquery', 'classie' ), null, true );
		wp_enqueue_script( 'cbp-animated-header' );
	}
}

add_action('init', 'cbp_animated_header_scripts');
