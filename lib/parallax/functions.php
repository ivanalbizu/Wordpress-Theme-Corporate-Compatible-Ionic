<?php

global $modules;
$modules[] = array(
	'name'		=> 'parallax',
	'version'	=> '1.4.2'
);

function parallax_scripts() {
	$lib_path = '/lib/parallax';
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {
		wp_register_script( 'parallax', get_template_directory_uri() . $lib_path . '/js/parallax.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'parallax' );
	}
}

add_action('init', 'parallax_scripts');
