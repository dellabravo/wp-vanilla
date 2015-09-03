<?php
/**
 * The template for displaying archive pages
 *
 */

get_header(); ?>


	<div id="primary" class="full-width">
		<div id="content" role="main">	
			<div class="inner-content">
				<div class="page-header">
					<h1>The Latest</h1>
				</div>
	            <div id="masonry-grid"><div class="gutter-sizer"></div>
				<?php global $post;
					$recent = get_posts();
					$count = 0;
					foreach($recent as $post): setup_postdata($post); $count++; ?>
						<?php include('content-summary.php') ?>
					<?php endforeach; 
					wp_reset_postdata(); 

					echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="'.get_option('posts_per_page').'" offset="'.get_option('posts_per_page').'"]'); 
			?>
				</div>
			</div>
		</div><!-- End #content -->		

		<?php get_footer(); ?>

	</div><!-- End #primary -->
	    
</body>
</html>
