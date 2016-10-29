<?php
/*
Template Name: Team Template
*/
get_header();?>

	<main role="main">

		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('team_background_legend')['url']; ?>">
			<div class="overlay">

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'team_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'team_text_legend' ); ?></div>
					<a href="#wrapper-about" class="fa fa-angle-down page-scroll"></a>
				</article>

			</div>
		</section>


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
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = 8;
		$query_order = 'meta_value';
		$order = 'ASC';

		$team_args = array(
			'post_type'			=> 'team',
			'posts_per_page'	=> $posts_per_page,
			'paged'				=> $paged,
			'orderby'			=> $query_order,
			'order'				=> $order
		);

		$team_query = new WP_Query( $team_args ); ?>
		<?php if ( $team_query->have_posts() ) : ?>
		<section id="team-wrapper-page" class="text-center">
			<div class="overlay no-padding-top">
				<div class="container">

					<div class="section-title">
						<h3><?php echo get_field( 'team_title_content' ); ?></h3>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
					</div>

					<div id="team-page" class="row">
						<?php while ( $team_query->have_posts() ) : $team_query->the_post(); ?>
						<div class="item col-md-3 col-sm-6">
							<?php //print_r($post_object->ID); ?>
							<?php //print_r($post_object); ?>
							<div class="thumbnail">
								<img src="<?php the_thumb_url($post->ID); ?>" alt="<?php the_thumb_alt($post->ID); ?>" class="img-circle team-img">
								<div class="caption">
									<h4><?php the_title(); ?></h4>
									<p><?php echo get_field( 'position_team' ); ?></p>
									<p><?php the_excerpt(); ?></p>
									<ul class="link-social">
										<?php if ( $link = get_field( 'facebook_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'twitter_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'gplus_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'youtube_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'instagram_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'pinterest_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
										<?php } ?>
										<?php if ( $link = get_field( 'linkedin_link' ) ) { ?>
										<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
										<?php } ?>
									</ul>
								</div>

								<a title="Ver <?php the_title(); ?>" href="#modal-team-<?php the_ID(); ?>" class="btn btn-custom btn-default btn-small btn-read-more">Ver más</a>
								<!-- Comienza popup -->
								<div class="remodal" data-remodal-id="modal-team-<?php the_ID(); ?>" role="dialog">
								  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
								  <div class="container-fluid">
										<div class="col-md-4">
											<img src="<?php the_thumb_url($post->ID); ?>" alt="<?php the_thumb_alt($post->ID); ?>" class="team-img">
										</div>
										<div class="col-md-8 extended-content-modal">
											<h4><?php the_title(); ?></h4>
											<?php the_content(); ?>
											<ul class="link-social text-center">
												<?php if ( $link = get_field( 'facebook_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'twitter_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'gplus_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'youtube_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'instagram_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'pinterest_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
												<?php } ?>
												<?php if ( $link = get_field( 'linkedin_link' ) ) { ?>
												<li><a href="<?php echo $link; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
												<?php } ?>
											</ul>
										</div>
								  </div>
								</div>
								<!-- Termina popup -->

							</div>
						</div>
						<?php endwhile; ?>
					</div>

				</div>
			</div>
		</section>
		<?php endif; wp_reset_postdata(); ?>

	</main>

<?php get_footer();
