<?php
/*
Template Name: Contact Template
*/
get_header();?>

	<main role="main">

		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('contact_background_legend')['url']; ?>">
			<div class="overlay">

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'contact_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'contact_text_legend' ); ?></div>
					<a href="#wrapper-contact" class="fa fa-angle-down page-scroll"></a>
				</article>

			</div>
		</section>


		<!-- Contact Section
		==========================================-->
		<?php if ( have_posts() ) : ?>
		<section id="wrapper-contact">
			<div class="container">
				<div class="row">

					<div class="col-md-8 col-md-offset-2 generic-wrapper-bottom-40 text-center">
						<div class="section-title">
							<h2><?php echo get_field( 'contact_title_content' ); ?></h2>
							<hr class="big-line align-center">
							<hr class="small-line align-center">
						</div>
						<?php while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
						<?php endwhile; ?>
					</div>

					<div class="col-sm-4 generic-wrapper-bottom-40">
						<?php
							$delegation_title_one = get_field( 'delegation_title_one' );
							$delegation_title_two = get_field( 'delegation_title_two' );
							$delegation_title_three = get_field( 'delegation_title_three' );
							$delegation_title_four = get_field( 'delegation_title_four' );
							$delegation_text_one = get_field( 'delegation_text_one' );
							$delegation_text_two = get_field( 'delegation_text_two' );
							$delegation_text_three = get_field( 'delegation_text_three' );
							$delegation_text_four = get_field( 'delegation_text_four' );
						?>
						<ul class="nav nav-pills nav-stacked">
							<?php if ( $delegation_title_one ) { ?>
							<li class="active"><a data-toggle="tab" href=".<?php echo tolowerdash($delegation_title_one); ?>"><h5><?php echo $delegation_title_one; ?></h5></a></li>
							<?php } ?>
							<?php if ( $delegation_title_two ) { ?>
							<li><a data-toggle="tab" href=".<?php echo tolowerdash($delegation_title_two); ?>"><h5><?php echo $delegation_title_two; ?></h5></a></li>
							<?php } ?>
							<?php if ( $delegation_title_three ) { ?>
							<li><a data-toggle="tab" href=".<?php echo tolowerdash($delegation_title_three); ?>"><h5><?php echo $delegation_title_three; ?></h5></a></li>
							<?php } ?>
							<?php if ( $delegation_title_four ) { ?>
							<li><a data-toggle="tab" href=".<?php echo tolowerdash($delegation_title_four); ?>"><h5><?php echo $delegation_title_four; ?></h5></a></li>
							<?php } ?>
						</ul>
					</div>
					<div class="col-sm-7 col-sm-offset-1 generic-wrapper-bottom-40">
						<div class="tab-content">
							<?php if ( $delegation_title_one && $delegation_text_one ) { ?>
						  <div id="" class="tab-pane fade in active <?php echo tolowerdash($delegation_title_one); ?>">
						    <h4><?php echo $delegation_title_one; ?></h4>
								<hr class="big-line align-left">
						    <?php echo $delegation_text_one; ?>
						  </div>
							<?php } ?>
							<?php if ( $delegation_title_two && $delegation_text_two ) { ?>
						  <div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_two); ?>">
						    <h4><?php echo $delegation_title_two; ?></h4>
								<hr class="big-line align-left">
						    <?php echo $delegation_text_two; ?>
						  </div>
							<?php } ?>
							<?php if ( $delegation_title_three && $delegation_text_three ) { ?>
							<div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_three); ?>">
								<h4><?php echo $delegation_title_three; ?></h4>
								<hr class="big-line align-left">
								<?php echo $delegation_text_three; ?>
							</div>
							<?php } ?>
							<?php if ( $delegation_title_four && $delegation_text_four ) { ?>
							<div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_four); ?>">
								<h4><?php echo $delegation_title_four; ?></h4>
								<hr class="big-line align-left">
								<?php echo $delegation_text_four; ?>
							</div>
							<?php } ?>
						</div>
						<?php
						$show = [
							"chk_face" => get_field( 'chk_face' ),
							"chk_twitter" => get_field( 'chk_twitter' ),
							"chk_linkedin" => get_field( 'chk_linkedin' ),
							"chk_gplus" => get_field( 'chk_gplus' ),
							"chk_youtube" => get_field( 'chk_youtube' ),
							"chk_instagram" => get_field( 'chk_instagram' ),
							"chk_pinterest" => get_field( 'chk_pinterest' ),
							"chk_flickr" => get_field( 'chk_flickr' ),
						];
						the_social_menu( "social-menu", "link-social", $show); ?>
					</div>
				</div>
			</div>
		</section>
		<?php endif; wp_reset_postdata(); ?>


		<?php if ( $map = get_field( 'delegation_map_one' ) ): ?>
		<section class="maps">
			<div class="tab-content">
				<?php if ( $delegation_map_one = get_field( 'delegation_map_one' ) ) { ?>
				<div id="" class="tab-pane fade in active <?php echo tolowerdash($delegation_title_one); ?>">
					<?php echo $delegation_map_one; ?>
				</div>
				<?php } ?>
				<?php if ( $delegation_map_two = get_field( 'delegation_map_two' ) ) { ?>
				<div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_two); ?>">
					<?php echo $delegation_map_two; ?>
				</div>
				<?php } ?>
				<?php if ( $delegation_map_three = get_field( 'delegation_map_three' ) ) { ?>
				<div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_three); ?>">
					<?php echo $delegation_map_three; ?>
				</div>
				<?php } ?>
				<?php if ( $delegation_map_four = get_field( 'delegation_map_four' ) ) { ?>
				<div id="" class="tab-pane fade <?php echo tolowerdash($delegation_title_four); ?>">
					<?php echo $delegation_map_four; ?>
				</div>
				<?php } ?>
			</div>
		</section>
		<?php endif; ?>


		<?php if ( $form = get_field( 'contact_embeded_form' ) ): ?>
		<section class="generic-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="section-title text-center">
							<h3 class="text-center"><?php echo get_field( 'contact_title_form' ); ?></h3>
						</div>
						<?php echo do_shortcode( '[contact-form-7 id="'.$form.'" title="quote"]' ); ?>
					</div>
				</div>
			</div>
		</section>
		<?php endif; ?>

	</main>

<?php get_footer();
