<?php
/* = WBTT new widgetized areas
-------------------------------------------------------------- */
function wbtt_widgets_init() {
    if ( function_exists('register_sidebars') ) {
        add_filter( 'thematic_widgetized_areas', 'wbtt_sort_all_widgetized_areas' );
    }
}
add_action( 'widgets_init', 'wbtt_widgets_init' );

/**
 *  declare new aside/widgetized areas
 */
$wbtt_widgetized_areas = array(
    'Social' => array(
        'admin_menu_order' => 145,
        'args' => array (
            'name' => 'Social Area',
            'id' => 'social',
            'description' => __('The Socials widget area, showed at the bottom of the right sidebar.', 'thematic'),
            'before_widget' => wbtt_before_widget(),
            'after_widget' => wbtt_after_widget(),
            'before_title' => wbtt_before_title(),
            'after_title' => wbtt_after_title(),
            ),
        'action_hook'	=> 'widget_area_social',
        'function'		=> 'wbtt_social',
        'priority'		=> 10
    ),
    'Testimonials' => array(
        'admin_menu_order' => 150,
        'args' => array (
            'name' => 'Testimonials Area',
            'id' => 'testimonials',
            'description' => __('The Testimonials widget area, showed at the bottom of the right sidebar.', 'thematic'),
            'before_widget' => wbtt_before_widget(),
            'after_widget' => wbtt_after_widget(),
            'before_title' => wbtt_before_title(),
            'after_title' => wbtt_after_title(),
            ),
        'action_hook'	=> 'widget_area_testimonials',
        'function'		=> 'wbtt_testimonials',
        'priority'		=> 10
    ),
    'Polls Aside' => array(
        'admin_menu_order' => 140,
        'args' => array (
            'name' => 'Polls Aside',
            'id' => 'tertiary-asidetwo',
            'description' => __('The Polls widget area, showed on the right sidebar.', 'thematic'),
            'before_widget' => wbtt_before_widget(),
            'after_widget' => wbtt_after_widget(),
            'before_title' => wbtt_before_title(),
            'after_title' => wbtt_after_title(),
            ),
        'action_hook'	=> 'widget_area_tertiary_asidetwo',
        'function'		=> 'wbtt_tertiary_asidetwo',
        'priority'		=> 10
    ),
    'Tertiary Aside' => array(
        'admin_menu_order' => 130,
        'args' => array (
            'name' => 'Tip Sheets Area',
            'id' => 'tertiary-aside',
            'description' => __('The Tip Sheet widget area, showed on the right sidebar.', 'thematic'),
            'before_widget' => wbtt_before_widget(),
            'after_widget' => wbtt_after_widget(),
            'before_title' => wbtt_before_title(),
            'after_title' => wbtt_after_title(),
            ),
        'action_hook'	=> 'widget_area_tertiary_aside',
        'function'		=> 'wbtt_tertiary_aside',
        'priority'		=> 10
    ),
    'News' => array(
        'admin_menu_order' => 160,
        'args' => array (
            'name' => 'News Area',
            'id' => 'news',
            'description' => __('The News widget area, showed bellow content', 'thematic'),
            'before_widget' => wbtt_before_widget(),
            'after_widget' => wbtt_after_widget(),
            'before_title' => wbtt_before_title(),
            'after_title' => wbtt_after_title(),
            ),
        'action_hook'	=> 'widget_area_news',
        'function'		=> 'wbtt_news',
        'priority'		=> 10
    )
);
        
/**
 * Builds a new array of widgetized areas from the existing Thematic areas and the new Theme specific areas.
 * Sort by "admin_menu_order", the areas, to be displayed in back-end
 * 
 * @TODO change Primary Aside name
 * @TODO change Primary Aside description
 * 
 * @global array $wbtt_widgetized_areas The new WBTT widgetized areas
 * @param array $content Thematic predefined array for the widgetized areas
 * @return array New widgetized areas
 */
function wbtt_sort_all_widgetized_areas($content) {
    global $wbtt_widgetized_areas;
    
    $widgetized_areas = array_merge($wbtt_widgetized_areas, $content);
    $widgetized_areas['Primary Aside']['args']['name'] = 'Login Area';
    $widgetized_areas['Primary Aside']['args']['description'] = __('WBTT Login widget area, showed at the top of the right sidebar.');
	asort($widgetized_areas);
    
//    echo '<pre>';
//    print_r($widgetized_areas);
//    die("\nYOUNG");
    
	return $widgetized_areas;
}

// CSS markup before the widget
function wbtt_before_widget() {
	$content = '<li id="%1$s" class="widgetcontainer %2$s">';
	return apply_filters('wbtt_before_widget', $content);
}

// CSS markup after the widget
function wbtt_after_widget() {
	$content = '</li>';
	return apply_filters('wbtt_after_widget', $content);
}

// CSS markup before the widget title
function wbtt_before_title() {
	$content = "<h3 class=\"widgettitle\">";
	return apply_filters('wbtt_before_title', $content);
}

// CSS markup after the widget title
function wbtt_after_title() {
	$content = "</h3>\n";
	return apply_filters('wbtt_after_title', $content);
}
