<footer class="fd-footer">
	<div class="inner-content">
		<div class="fd-footer-top">
			<div class="pull-left">
				<h2 class='logo pull-left'><a target="blank" href="http://fanduel.com" title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='FanDuel'>FanDuel</a></h2>
				<span class="tagline">The Leader in One-Day Fantasy Sports <a class="playnow ml" href="https://www.fanduel.com/games">Play Now</a></span>
			</div>

			<div class="desktop pull-right">
				<nav class="social">					
					<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'container' => false, 'menu_id' => 'fdl-socialnav', 'menu_class' => "ss-icon ss-social-regular" ) ); ?>          
				</nav>
			</div>
		</div>

		<div class="fd-footer-bottom">
			<div class="pull-left">
				<p>
					FanDuel is not affiliated with or sponsored by the National Football League, the National Hockey League or Major League Baseball
				</p>
			</div>
			<div class="last pull-right">
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => false, 'menu_id' => 'fdl-footernav' ) ); ?>          
				<p>&copy; <?php echo date('Y'); ?>. All Rights Reserved</p>
			</div>
		</div>
	</div>
</footer>


<?php wp_footer() ?>

<div class="mobile mobile-footer">
	<div class="pull-left">
		<a class="play-now btn square" target="blank" href="https://www.fanduel.com/games" alt="Play">Play Now</a>
	</div>
	<?php if(is_single()) : ?>
		<?php include('content-share.php') ?>
	<?php else : ?>	
	<div class="social pull-right">
		<span> Follow us: </span>
		<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'container' => false, 'menu_id' => 'fdl-socialnav', 'menu_class' => "ss-icon ss-social-regular" ) ); ?>          
	</div>
	<?php endif; ?>
</div>

<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
_fbq.push(['addPixelId', '317146971777296']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=317146971777296&amp;ev=PixelInitialized" /></noscript>
<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
<script type="text/javascript">
if (typeof twttr !== 'undefined') {
twttr.conversion.trackPid('l4pv3');
}
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l4pv3&p_id=Twitter" />
<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l4pv3&p_id=Twitter" />
</noscript>
</body>
</html>