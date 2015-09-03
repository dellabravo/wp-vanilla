<?php get_header(); ?>


	<div id="primary" class="content-area row full-width">
		<div id="content" role="main">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>


				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
		</div><!-- End #content -->

	</div><!-- End #primary -->
	
	</div><!-- /#main -->

	<?php get_footer(); ?>
	    
</body>
</html>