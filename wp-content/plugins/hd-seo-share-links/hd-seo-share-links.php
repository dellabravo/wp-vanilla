<?php
/**
 * Plugin Name: HD Made SEO Share Links
 * Version: 1.0.0
 * Description: Extension of Yoast SEO plugin to add social share links to posts
 * Author: Della Baines
 * Author URI: http://hdmade.com/
 * Text Domain: hd-seo-share-links
 */

if(class_exists('WPSEO_Meta')){
	
	function twitter_title(){
		$title = WPSEO_Meta::get_value( 'twitter-title', $post_id );
		if ( ! is_string( $title ) || '' === $title ) {
			return WPSEO_Frontend::get_instance()->title( '' );
		}
		else {
			return $title;
		}
	}

	function twitter_description( $post_id = 0 ) {
		$meta_desc = trim( WPSEO_Meta::get_value( 'twitter-description', $post_id ) );

		if ( is_string( $meta_desc ) && '' !== $meta_desc ) {
			return $meta_desc;
		}

		$meta_desc = trim( WPSEO_Frontend::get_instance()->metadesc( false ) );
		if ( is_string( $meta_desc ) && '' !== $meta_desc ) {
			return $meta_desc;
		}

		return strip_tags( get_the_excerpt() );
	}

	function fb_title( $post_id = 0){
		$title   = WPSEO_Meta::get_value( 'opengraph-title', $post_id );
		if($title)
			return $title;
		else return the_title();
	}

	function fb_description($post_id = 0){		
		$ogdesc  = WPSEO_Meta::get_value( 'opengraph-description', $post_id );
		if($ogdesc)
			return $ogdesc;
		else return strip_tags( get_the_excerpt() );
		
	}
}
