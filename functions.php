<?php
/*
 *  Author: Ivan
 */

global $theme_name;
global $modules;

$theme_name = 'ivanalbizu';
$modules = array();


foreach ( glob( get_template_directory() . '/lib/*/functions.php') as $lib_functions ) {
	include_once( $lib_functions );
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


if ( function_exists( 'add_theme_support' ) ) {

	global $theme_name;

	add_theme_support( 'menus' );

	add_theme_support( 'post-thumbnails' );
	add_image_size('large', 1170, '', true);	// Large Thumbnail
	add_image_size('medium', 585, '', true);	// Medium Thumbnail
	add_image_size('small', 320, '', true);		// Small Thumbnail

	add_image_size('ionic_team', 40, '', true);		// Ionic Small
	add_image_size('ionic_work', 80, '', true);		// Ionic Medium

}

function the_nav_menu( $location = 'header-menu', $id = 'main-menu', $right = false ) {

	wp_nav_menu(
	array(
		'theme_location'	=> $location,
		'menu'				=> '',
		'container'			=> 'div',
		'container_class'	=> 'menu-{menu slug}-container',
		'container_id'		=> '',
		'menu_class'		=> 'collapse navbar-collapse',
		'menu_id'			=> 'bs-example-navbar-collapse-1',
		'echo'				=> true,
		'fallback_cb'		=> 'wp_page_menu',
		'before'			=> '',
		'after'				=> '',
		'link_before'		=> '',
		'link_after'		=> '',
		'items_wrap'		=> '<ul id="' . $id . '" class="nav navbar-nav navbar-right">%3$s</ul>',
		'depth'				=> 0,
		'walker'			=> ''
		)
	);
}


// Load header scripts (header.php)
function load_header_scripts() {
	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) {

		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.2.1.4.min.js', false, null );
		wp_enqueue_script( 'jquery' );

		wp_register_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-isotope' );

		wp_register_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'owl-carousel' );

		wp_enqueue_script('remodal', get_template_directory_uri() . '/js/remodal.min.js', array( 'jquery' ), null, true);
		wp_enqueue_script( 'remodal' );

		wp_register_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'owl-carousel', 'jquery' ), null, true );
		wp_enqueue_script( 'main' );
	}
}


function load_styles() {

	global $theme_name;

	wp_register_style('reset', get_template_directory_uri() . '/css/reset.css', array(), null, 'all');
	wp_enqueue_style('reset');

	/* Optional: default classes for wp editor */
	wp_register_style('wp', get_template_directory_uri() . '/css/wp.css', array(), null, 'all');
	wp_enqueue_style('wp');

	wp_register_style('util', get_template_directory_uri() . '/css/util.css', array(), null, 'all');
	wp_enqueue_style('util');

	// wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), null, 'all');
	// wp_enqueue_style('responsive');

	wp_register_style('print', get_template_directory_uri() . '/css/print.css', array(), null, 'all');
	wp_enqueue_style('print');

	wp_register_style('font-awesome', get_template_directory_uri() . '/font/font-awesome/css/font-awesome.min.css', array(), null, 'all');
	wp_enqueue_style('font-awesome');

	wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), null, 'all');
	wp_enqueue_style('animate');

	wp_register_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), null, 'all');
	wp_enqueue_style('owl.carousel');

	wp_register_style('owl.theme', get_template_directory_uri() . '/css/owl.theme.css', array(), null, 'all');
	wp_enqueue_style('owl.theme');

	wp_register_style('remodal', get_template_directory_uri() . '/css/remodal.css', array(), null, 'all');
	wp_enqueue_style('remodal');

	wp_register_style('remodal-default-theme', get_template_directory_uri() . '/css/remodal-default-theme.css', array(), null, 'all');
	wp_enqueue_style('remodal-default-theme');

	wp_register_style('style', get_template_directory_uri() . '/css/style.css', array('owl.theme', 'owl.carousel'), null, 'all');
	wp_enqueue_style('style');
}

function load_admin_styles() {

	wp_register_style( 'admin_custom', get_template_directory_uri() . '/css/admin.css', false, null );
	wp_enqueue_style( 'admin_custom' );

}

