<?php

require_once('lib/utilities.php');
require_once('lib/functionality.php');

/**
 * ========================= <head> mods =========================
 */
add_action('wp_head', 'wbtt_favicon');
if (!is_admin()) {
    remove_action('wp_head', 'rsd_link'); // kill the RSD link
//    remove_action('wp_head', 'wp_generator'); // kill the wordpress version number for security reasons
    remove_action('wp_head', 'wlwmanifest_link'); // kill the WLW link
    remove_action('wp_head', 'index_rel_link'); // kill the index link
    remove_action('wp_head', 'parent_post_rel_link_wp_head', 10, 0); // kill the prev link
    remove_action('wp_head', 'start_post_rel_link_wp_head', 10, 0); // kill the start link
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // kill adjacent post links
    remove_action('wp_head', 'feed_links', 2); // kill post and comment feeds
    remove_action('wp_head', 'feed_links_extra', 3); // kill category, author, and other extra feeds
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
}


/**
 * ========================= Header mods =========================
 */
add_action('init', 'wbtt_clean_div_header');
add_action('thematic_aboveheader', 'wbtt_add_top_header_image');
add_action('thematic_header','childtheme_override_brandingclose',7);


/**
 * ========================= News =========================
 */
function wbtt_do_news() {
    if( is_home() || is_front_page() ) {
        add_action('thematic_belowpost', 'wbtt_add_news_widget_area');
    }
}
add_action('template_redirect','wbtt_do_news');
add_filter('thematic_postheader_postmeta', '__return_false'); // Remove post meta

/**
 * ========================= Testimonials =========================
 */
add_action('thematic_belowmainasides', 'wbtt_add_testimonials_widget_area');


/**
 * ========================= Aside =========================
 */
add_action('thematic_betweenmainasides', 'wbtt_add_tertiary_aside');
add_action('thematic_betweenmainasides', 'wbtt_add_tertiary_asidetwo');


/**
 * ========================= Footer mods =========================
 */
add_action('thematic_footer', 'childtheme_override_siteinfoopen', 20);


/**
 * ========================= Comments =========================
 */
add_action('init','wbtt_remove_comments');
add_action('init','my_language_two');
add_action('themeatic_aboveheader','my_language_two');

add_action('thematic_abovefooter','my_language');

function my_language() {
  global $q_config;
  if ( (strstr($_SERVER['HTTP_HOST'],'oewdepistage')) ) {
    $q_config['language'] = "fr";
  echo '<script>';
   echo "jQuery('#wrapper a').each(function() { jQuery(this).attr('href', jQuery(this).attr('href').replace('www.','')); jQuery(this).attr('href', jQuery(this).attr('href').replace('wbtt.ca','www.oewdepistage.ca')); jQuery(this).attr('href', jQuery(this).attr('href').replace('/fr','')); jQuery(this).attr('href', jQuery(this).attr('href').replace('oewdepistage.ca','www.oewdepistage.ca')); jQuery(this).attr('href', jQuery(this).attr('href').replace('www.www.','www.')); });";
  echo '</script>';
  }
}
function my_language_two() {
  global $q_config;
  if ( (strstr($_SERVER['HTTP_HOST'],'oewdepistage')) ) {
    $q_config['language'] = "fr";
  }

}
add_action('thematic_belowfooter','my_language');


/**
 * ========================= Miscellaneous =========================
 */
add_filter('thematic_postfooter', '__return_false'); // Remove postfooter

add_filter('thematic_postheader_posttitle','__return_false');

add_filter('default_hidden_meta_boxes', 'be_hidden_meta_boxes', 10, 2);
function be_hidden_meta_boxes($hidden, $screen) {
    if ( 'post' == $screen->base || 'page' == $screen->base )
       $hidden = array('slugdiv', 'trackbacksdiv', 'postexcerpt', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
       // removed 'postcustom',
       return $hidden;
}
    
?>
