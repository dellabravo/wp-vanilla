<?php get_header(); ?>

	<div id="primary">
		<div id="content" role="main">	
			<?php get_template_part( 'content', 'hero' ); ?>

			<div class="inner-content">
				<div class="col-sm-9">
					<h1><?php the_title() ?></h1>
					<?php the_content(); ?>
				</div>
					
		</div><!-- End #content -->

		<div class="sidebar">
			<?php get_template_part('content', 'sidebar'); ?>
		</div>	

		<?php get_footer(); ?>

	</div><!-- End #primary -->

	    
</body>
</html>