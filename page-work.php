<?php
/*
Template Name: Work Template
*/
get_header();?>

	<main role="main">

		<section id="wrapper-home" class="text-center" style="background-image: url(<?php echo get_field('work_background_legend')['url']; ?>">
			<div class="overlay">

				<article id="wrapper-home-content" <?php post_class(); ?>>
					<h2><?php echo get_field( 'work_title_legend' ); ?></h2>
					<div class="lead"><?php echo get_field( 'work_text_legend' ); ?></div>
					<a href="#wrapper-works" class="fa fa-angle-down page-scroll"></a>
				</article>

			</div>
		</section>

		<!-- Team Section
		==========================================-->
		<?php
		$work_max_number_posts = get_field( 'work_max_number_posts' );

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$posts_per_page = $work_max_number_posts;
		$query_order = 'meta_value';
		$order = 'ASC';

		$work_args = array(
			'post_type'			=> 'work',
			'posts_per_page'	=> $posts_per_page,
			'paged'				=> $paged,
			'orderby'			=> $query_order,
			'order'				=> $order
		);

		$work_query = new WP_Query( $work_args ); ?>
		<?php if ( $work_query->have_posts() ) : ?>

		<section id="wrapper-works" class="text-center">
			<div class="container"> <!-- Container -->
				<div class="section-title">
					<h3><?php echo get_field( 'work_title_content' ); ?></h3>
					<hr class="big-line align-center">
					<hr class="small-line align-center">
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
					<?php while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
					<div class="col-sm-6 col-md-3 col-lg-3 <?php get_slug_categories_for_custom_post( $post->ID, 'work_category' ); ?>">
						<div class="portfolio-item">
							<div class="hover-bg">
								<a href="#modal-work-<?php the_ID(); ?>" title="Ver <?php the_title(); ?>">
									<div class="hover-text">
										<h5><?php the_title(); ?></h5>
										<small><?php get_name_categories_for_custom_post( $post->ID, 'work_category' ); ?></small>
										<div class="clearfix"></div>
										<i class="fa fa-plus"></i>
									</div>
									<img src="<?php the_thumb_url($post->ID); ?>" class="img-responsive" alt="<?php the_thumb_alt($post->ID); ?>">
								</a>
							</div>
						</div>
					</div>
					<div class="remodal full-width" data-remodal-id="modal-work-<?php the_ID(); ?>" role="dialog">
						<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
						<div class="container-fluid">
							<div class="col-md-4">
								<?php if ( $galleries = get_post_galleries_images( $post ) ): ?>
								<div id="workid-<?php the_ID(); ?>" class="owl-carousel owl-theme">
									<?php foreach ( $galleries as $gallery ): ?>
										<?php foreach ( $gallery as $src ): ?>
										<div class="item">
											<img src="<?php echo $src; ?>" alt="" />
										</div>
										<?php endforeach; ?>
									<?php endforeach; ?>
								</div>
								<?php else: ?>
									<img src="<?php the_thumb_url($post->ID); ?>" class="img-responsive" alt="<?php the_thumb_alt($post->ID); ?>">
								<?php endif; ?>
							</div>
							<div class="col-md-8 extended-content-modal">
								<h5><?php the_title(); ?></h5>
								<?php echo get_field( 'work_details' ); ?>
							</div>

							<script type="text/javascript">
								$(document).ready(function() {
									$("#workid-<?php the_ID(); ?>").owlCarousel({
										navigation : false, // Show next and prev buttons
						        slideSpeed : 300,
						        paginationSpeed : 400,
										touchDrag  : false,
										mouseDrag  : false,
						        singleItem: true
									});
								});
							</script>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</section>


		<?php endif; wp_reset_postdata(); ?>

	</main>

<?php get_footer();
