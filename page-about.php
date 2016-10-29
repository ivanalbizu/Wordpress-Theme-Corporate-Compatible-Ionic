<?php

/*
 * Template Name: About
 */

get_header();
global $theme_name; ?>

	<main role="main">

		<!-- Main Section
		==========================================-->
		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('background_main_section')['url']; ?>">
			<div class="overlay">

				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2>Welcome on <strong><span class="primary-color">Blank Template</span></strong></h2>
					<div class="lead"><?php the_content(); ?></div>
					<a href="#" class="fa fa-angle-down"></a>
				</article>

				<?php endwhile; ?>

				<?php else: ?>

				<article>

					<h2><?php _e( 'Sorry, nothing to display.', $theme_name ); ?></h2>

				</article>

				<?php endif; ?>
			</div>
		</section>


		<!-- About Us Section
		==========================================-->

		<!-- <?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = 8;
		$query_order = 'meta_value';
		$order = 'ASC';

		$service_args = array(
			'post_type'			=> 'service',
			'posts_per_page'	=> $posts_per_page,
			'paged'				=> $paged,
			'orderby'			=> $query_order,
			'order'				=> $order
		);

		$service_query = new WP_Query( $service_args ); ?>
		<?php if ( $service_query->have_posts() ) : ?> -->

		<section id="wrapper-about">
				<div class="container">
						<div class="row">
								<div class="col-md-6">
										<img src="<?php echo get_field('image_about')['url']; ?>" class="img-responsive">
								</div>
								<div class="col-md-6">
										<div class="about-text">
												<div class="section-title">
														<h5><?php echo get_field('pretitle_about'); ?></h5>
														<h3><?php echo get_field('title_about'); ?></h3>
														<hr class="big-line align-left">
														<div class="clearfix"></div>
												</div>
												<div class="intro"><?php echo get_field('content_about'); ?></div>
												<div class="about-list"><?php echo get_field('item_about'); ?></div>
										</div>
								</div>
						</div>
				</div>
		</section>
		<!-- <?php endif; wp_reset_postdata(); ?> -->

	</main>

<?php get_footer();
