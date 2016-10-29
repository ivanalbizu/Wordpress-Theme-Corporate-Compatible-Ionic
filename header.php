<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(''); ?><?php if( wp_title( '', false ) ) { echo ' :'; } ?> <?php bloginfo( 'name' ); ?></title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link href="<?php the_favicon_url(); ?>" rel="shortcut icon">
	<link href="<?php the_apple_touch_url(); ?>" rel="apple-touch-icon-precomposed" sizes="144x144">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="Squarespace" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<nav id="wrapper-menu" class="navbar navbar-default navbar-fixed-top">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<img src="<?php the_logo_url(); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-img">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php the_nav_menu(); ?>
			</div><!-- /.navbar-collapse -->

		</div><!-- /.container-fluid -->
	</nav>
