<!doctype html>

<html lang="en" id="ng-app" ng-app="MainApp">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo site_url(); ?>/wp-content/uploads/2015/08/FDfavicon.ico" />
  <title>FanDuel</title>  
 
  <?php wp_head(); ?>

   <!--[if lt IE 9]>
  
    <script type="text/javascript" src="<?php echo isDev ? getlibPath()."html5shiv/dist/html5shiv-printshiv.min.js" :  "//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js" ?>"></script>
    <script type="text/javascript" src="<?php echo isDev ? getlibPath()."respond/dest/respond.min.js" :  "//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" ?>"></script>
  
  <![endif]-->
</head>

<body id="js-main-body" <?php body_class(ht_body_classes()); ?>>
  <?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>

    <div id="header">
        <div id="topbar">
          <div class="container">
            <h1 class='logo pull-left'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>hungrytruth Insider</a></h1>
            <span class="sm-up pull-right v-align"><a class="play-now btn" target="_blank" href="https://www.fanduel.com/games" class="pull-right">Play Now</a></span>
            <a class="mobile-nav-btn ht-stack sm-down"><span>Menu</span></a>
          </div>
        </div>
        <!-- // topbar -->

        <div id="main-nav">
          <div class="main-nav-container">
            <!-- Mobile Search -->
            <div class="sm-down mobile">
                <?php get_search_form() ?>
                <a class="mobile-nav-btn sm-down close ss-icon">Close</a>
            </div>
            <nav>
              <div class="navigation pull-left">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'menu_id' => 'ht-mininav-expand', 'menu_class' => "ht-main-nav", 'walker' => new FanDuel_Mega_Walker() ) ); ?>          
              </div>
              <div class="secondary-nav">
                <div class="search pull-left">
                  <i class="ss-search search-btn"></i>
                  <div class="large-search">
                    <?php get_search_form() ?>
                  </div>
                </div>
                <?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'container' => false, 'menu_class' => 'social pull-left' ) ); ?>          
              </div>
              <!-- Mobile Social Menu -->
              <div class="sm-down">
                <p class="follow pull-left">Follow Us</p>
                <?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'container' => false, 'menu_class' => 'social pull-left' ) ); ?>          
              </div>
            </nav>
          </div>
        </div>
        <!-- // main-nav -->
    </div>
    <?php if($ft_article = get_field('article_alert', 5)[0]) :  ?>
    <div class="alert alert-info" role="alert">
      <div class="container">
        <i class="ss-icon">info</i> <?php the_field('article_alert_label', 5) ?> <a href="<?php echo get_permalink($ft_article->ID) ?>"><?php echo $ft_article->post_title ?></a>
        <div class="pull-right">
          <i class="ss-icon close">close</i>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div id="main">

