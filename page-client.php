<?php
/*
Template Name: Client Template
*/
get_header();?>

	<main role="main">

		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('client_background_legend')['url']; ?>">
			<div class="overlay">

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'client_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'client_text_legend' ); ?></div>
					<a href="#clients-wrapper-page" class="fa fa-angle-down page-scroll"></a>
				</article>

			</div>
		</section>

		<!-- Service Section
		==========================================-->
		<?php
		$client_background_testimonial = get_field('client_background_testimonial')['url'];
		$client_title_content_testimonials = get_field( 'client_title_content_testimonials' );

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = 18;
		$query_order = 'meta_value';
		$order = 'ASC';

		$client_args = array(
			'post_type'			=> 'client',
			'posts_per_page'	=> $posts_per_page,
			'paged'				=> $paged,
			'orderby'			=> $query_order,
			'order'				=> $order
		);

		$client_query = new WP_Query( $client_args ); ?>
		<?php if ( $client_query->have_posts() ) : ?>

		<section id="clients-wrapper-page" class="text-center">
			<div class="overlay">
				<div class="container">
					<div class="section-title">
						<h3><?php echo get_field( 'client_title_content_icons' ); ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>
					<div id="clients-page" class="row">
						<?php while ( $client_query->have_posts() ) : $client_query->the_post(); ?>
						<div class="item col-md-2 col-sm-3 col-xs-6">
							<?php $client_image = get_field('client_image', $post->ID); ?>
							<img src="<?php echo $client_image['url']; ?>" alt="<?php echo $client_image['alt']; ?>">
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</section>

		<section id="wrapper-testimonials" class="text-center" style="background-image: url(<?php echo $client_background_testimonial; ?>">
			<div class="overlay">
				<div class="container">
					<div class="section-title">
						<h3><?php echo $client_title_content_testimonials; ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>
					<div class="row">
						<?php echo get_field('home_background_testimonial')['url']; ?>
						<div class="col-md-8 col-md-offset-2">
							<div id="testimonial" class="owl-carousel owl-theme">
								<?php while ( $client_query->have_posts() ) : $client_query->the_post(); ?>
								<?php if( get_field( 'client_show_testimonial' ) == true ): ?>
								<div class="item">
									<?php echo get_field( 'client_text_testimonial' ); ?>
									<p>
										<strong><?php echo get_field( 'client_name_testimonial' ); ?></strong>, <?php echo get_field( 'client_position_testimonial' ); ?>
									</p>
								</div>
								<?php endif; ?>
								<?php endwhile; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<?php endif; wp_reset_postdata(); ?>

		<?php //OUR CLIENTS’ TESTIMONIALS ?>

	</main>

<?php get_footer();
