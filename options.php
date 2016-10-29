<?php


/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;

	update_option( 'optionsframework', $optionsframework_settings );

	// echo $themename;

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	global $theme_name;

	$options = array();

	$wp_editor_settings = array(
		'wpautop' => false,
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// GENERAL OPTIONS

	$options[] = array(
		'name' => __('General options', $theme_name),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Logo', $theme_name),
		'desc' => __('Upload a picture to display as logo. Recommended size is 200x50 px, no outer margin.', $theme_name),
		'id' => 'logo',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Favicon', $theme_name),
		'desc' => __('Upload a picture to display as favicon. Recommended size is 32x32 px. Recommended format is .png', $theme_name),
		'id' => 'favicon',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Apple Touch icon', $theme_name),
		'desc' => __('Upload a picture to display as Apple Touch icon. Recommended size is 144x144 px.', $theme_name),
		'id' => 'apple-touch',
		'type' => 'upload'
	);

	$options[] = array(
		'name' => __('Analytics code', $theme_name),
		'desc' => __('Enter here the google analytics code (UA-XXXXXXXX-X).', $theme_name),
		'id' => 'analytics-code',
		'type' => 'text'
	);


	// SOCIAL NETWORKS

	$options[] = array(
		'name' => __('Social networks', $theme_name),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Facebook link', $theme_name),
		'desc' => __('Enter here the facebook page URL.', $theme_name),
		'id' => 'facebook_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Twitter link', $theme_name),
		'desc' => __('Enter here the twitter page URL.', $theme_name),
		'id' => 'twitter_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Linkedin', $theme_name),
		'desc' => __('Enter here the twitter page URL.', $theme_name),
		'id' => 'linkedin_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Flickr link', $theme_name),
		'desc' => __('Enter here the twitter page URL.', $theme_name),
		'id' => 'flickr_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Youtube link', $theme_name),
		'desc' => __('Enter here the twitter page URL.', $theme_name),
		'id' => 'youtube_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Pinterest link', $theme_name),
		'desc' => __('Enter here the pinterest page URL.', $theme_name),
		'id' => 'pinterest_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Instagram link', $theme_name),
		'desc' => __('Enter here the instagram page URL.', $theme_name),
		'id' => 'instagram_link',
		'type' => 'text'
	);

	$options[] = array(
		'name' => __('Google+ link', $theme_name),
		'desc' => __('Enter here the gplus page URL.', $theme_name),
		'id' => 'gplus_link',
		'type' => 'text'
	);

	return $options;

}
