<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="full-width">
		<div id="content" role="main">	
		<div class="inner-content">
		<header class="page-header">
			<p class="small">Search Results for:
			<h1 class="page-title"><?php echo get_search_query(); ?></h1>
		</header><!-- .page-header -->

		<?php if ( have_posts() ) : ?>		
            <div id="masonry-grid"><div class="gutter-sizer"></div>			
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>				
				<?php get_template_part( 'content', 'summary' );
			// End the loop.
			endwhile;
			
			echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="'.get_option('posts_per_page').'" offset='.get_option('posts_per_page').' search="'.get_search_query().'" max_pages=0]');  ?>
			</div>

		<?php // If no content, include the "No posts found" template.
		else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif;
		?>
		</div>
		</div><!-- End #content -->
		

		<?php get_footer(); ?>

	</div><!-- End #primary -->


	

	

	    
</body>
</html>
