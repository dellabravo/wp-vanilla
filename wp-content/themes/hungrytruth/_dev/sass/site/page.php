<?php
/**
* Template Name: fanduel Page
*/
?>

<?php get_header(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( $content_size_class ); ?> <?php echo esc_attr( $content_class ); ?>">
		<div id="content" class="<?php echo esc_attr( $layout_class ); ?>" role="main">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>


				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</div><!-- End #content -->


	</div><!-- End #primary -->


	
	<?php get_footer(); ?>
	    
</body>
</html>