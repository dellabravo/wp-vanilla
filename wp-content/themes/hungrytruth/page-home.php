<?php
/**
* Template Name: Home
*/
?>

<?php get_header(); ?>	
	<div id="primary" class="content-area row <?php if(get_field('enable_the_weekend_guide')){ echo "page-weekend"; }?>">
		<div id="content" role="main">
			<?php if(get_field('enable_the_weekend_guide')) : include 'weekend-guide.php'; 
			else :
				include( 'content-hero.php' ); ?>				

				<!-- News Stream -->
				<div class="news-stream inner-content">
					<div class="latest">
						<?php include('content-latest.php'); ?>

						<!-- Mobile Events -->
						<div class="mobile">
							<div class="ad">
								<?php include('content-featured_event.php'); ?>
							</div>

							<?php include('content-featured_events.php'); ?>

						</div>					

						<!-- // -->

						<!-- Fantasy -->
						<div class="fantasy-feed">
							<div class="fantasy-item">
								<h2>Rookie</h2>
								<?php fd_latest_in_cat('rookie'); ?>			
							</div>
							<div class="fantasy-item">
								<h2>Starter</h2>
								<?php fd_latest_in_cat('starter'); ?>
							</div>
							<div class="fantasy-item">
								<h2>Legend</h2>
								<?php fd_latest_in_cat('legend'); ?>
							</div>
						</div>

						<!-- // -->	

						<div class="sm-down">
							<div class="events panel">
								<?php include('content-featured_events.php'); ?>
							</div>
							<div class="trending panel">
								<h3>The Bench</h3>
								<?php include('content-trending.php'); ?>
							</div>
						</div>

					</div>
				</div><!--// #news-stream  -->
			<?php endif; ?>

		</div><!-- // #content -->
			<!-- Sidebar -->
	<div class="sidebar">
		<?php include('content-sidebar.php'); ?>
	</div>
	<!-- // Sidebar -->

		<?php get_footer(); ?>

	</div><!-- // #primary -->
	


	    
</body>
</html>