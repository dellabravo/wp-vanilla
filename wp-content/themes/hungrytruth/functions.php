<?php
/*
	hungrytruth Global Methods/Constants
	Author: HDMade
	9/4/2015
*/
/*
	Constants
*/
define ("themeRootUrl", get_stylesheet_directory_uri());
define ("themeRootAbsolutePath", get_template_directory());
define ("imgsUrl", themeRootUrl. "/img");
define ("cssUrl", get_stylesheet_uri());
define ("siteUrl", get_site_url());
define("themeRelativePath", "../".WP_CONTENT_FOLDERNAME."/themes/" . get_current_theme());
define('lib_path', themeRootUrl."/_dev/lib/");
if(strstr($_SERVER['HTTP_HOST'], 'test') || strstr($_SERVER['HTTP_HOST'], 'live'))
    define('isDev', false); // determines if to load dev/production css/js
else    
    define('isDev', true); // determines if to load dev/production css/js


function cssDev() {
	echo themeRootUrl."/style.css";
}

function cssMin() {
	echo themeRootUrl."/_build/ht.min.css";
}

function libPath() {
	echo themeRootUrl."_dev/lib/";
}

function getlibPath() {
	return themeRootUrl."/_dev/lib/";
}

function imgPath() {
	echo themeRootUrl."/img";
}
function siteUrl() {
	echo get_site_url();
}

// This theme uses wp_nav_menu() in one location.
function register_my_menus() {
	register_nav_menus( array(
		'main-menu' => 'Main Menu',		
		'social-menu' => 'Social Menu',		
		'footer-menu' => 'Footer Menu'
	));	
}
add_action('init', 'register_my_menus');

add_action('get_header', 'my_filter_head');

function my_filter_head() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

/* Disable the Admin Bar. */
// remove_action( 'init', 'wp_admin_bar_init' );


// load scripts depending on the environment
if(isDev)
  add_action('wp_enqueue_scripts', 'load_dev_scripts'); 
else {
    add_action('wp_enqueue_scripts', 'load_prod_scripts'); 
    add_action( 'wp_head', 'criticalCSS_wp_head' );
}
add_action('wp_enqueue_scripts', 'load_lib_scripts');


function load_dev_scripts() {
	wp_deregister_script('jquery');
    wp_deregister_script('underscore');

    wp_enqueue_script('underscore', lib_path.'underscore/underscore.js');
	wp_enqueue_script('jquery', lib_path.'jquery/dist/jquery.js');
    wp_enqueue_script('fastclick', lib_path.'fastclick/lib/fastclick.js');
    wp_enqueue_script('sticky-kit', lib_path.'sticky-kit/jquery.sticky-kit.js');
	wp_enqueue_script('custom_script', themeRootUrl.'/_dev/js-src/main.js', ['jquery']);
    wp_enqueue_style( 'ht', themeRootUrl."/style.css");
}
function load_prod_scripts() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js');    
	wp_enqueue_script('all', themeRootUrl.'/_build/ht.min.js', ['jquery']);
    wp_enqueue_style( 'ht', themeRootUrl."/_build/ht.min.css" );
}

function load_lib_scripts(){    
    
}

//Critical CSS
function criticalCSS_wp_head() {
    echo '<style>';
    include get_stylesheet_directory() . '/_dev/inc/critical.css.php';
    echo '</style>';
}


// add logo uploader for the theme.
function themeslug_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
        'title'       => __( 'Logo', 'themeslug' ),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );
    $wp_customize->add_setting( 'themeslug_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo',
) ) );
}
add_action('customize_register', 'themeslug_theme_customizer');

//additional body classes
function ht_body_classes(){
	global $post;
	if ( isset( $post ) ) {
		$classes .= $post->post_name;
	}	
	return $classes;
}

/**
* Define our image sizes
*
**/
update_option( 'thumbnail_size_w', 100 );
update_option( 'thumbnail_size_h', 100 );
add_image_size( 'hero', 940, 556, array( 'center', 'top' ) );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function ht_widgets_init() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
add_action( 'widgets_init', 'ht_widgets_init' );

add_theme_support( 'post-thumbnails' ); 


function custom_excerpt_more( $more ) {
	return '<a href="'.get_permalink().'">More</a>';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function get_related_tag_posts_ids( $post_id, $number = 5 ) {
 
        $related_ids = false;
 
        $post_ids = array();
        // get tag ids belonging to $post_id
        $tag_ids = wp_get_post_tags( $post_id, array( 'fields' => 'ids' ) );
        if ( $tag_ids ) {
                // get all posts that have the same tags
                $tag_posts = get_posts(
                        array(
                                'posts_per_page' => -1, // return all posts
                                'no_found_rows'  => true, // no need for pagination
                                'fields'         => 'ids', // only return ids
                                'post__not_in'   => array( $post_id ), // exclude $post_id from results
                                'tax_query'      => array(
                                        array(
                                                'taxonomy' => 'post_tag',
                                                'field'    => 'id',
                                                'terms'    => $tag_ids,
                                                'operator' => 'IN'
                                        )
                                )
                        )
                );
 
                // loop through posts with the same tags
                if ( $tag_posts ) {
                        $score = array();
                        $i = 0;
                        foreach ( $tag_posts as $tag_post ) {
                                // get tags for related post
                                $terms = wp_get_post_tags( $tag_post, array( 'fields' => 'ids' ) );
                                $total_score = 0;
 
                                foreach ( $terms as $term ) {
                                        if ( in_array( $term, $tag_ids ) ) {
                                                ++$total_score;
                                        }
                                }
 
                                if ( $total_score > 0 ) {
                                        $score[$i]['ID'] = $tag_post;
                                        // add number $i for sorting
                                        $score[$i]['score'] = array( $total_score, $i );
                                }
                                ++$i;
                        }
 
                        // sort the related posts from high score to low score
                        uasort( $score, 'sort_tag_score' );
                        // get sorted related post ids
                        $related_ids = wp_list_pluck( $score, 'ID' );
                        // limit ids
                        $related_ids = array_slice( $related_ids, 0, (int) $number );
                }
        }
        return $related_ids;
}
 
 
function sort_tag_score( $item1, $item2 ) {
        if ( $item1['score'][0] != $item2['score'][0] ) {
                return $item1['score'][0] < $item2['score'][0] ? 1 : -1;
        } else {
                return $item1['score'][1] < $item2['score'][1] ? -1 : 1; // ASC
        }
}

function ht_teaser($text, $word_limit=20){
    if (str_word_count($text, 0) > $word_limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);          
      $intro = substr($text, 0, $pos[$word_limit]) . ' <a href="javascript:void(0)">Show More</a>';
      $more = '<span class="more hidden">'.substr($text, $pos[$word_limit+1], strlen($text)).'</span>';
      $text = $intro . $more;
    }
    return $text;
}


