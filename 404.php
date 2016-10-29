<?php get_header(); ?>

<?php global $theme_name; ?>

	<main role="main" class="col-md-12">

		<section id="error-wrapper-page" class="text-center">

				<div class="overlay">

					<article id="error-page">
						<h2><?php _e( 'Page not found', $theme_name ); ?></h2>
						<hr class="big-line align-center">
						<hr class="small-line align-center">
						<p><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', $theme_name ); ?></a></p>
					</article>

				</div>

		</section>


	</main>
<style>
	nav#wrapper-menu {
		background-color: #222222 !important;
	}
</style>
<?php get_footer();