// Register Navigation
function custom_register_nav_menu() {

	global $theme_name;

	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', $theme_name )
	));
}


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function alter_wp_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function remove_class_id_filter( $var ) {
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the category list
function remove_category_rel_from_category_list( $thelist ) {
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Custom Excerpts
function excerpt_length_default( $length ) { // Create 20 Word Callback for Index page Excerpts, call using custom_excerpt( 'excerpt_length_default' );
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using custom_excerpt( 'excerpt_length_custom_post' );
function excerpt_length_custom_post( $length ) {
	return 40;
}

// Create the Custom Excerpts callback
function custom_excerpt( $length_callback = '', $more_callback = '' ) {

	global $post;

	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}

	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}

	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';

	echo $output;
}


// Remove Admin bar
function remove_admin_bar() {
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}


/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'load_header_scripts'); // Add Custom Scripts to wp_head
//add_action('wp_print_scripts', 'load_conditional_scripts'); // Add Conditional Page Scripts
//add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'load_styles'); // Add Theme Stylesheet
add_action('admin_enqueue_scripts', 'load_admin_styles' ); // Add Admin Stylesheet
add_action('init', 'custom_register_nav_menu'); // Add custom Menu
add_action('init', 'create_custom_post_types'); // Add custom Post Type
//add_action('init', 'the_pagination'); // Add pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Dequeue emoji CSS
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Add Filters
add_filter('wp_nav_menu_args', 'alter_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('nav_menu_item_id', 'remove_class_id_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether

/* Custom Post Types */
function create_custom_post_types() {
	// Courses
	$taxonomy_args = array(
		'hierarchical'	=> true
	);

	create_post_type( 'team', array( 'team_category' ) );
	register_taxonomy( 'team_category', 'team', $taxonomy_args );
	register_taxonomy_for_object_type( 'team_category', 'course' );

	create_post_type( 'service', array( 'service_category' ), 'servicio', 'Servicio', 'Servicios' );
	register_taxonomy( 'service_category', 'service', $taxonomy_args );
	register_taxonomy_for_object_type( 'service_category', 'service' );

	create_post_type( 'client', array( 'client_category' ), 'cliente', 'Cliente', 'Clientes', array( 'title' ) );
	register_taxonomy( 'client_category', 'client', $taxonomy_args );
	register_taxonomy_for_object_type( 'client_category', 'client' );

	create_post_type( 'work', array( 'work_category' ), 'trabajo', 'Trabajo', 'Trabajos' );
	register_taxonomy( 'work_category', 'work', $taxonomy_args );
	register_taxonomy_for_object_type( 'work_category', 'work' );

}

function create_post_type( $post_type_name, $taxonomies = '', $slug = '', $singular_name = '', $plural_name = '', $supports = '' ) {

	global $theme_name;

	if ( $singular_name == '' ) {
		$singular_name = $post_type_name;
	}

	if ( $plural_name == '' ) {
		$plural_name = $post_type_name . 's';
	}

	if ( $slug == '' ) {
		$slug = $singular_name;
	}

	if ( $supports == '' ) {
		$supports = array( 'title', 'editor', 'excerpt', 'thumbnail'	);
	}

	$post_type_labels = array(
		'name'					=> __( ucfirst( $plural_name ), $theme_name ),
		'singular_name'			=> __( ucfirst( $singular_name ), $theme_name ),
		'add_new'				=> __( 'Add New', $theme_name ),
		'add_new_item'			=> __( 'Add New ' . $singular_name, $theme_name ),
		'edit'					=> __( 'Edit', $theme_name ),
		'edit_item'				=> __( 'Edit ' . $singular_name, $theme_name ),
		'new_item'				=> __( 'New ' . $singular_name, $theme_name ),
		'view'					=> __( 'View ' . $singular_name, $theme_name ),
		'view_item'				=> __( 'View ' . $singular_name, $theme_name ),
		'search_items'			=> __( 'Search ' . $singular_name, $theme_name ),
		'not_found'				=> __( 'No ' . $plural_name . ' found', $theme_name ),
		'not_found_in_trash'	=> __( 'No ' . $plural_name . ' found in Trash', $theme_name )
	);

	$post_type_options = array(
		'labels'			=> $post_type_labels,
		'public'			=> true,
		'hierarchical'		=> true,
		'has_archive'		=> true,
		'can_export'		=> true,
		'supports'			=> $supports,
		'rewrite'			=> array( 'slug' => $slug ),
		'menu_icon'   => 'dashicons-admin-page',
		'show_in_rest'=> true
	);

	if ( $taxonomies != '' && !empty( $taxonomies ) ) {
		$post_type_options['taxonomies'] = $taxonomies;
	}

	register_post_type( $post_type_name, $post_type_options );
}



// Change default sender name for emails
function new_mail_from_name( $old ) {
	return get_bloginfo();
}
add_filter( 'wp_mail_from_name', 'new_mail_from_name' );

// Get thumbnail url
function get_thumb_url( $id, $size = 'full', $default = '/img/default_team.png' ) {

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
	$image = $image[ 0 ];

	if ( $image ) {
		$image_url = $image;
	} else {
		$image_url = get_template_directory_uri() . $default;
	}

	return $image_url;
}

function the_thumb_url( $id, $size = 'full', $default = '/img/default_team.png' ) {
	echo get_thumb_url( $id, $size, $default );
}

// Get thumbnail alt
function get_thumb_alt( $id ) {
	$img_id = get_post_thumbnail_id( $id );
	$alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);

	return $alt_text;
}

