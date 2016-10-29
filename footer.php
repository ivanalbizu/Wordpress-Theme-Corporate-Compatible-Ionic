
		<footer>
			<nav id="footer">
				<div class="container">
					<div class="pull-left fnav">
						<p>&copy; <?php echo date( 'Y' ); ?> Copyleft <?php bloginfo( 'name' ); ?>. Created by <a href="http://ivanalbizu.eu/">Ivan Albizu</a></p>
					</div>
					<div class="pull-right fnav">
						<?php the_social_menu( "social-menu", "footer-social" ); ?>
					</div>
				</div>
			</nav>
		</footer>

		<?php wp_footer(); ?>

		<?php the_analytics_script(); ?>

	</body>

</html>
