<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div id="primary" class="full-width">
		<div id="content" role="main">			
			<div class="article-content">
				<div class="article-inner">
						<section class="error-404 not-found text-center">
							<header class="page-header">
								<h1 class="page-title"><?php _e( 'Page not Found', 'fanduel' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content mt70 clearfix">
								<p><img src="<?php bloginfo('template_url') ?>/images/404-small.gif" alt="404" /></p>
								<p><a href="<?php echo home_url() ?>" class="more"><?php _e( 'Return to the homepage', 'fanduel' ); ?></a></p>
							</div><!-- .page-content -->
						</section><!-- .error-404 -->
					</div>														
				</div>
				</div><!-- End #content -->	
		<?php get_footer(); ?>

	</div><!-- End #primary -->

	    
</body>
</html>