function the_thumb_alt( $id ) {
	echo get_thumb_alt( $id );
}

function get_slug_categories_for_custom_post( $id = '', $taxonomy = '' ) {
	if ( $taxonomy == '')
		return '';
	$slug = '';

	$term_list = wp_get_post_terms( $id, $taxonomy, array("fields" => "all") );
	if ( $term_list && !is_wp_error( $term_list ) )
		foreach($term_list as $term_single)
			$slug .= $term_single->slug . ' ';

	echo trim($slug);
}

function get_name_categories_for_custom_post( $id = '', $taxonomy = '' ) {
	if ( $taxonomy == '')
		return '';
	$name = '';

	$term_list = wp_get_post_terms( $id, $taxonomy, array("fields" => "all") );
	if ( $term_list && !is_wp_error( $term_list ) )
		foreach($term_list as $term_single)
			$name .= $term_single->name . ' / ';

	echo substr($name, 0, -3);
}



/**
 * Hide editor on specific pages.
 */
function hide_editor() {

	global $pagenow;
	if( !( 'post.php' == $pagenow ) ) return;

	global $post;
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

	$hide_selected = array( 'Home', 'page-team.php' );

	foreach ( $hide_selected as $value ) {
		$homepgname = get_the_title($post_id);
		$template_file = get_post_meta($post_id, '_wp_page_template', true);
		if( $homepgname == $value || $template_file == $value ){
			remove_post_type_support('page', 'editor');
		}
	}

}
add_action( 'admin_head', 'hide_editor' );




