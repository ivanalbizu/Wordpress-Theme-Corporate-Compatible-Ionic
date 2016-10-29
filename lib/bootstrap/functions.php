<?php

global $modules;
$modules[] = array(
	'name'		=> 'bootstrap',
	'version'	=> '3.3.4'
);

function bootstrap_scripts() {
	$lib_path = '/lib/bootstrap';
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {
		wp_register_script( 'bootstrap', get_template_directory_uri() . $lib_path . '/js/bootstrap.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'bootstrap' );
	}
}

add_action('init', 'bootstrap_scripts');

function bootstrap_styles() {
	$lib_path = '/lib/bootstrap';
	wp_register_style( 'bootstrap', get_template_directory_uri() . $lib_path . '/css/bootstrap.css', array(), null, 'all' );
	wp_enqueue_style( 'bootstrap' );
}

add_action( 'wp_enqueue_scripts', 'bootstrap_styles' );
