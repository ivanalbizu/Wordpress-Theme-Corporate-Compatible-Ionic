<?php
/*
Template Name: Service Template
*/
get_header();?>

	<main role="main">

		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('service_background_legend')['url']; ?>">
			<div class="overlay">

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'service_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'service_text_legend' ); ?></div>
					<a href="#service-wrapper-page" class="fa fa-angle-down page-scroll"></a>
				</article>

			</div>
		</section>

		<!-- Service Section
		==========================================-->
		<?php
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
		<?php if ( $service_query->have_posts() ) : ?>
		<section id="service-wrapper-page">
			<div class="overlay">
				<div class="container">

						<div class="section-title text-center">
							<h3><?php echo get_field( 'service_title_content' ); ?></h3>
							<hr class="big-line align-center">
							<hr class="small-line align-center">
							<div class="clearfix"></div>
							<?php echo get_field( 'service_text_content' ); ?>
						</div>

						<div class="space"></div>

						<div id="service-page" class="row">
							<?php while ( $service_query->have_posts() ) : $service_query->the_post(); ?>
							<div class="service col-md-3 col-sm-6">
								<h5>
									<i class="fa fa-<?php echo get_field( 'icon_service' ); ?>"></i>
									<strong><?php the_title(); ?></strong>
								</h5>
								<p><?php the_excerpt(); ?></p>
							</div>
							<?php endwhile; ?>
						</div>

				</div>
			</div>
		</section>
		<?php endif; wp_reset_postdata(); ?>

	</main>

<?php get_footer();