function ht_latest_in_cat($cat_name){
    $cat_name = (string)$cat_name;
    $cat_id = get_category_by_slug($cat_name)->term_id;
    $args=array(
      'cat' => $cat_id,
      'post_status' => 'publish',
      'posts_per_page' => 4,
      );
    $cat_query = new WP_Query($args);
    if( $cat_query->have_posts() ) : $count = 0; $all_mobile='thumbnail'; $all_desktop='summary';  ?>
      <?php while ($cat_query->have_posts()) : $cat_query->the_post(); $count++; ?>
        <?php include 'content-summary.php'; ?>
      <?php endwhile; ?>
     <a class="more" href="<?php echo get_category_link($cat_id) ?>">More</a>
    <?php endif;  
    wp_reset_query();  // Restore global post data stomped by the_post().
}
    
// Move Yoast to bottom
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


function ht_get_media_type($post_id=null){
    if(has_term('podcast', 'media_type', $post_id))
        return 'podcast';
    else if(has_term('video', 'media_type', $post_id)) 
        return 'video';
}

function ht_get_media_icon_class($post_id=null){
    $type = ht_get_media_type($post_id);
    $icon_class = 'ss-list';
    switch($type){
        case 'podcast':
            $icon_class = 'ss-mic';
            break;
        case 'video' : 
            $icon_class = 'ss-play';
            break;
        default: 
            $icon_class = 'ss-list';
    }
    return $icon_class;
}

// 8 posts per page on author page
add_action( 'pre_get_posts', 'custom_get_posts' );
function custom_get_posts( $query ) {

  if( is_author() && $query->is_main_query() ) {    
    $query->query_vars['posts_per_page'] = 8;
  }

}

//remove featured from the_categories() display
function the_category_filter($thelist,$separator=' ') {
    if(!defined('WP_ADMIN')) {
        //Category IDs to exclude
        $exclude = array(199, 1011);

        $exclude2 = array();
        foreach($exclude as $c) {
            $exclude2[] = get_cat_name($c);
        }

        $cats = explode($separator,$thelist);
        $newlist = array();
        foreach($cats as $cat) {
            $catname = trim(strip_tags($cat));
            if(!in_array($catname,$exclude2))
                $newlist[] = $cat;
        }
        return implode($separator,$newlist);
    } else {
        return $thelist;
    }
}
add_filter('the_category','the_category_filter', 10, 2);

// Custom archive titles
add_filter( 'get_the_archive_title', 'ht_archive_title');

function ht_archive_title($title) {
    global $wp_query;
    if ( is_category() ) {
        $small_text = "Categorized In:";
        $category = $wp_query->get_queried_object();
        if($category->category_parent){
            $parent = get_category($category->category_parent);
            $parent_name = $parent->cat_name . ": ";
        }
        $title = $parent_name . single_cat_title( '', false );

    } elseif ( is_tag() ) {
        $small_text = "Tagged In:";
        $title = single_tag_title( '', false );

    }    
    $title = '<p class="small gray">'.$small_text.'</p><h1>'.$title.'</h1>';
    return $title;

}

//Wrap categorie count in a span
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}


//disable silly emoji scripts
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

/**
 * Load Enqueued Scripts in the Footer
 *
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 */
function footer_enqueue_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    //remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    //add_action('wp_footer', 'wp_enqueue_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
}
//add_action('after_setup_theme', 'footer_enqueue_scripts');

function ht_show_parent_category(){
    $categories = get_the_category();
     
    if ( !empty( $categories ) ) {
        foreach($categories as $c) 
            if($c->category_parent == 0)
                echo ' <a href="' . get_category_link($c->cat_ID) . '" title="' . $c->name . '">' . $c->name . '</a> ';
    }
}

// Get only the parent category associated with the post
function ht_parent_category_id($pid=false){
    $categories = get_the_category($pid);
    if ( !empty( $categories ) ) {
        foreach($categories as $c) 
            if($c->category_parent == 0)
                return $c->term_id;
    }
}

// Async load
function ht_async_scripts($url)
{
    if ( strpos( $url, '') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '', '', $url );
    else
    return str_replace( '', '', $url )."' defer='defer"; 
    }
//add_filter( 'clean_url', 'ht_async_scripts', 11, 1 );