/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option( $name, $default = false ) {

		$optionsframework_settings = get_option( 'optionsframework' );

		$option_name = $optionsframework_settings['id'];

		if ( get_option( $option_name ) ) {
			$options = get_option( $option_name );
		}

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

// Deregister Contact Form 7 CSS files on all pages without a form
add_action( 'wp_print_styles', 'deregister_cf7_style', 100 );
function deregister_cf7_style() {
	if ( !is_page( 'contact ') ) {
		wp_deregister_style( 'contact-form-7' );
	}
}

// Deregister Contact Form 7 JavaScript files on all pages without a form
add_action( 'wp_print_scripts', 'deregister_cf7_script', 100 );
function deregister_cf7_script() {
	if ( ! is_page( 'contact' ) ) {
		wp_deregister_script( 'contact-form-7' );
	}
}

// Check wether a theme module is loaded
function is_module_loaded( $module_name = '' ) {

	global $modules;

	$found = false;

	if ( $module != '' ) {
		foreach ( $modules as $module ) {
			if ( $module['name'] == $module_name ) {
				$found = true;
				break;
			}
		}
	}
	return $found;
}


function get_logo_url() {

	$logo_url = get_template_directory_uri() . '/img/logo.png';

	if ( of_get_option( 'logo' ) ) {
		$logo_url = of_get_option( 'logo' );
	}

	return $logo_url;

}

function the_logo_url() {
	echo get_logo_url();
}

function get_favicon_url() {

	$favicon_url = get_template_directory_uri() . '/img/icon/favicon.png';

	if ( of_get_option( 'favicon' ) ) {
		$favicon_url = of_get_option( 'favicon' );
	}

	return $favicon_url;

}

function the_favicon_url() {
	echo get_favicon_url();
}

function get_apple_touch_url() {

	$apple_touch_url = get_template_directory_uri() . '/img/icon/touch.png';

	if ( of_get_option( 'apple-touch' ) ) {
		$apple_touch_url = of_get_option( 'apple-touch' );
	}

	return $apple_touch_url;

}

function the_apple_touch_url() {
	echo get_apple_touch_url();
}

function the_analytics_script() {
	if ( $analytics_code = of_get_option( 'analytics-code' ) ) { ?>

		<script>

			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo $analytics_code; ?>', 'auto');
			ga('send', 'pageview');

		</script>

	<?php }
}


function get_social_menu( $id = "social-menu", $class = "footer-social", $show = array() ) {

	$result = '';

	$facebook		= of_get_option( 'facebook_link' );
	$twitter		= of_get_option( 'twitter_link' );
	$linkedin		= of_get_option( 'linkedin_link' );
	$gplus 			= of_get_option( 'gplus_link' );
	$youtube 		= of_get_option( 'youtube_link' );
	$instagram 	= of_get_option( 'instagram_link' );
	$pinterest 	= of_get_option( 'pinterest_link' );
	$linkedin 	= of_get_option( 'linkedin_link' );

	if ( $facebook || $twitter || $linkedin || $gplus || $youtube || $instagram || $pinterest || $linkedin  ) {
		if ( empty( $show ) ) {

			ob_start(); ?>

			<ul id="<?php echo $id; ?>" class="<?php echo $class; ?>">
				<?php if ( $facebook ) { ?>
				<li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if ( $twitter ) { ?>
				<li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if ( $linkedin ) { ?>
				<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
				<?php if ( $gplus ) { ?>
				<li><a href="<?php echo $gplus; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if ( $youtube ) { ?>
				<li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
				<?php } ?>
				<?php if ( $instagram ) { ?>
				<li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php } ?>
				<?php if ( $pinterest ) { ?>
				<li><a href="<?php echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
				<?php } ?>
				<?php if ( $linkedin ) { ?>
				<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>

			<?php
			$result = ob_get_clean();

		} else {

			ob_start(); ?>

			<ul id="<?php echo $id; ?>" class="<?php echo $class; ?>">
				<?php if ( $facebook && $show['chk_face'] ) { ?>
				<li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if ( $twitter && $show['chk_twitter'] ) { ?>
				<li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if ( $linkedin && $show['chk_linkedin'] ) { ?>
				<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
				<?php if ( $gplus && $show['chk_gplus'] ) { ?>
				<li><a href="<?php echo $gplus; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if ( $youtube && $show['chk_youtube'] ) { ?>
				<li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
				<?php } ?>
				<?php if ( $instagram && $show['chk_instagram'] ) { ?>
				<li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php } ?>
				<?php if ( $pinterest && $show['chk_pinterest'] ) { ?>
				<li><a href="<?php echo $pinterest; ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
				<?php } ?>
				<?php if ( $linkedin && $show['chk_linkedin'] ) { ?>
				<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>

			<?php
			$result = ob_get_clean();

		}
	}

	return $result;
}

function the_social_menu( $id = "social-menu", $class = "footer-social", $show = array() ) {
	echo get_social_menu( $id, $class, $show );
}


function tolowerdash($string) {
  $string = strtolower($string);
  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
  $string = preg_replace("/[\s-]+/", " ", $string);
  $string = preg_replace("/[\s_]/", "-", $string);
  return $string;
}



function is_mobile() {
	$useragent = $_SERVER[ 'HTTP_USER_AGENT' ];

	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
}

function is_ipad() {
	$useragent = $_SERVER[ 'HTTP_USER_AGENT' ];

	return (bool) preg_match( '/iPad|iPhone OS 3_1_2|iPhone OS 3_2_2/i', $useragent );
}




if ( is_plugin_active( 'rest-api/plugin.php' ) ) {
	/**
	* Add the field "spaceship" to REST API responses for posts read and write
	*/
	add_action( 'rest_api_init', 'slug_register_spaceship' );
	function slug_register_spaceship() {

		register_rest_field( 'work',
				'work_details',
				array(
						'get_callback'    => 'slug_get_spaceship',
						'update_callback' => 'slug_update_spaceship',
						'schema'          => null,
				)
		);
		register_rest_field( 'work',
				'name_categories',
				array(
						'get_callback'    => 'ng_get_name_categories_for_custom_post',
						'update_callback' => null,
						'schema'          => null,
				)
		);
	}


	/**
	 * Handler for getting custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param array $object The object from the response
	 * @param string $field_name Name of field
	 * @param WP_REST_Request $request Current request
	 *
	 * @return mixed
	 */
	function slug_get_spaceship( $object, $field_name, $request ) {
	  return get_post_meta( $object[ 'id' ], $field_name );
	}

	/**
	 * Handler for updating custom field data.
	 *
	 * @since 0.1.0
	 *
	 * @param mixed $value The value of the field
	 * @param object $object The object from the response
	 * @param string $field_name Name of field
	 *
	 * @return bool|int
	 */
	function slug_update_spaceship( $value, $object, $field_name ) {
	  if ( ! $value || ! is_string( $value ) ) {
	    return;
	  }

	  return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	}




	add_action( 'rest_api_init', 'ng_thumbnail_url' );
	function ng_thumbnail_url() {


	    register_rest_field( 'team',
	        'url_team_thumbnail',
	        array(
	            'get_callback'    => 'ng_get_thumbnail_url',
	            'update_callback' => null,
	            'schema'          => null,
	        )
	    );

			register_rest_field( 'work',
					'url_work_thumbnail',
					array(
							'get_callback'    => 'ng_get_thumbnail_url',
							'update_callback' => null,
							'schema'          => null,
					)
			);
			register_rest_field( 'work',
					'url_work_gallery',
					array(
							'get_callback'    => 'ng_get_post_galleries_images',
							'update_callback' => null,
							'schema'          => null,
					)
			);

	}

	function ng_get_thumbnail_url( $post ) {
		// Default images size to Return
		$sizes = ['thumbnail', 'medium'];
		$imgArray = [];

		if ( has_post_thumbnail( $post['id'] ) ){
			$post_type = get_post_type();

			switch ( $post_type ) {
				case 'team':
					// Add new images size for post type 'team'
					$sizes['ionic_team'] = 'ionic_team';
					// Iterate over selected sizes
					foreach ($sizes as $size) {
						//wp_get_attachment_image_src(id, size)[0] -> with [0] get URL from attachment
						$imgArray[$size] = wp_get_attachment_image_src( get_post_thumbnail_id( $post['id'] ), $size )[0];
					}
					break;
				case 'work':
					// Add new images size for post type 'work'
					$sizes['ionic_work'] = 'ionic_work';
					foreach ($sizes as $size) {
						$imgArray[$size] = wp_get_attachment_image_src( get_post_thumbnail_id( $post['id'] ), $size )[0];
					}
					break;
				default:
					foreach ($sizes as $size) {
						$imgArray[$size] = wp_get_attachment_image_src( get_post_thumbnail_id( $post['id'] ), $size )[0];
					}
					break;
			}
			return $imgArray;
		}else{
			return false;
		}
	}

	// No usado
	function ng_acf_url_clients_images( $post ) {
		if ( function_exists( 'get_fields' ) ) {
			if( get_field('client_image', $post['id']) ) {
				// Not adding ['url'] get mor options images
				return get_field( 'client_image', $post['id']);
			} else {
				return false;
			}
		}
		return false;
	}
	function ng_get_post_galleries_images() {
		global $post;
		$result = array();
		if ( $galleries = get_post_galleries_images( $post ) ) {
			foreach ( $galleries as $gallery ) {
				foreach ( $gallery as $src ) {
					$result[] = $src;
				}
			}
		}
		return $result;
	}

	// Best functions.
	// Return all fields create with ACF created for
	// for specified Type Post (this case: team)
	function wp_rest_api_alter() {
		register_api_field( 'service',
	      'fields',
	      array(
	        'get_callback'    => 'get_all_fields_acf',
	        'update_callback' => null,
	        'schema'          => null,
	      )
	  );
	  register_api_field( 'client',
	      'fields',
	      array(
	        'get_callback'    => 'get_all_fields_acf',
	        'update_callback' => null,
	        'schema'          => null,
	      )
	  );
		register_api_field( 'team',
				'fields',
				array(
					'get_callback'    => 'get_all_fields_acf',
					'update_callback' => null,
					'schema'          => null,
				)
		);
		register_api_field( 'work',
				'fields',
				array(
					'get_callback'    => 'get_all_fields_acf',
					'update_callback' => null,
					'schema'          => null,
				)
		);
	}
	function get_all_fields_acf($data, $field, $request, $type) {
		if ( function_exists( 'get_fields' ) ) {
			return get_fields($data['id']);
		}
		return [];
	}
	add_action( 'rest_api_init', 'wp_rest_api_alter');


	function ng_get_name_categories_for_custom_post( $post ) {
		$result = '';
		if ( function_exists( 'get_fields' ) ) {
			$term_list = wp_get_object_terms( $post, 'work_category', array("fields" => "ids") );
			if ( $term_list && !is_wp_error( $term_list ) )
				foreach($term_list as $term_single)
					$result .= get_the_category_by_ID( $term_single ) . ' / ';

			return substr($result, 0, -3);;
		}
		return $result;
	}

	/**
	* Add REST API support to an already registered taxonomy.
	*/
	//No lo he usado
	add_action( 'init', 'my_custom_taxonomy_rest_support', 25 );
	function my_custom_taxonomy_rest_support() {
		global $wp_taxonomies;

		//be sure to set this to the name of your taxonomy!
		$taxonomy_name = 'work_category';

		if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
			$wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
			$wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
			$wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
		}
	}

}
