<?php

/*
 * Template Name: Home
 */

get_header();
global $theme_name; ?>

	<main role="main">

		<!-- Main Section
		==========================================-->
		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('home_background_main_section')['url']; ?>">
			<div class="overlay">

				<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'home_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'home_text_legend' ); ?></div>
					<a href="#wrapper-about" class="fa fa-angle-down page-scroll"></a>
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
		<section id="wrapper-about">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<img src="<?php echo get_field('home_image_about')['url']; ?>" alt="<?php echo get_field('home_image_about')['alt']; ?>" class="img-responsive">
					</div>
					<div class="col-md-6">
						<div class="about-text">
							<div class="section-title">
								<h5><?php echo get_field( 'home_pretitle_about' ); ?></h5>
								<h3><?php echo get_field( 'home_title_about' ); ?></h3>
								<hr class="big-line align-left">
								<div class="clearfix"></div>
							</div>
							<div class="intro"><?php echo get_field('home_content_about'); ?></div>
							<div class="about-list"><?php echo get_field('home_item_about'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<!-- Team Section
		==========================================-->
		<?php
		$post_objects = get_field('home_team');
		if( $post_objects ): ?>

		<section id="wrapper-team" class="text-center"  style="background-image: url(<?php echo get_field('home_bakground_team')['url']; ?>">
			<div class="overlay">
				<div class="container">

					<div class="section-title">
						<h3><?php echo get_field( 'home_title_team' ); ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>

					<div id="team" class="owl-carousel owl-theme row">
						<?php foreach( $post_objects as $post_object): ?>
						<div class="item">
							<?php //print_r($post_object->ID); ?>
							<?php //print_r($post_object); ?>
							<div class="thumbnail">
								<img src="<?php the_thumb_url($post_object->ID); ?>" alt="<?php the_thumb_alt($post_object->ID); ?>" class="img-circle team-img">
								<div class="caption">
									<h4><?php echo $post_object->post_title; ?></h4>
									<p><?php echo get_field('position_team', $post_object->ID); ?></p>
									<p><?php echo $post_object->post_excerpt; ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

				</div>
			</div>
		</section>

		<?php endif; ?>


		<!-- Services Section
		==========================================-->
		<?php
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = 4;
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
		<section id="wrapper-services" class="text-center">
			<div class="container">
				<div class="section-title">
					<h3><?php echo get_field('home_title_services'); ?></h3>
					<hr class="big-line align-center">
					<hr class="small-line align-center">
					<div class="clearfix"></div>
					<?php echo get_field('home_text_services'); ?>
				</div>

				<div class="space"></div>
				<div class="row">
					<?php while ( $service_query->have_posts() ) : $service_query->the_post(); ?>
					<div class="col-md-3 col-sm-6 service">
						<i class="fa fa-<?php echo get_field('icon_service'); ?>"></i>
						<h5><strong><?php the_title(); ?></strong></h5>
						<p><?php the_excerpt(); ?></p>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>
		<?php endif; wp_reset_postdata(); ?>



		<!-- Clients Section
		==========================================-->
		<?php
		$post_objects = get_field('home_image_client');
		if( $post_objects ): ?>

		<section id="wrapper-clients" class="text-center" style="background-image: url(<?php echo get_field('home_background_client')['url']; ?>">
			<div class="overlay">
				<div class="container">
					<div class="section-title">
						<h3><?php echo get_field('home_title_client'); ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>
					<div id="clients" class="owl-carousel owl-theme">
						<?php foreach( $post_objects as $post_object): ?>
						<div class="item">
							<?php $client_image = get_field('client_image', $post_object->ID); ?>
							<img src="<?php echo $client_image['url']; ?>" alt="<?php echo $client_image['alt']; ?>">
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<?php endif; ?>


		<!-- Portfolio Section
		==========================================-->
		<?php
		$post_objects = get_field('home_work');
		if( $post_objects ): ?>

		<section id="wrapper-works" class="text-center">
			<div class="container"> <!-- Container -->
				<div class="section-title">
					<h3><?php echo get_field( 'home_title_work' ); ?></h3>
					<hr class="big-line align-center">
					<hr class="small-line align-center">
					<div class="clearfix"></div>
					<small><?php echo get_field( 'home_text_work' ); ?></small>
				</div>

				<div class="space"></div>

				<?php
				$terms = get_terms( 'work_category' );
				if ( $terms && !is_wp_error( $terms ) ) : ?>
				<div id="categories">
					<ul class="cat">
						<li class="pull-left"><h5>Filter by Type:</h5></li>
						<li class="pull-right">
							<ol class="type">
								<li><a href="#" data-filter="*" class="active">All</a></li>
								<?php foreach ( $terms as $term ) : ?>
								<li><a href="#" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
								<?php endforeach; ?>
							</ol>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<?php endif; ?>

				<div id="lightbox" class="row">
					<?php foreach( $post_objects as $post_object): ?>
					<div class="col-sm-6 col-md-3 col-lg-3 <?php get_slug_categories_for_custom_post( $post_object->ID, 'work_category' ); ?>">
						<div class="portfolio-item">
							<div class="hover-bg">
								<?php
								if( get_page_by_title( 'works' ) ) {
									$url_work = esc_url( get_permalink( get_page_by_title( 'works' ) ) ) . '#modal-work-' . $post_object->ID;
								} else {
									$url_work = '#';
								} ?>
								<a href="<?php echo $url_work; ?>">
									<div class="hover-text">
										<h5><?php echo $post_object->post_title; ?></h5>
										<small><?php get_name_categories_for_custom_post( $post_object->ID, 'work_category' ); ?></small>
										<div class="clearfix"></div>
										<i class="fa fa-plus"></i>
									</div>
									<img src="<?php the_thumb_url($post_object->ID); ?>" class="img-responsive" alt="<?php the_thumb_alt($post_object->ID); ?>">
								</a>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php endif; ?>



		<!-- Testimonials Section
		==========================================-->
		<?php
		$post_objects = get_field('home_testimonial');
		if( $post_objects ): ?>

		<section id="wrapper-testimonials" class="text-center" style="background-image: url(<?php echo get_field('home_background_testimonial')['url']; ?>">
			<div class="overlay">
				<div class="container">
					<div class="section-title">
						<h3><?php echo get_field( 'home_title_testimonial' ); ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<div id="testimonial" class="owl-carousel owl-theme">
								<?php foreach( $post_objects as $post_object): ?>
								<div class="item">
										<h5><?php echo get_field('client_text_testimonial', $post_object->ID); ?></h5>
										<p><strong><?php echo get_field('client_name_testimonial', $post_object->ID); ?></strong>, <?php echo get_field('client_position_testimonial', $post_object->ID); ?></p>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php endif; ?>


		<!-- Contact Section
		==========================================-->
		<section id="wrapper-contact" class="text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">

						<div class="section-title">
								<h2><?php echo get_field( 'home_title_contact' ); ?></h2>
								<hr class="big-line align-center">
								<hr class="small-line align-center">
								<div class="clearfix"></div>
								<small><?php echo get_field( 'home_text_contact' ); ?></small>
						</div>

					</div>
				</div>
			</div>
		</section>


	</main>

<?php get_footer();
