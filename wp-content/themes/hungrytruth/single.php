<?php
/**
* Template Name: hungrytruth Page
*/
?>

<?php get_header(); ?>
	<div id="primary">
		<div id="content" role="main">			
			<div class="article-content">
				<div class="article-inner">
					<div class="social_toolbar"><?php get_template_part('content', 'share') ?></div>

					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?> 
						<div class="bg-white">
							<div class="upper-content">
								<span class="category"><?php ht_show_parent_category(); ?></span>
								<h1><?php the_title() ?></h1>
								<?php get_template_part('content', 'meta') ?>
							</div>
							<?php get_template_part('content', 'hero') ?>
							
							<div class="content-container">
								<?php the_content() ?>
								<span class="tags"><?php the_tags('<span>Tagged in</span>', ' ') ?></span>
							</div>
						</div>
						<?php endwhile; ?>
					<?php endif; ?>					
				</div>
			</div>

			<div class="featured_event">
				<?php get_template_part('content', 'featured_event'); ?>
			</div>

					<!-- Mobile Events -->
					<div class="mobile">
						<div class="trending panel">
							<h3>THE BENCH</h3>
							<?php get_template_part('content', 'trending'); ?>
						</div>
					</div>
					<!-- // -->

			
			<?php get_template_part('content', 'similar') ?>

		</div><!-- End #content -->

		<div class="sidebar">
			<?php get_template_part('content', 'sidebar'); ?>
		</div>	

		<?php get_footer(); ?>

	</div><!-- End #primary -->

	    
</body>
</html>