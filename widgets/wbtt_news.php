<?php
class Wbtt_News_Widget extends WP_Widget {

    /**
     * the constructor, where each new instance of your widget gets built
     */
	function __construct() {
		$widget_ops = array( 'classname' => 'news_widget', 'description' => __( "A list of latest news" ) );
		parent::__construct('news_widget', __('WBTT News'), $widget_ops);
	}
    
  /**
   * the most important function: this one handles actually outputting
   * the widget's content to the theme
   */
	function widget( $args, $instance ) {
		extract( $args );
        // French for Widget Title
        $myLocale = get_bloginfo('language'); // or use qtrans_getLanguage() OR qtrans_getLanguageName()

        if($myLocale == 'fr-FR')
          $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Nouvelles de l\'OEW' ) : $instance['title'], $instance, $this->id_base);
        else
            $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'WBTT News' ) : $instance['title'], $instance, $this->id_base);
    
		$news_to_list = !empty( $instance['news_to_list'] ) ? (int)$instance['news_to_list'] : 3;
		$news_char_count = !empty( $instance['news_char_count'] ) ? (int)$instance['news_char_count'] : 200;

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
        $query_args = array( 'numberposts' => $news_to_list, 'category' => 4 );
        $news_array = get_posts($query_args);
//        $news_count = count($news_array);
        wp_reset_query(); // ???????
?>
        <ul class="sf_newsList">
<?php   foreach ($news_array as $key => $news) { ?>
  <?php if ( ( ($myLocale == 'fr-FR') && (!stristr(get_the_title($news->ID),"(English)"))) || (($myLocale == 'en-US') && (!stristr(get_the_title($news->ID),"(French)"))) ) : // Does have content in this language? ?>
            <li<?php echo $news_to_list == $key+1 ? ' class="news-last"' : ''; ?>>
                <h2 class="sf_newsTitle">
                    <a href="<?php echo apply_filters('the_permalink', get_permalink($news->ID)); ?>"><?php echo get_the_title($news->ID); ?></a>
                    &nbsp;<span class="sf_newsDate"><?php echo date('m/d/Y',strtotime(apply_filters('the_date', $news->post_date))); ?></span>
                </h2>
<!--                <p class="sf_newsDate"><?php echo date('m/d/Y',strtotime(apply_filters('the_date', $news->post_date))); ?></p>-->
                <?php $excerpt = str_replace('<!--:fr-->','[:fr]',$news->post_excerpt);
                  $excerpt = str_replace('<!--:en-->','[:en]',$excerpt); ?>
                <p class="news_excerpt"><?php echo qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($excerpt); ?>&nbsp;
                    <span class="sf_readMore">
                        <a href="<?php echo apply_filters('the_permalink', get_permalink($news->ID)); ?>">
                            <?php echo $myLocale == 'en-US' ? 'Full story' : 'Pour connaître tous les details'; ?>
                        </a>
                    </span>
                </p>
            </li>
  <?php endif; // If has content in this language ?>
<?php   } ?>
        </ul>
<?php
        echo $after_widget;
	}

  /**
   * this handles the submission of the options form to
   * update the widget options
   */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['news_to_list'] = strip_tags($new_instance['news_to_list']);
		$instance['news_char_count'] = strip_tags($new_instance['news_char_count']);

		return $instance;
	}

  /**
   * this generates the widget options form - which you see
   * in the widgets section in the admin
   */
	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );

        $to_list = esc_attr( $instance['news_to_list'] );
        $chars = esc_attr( $instance['news_char_count'] );
?>
		<p><label for="<?php echo $this->get_field_id('news_to_list'); ?>"><?php _e( 'News articles to list <em><sup>Defaults to 3</sup></em> :' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('news_to_list'); ?>" name="<?php echo $this->get_field_name('news_to_list'); ?>" type="text" value="<?php echo $to_list; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('news_char_count'); ?>"><?php _e( 'Characters in the excerpt (words will be rounded up) <em><sup>Defaults to 200</sup></em> :' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('news_char_count'); ?>" name="<?php echo $this->get_field_name('news_char_count'); ?>" type="text" value="<?php echo $chars; ?>" /></p>
<?php
	}

    /**
     * Helper function - takes a string and a limit and returns the limited string
     * @param string $text The text to be excerpted
     * @param int $limit Char count
     * @return string The excerpt
     */
    function word_limiter($text, $limit) {
        // short enough?
        if( strlen($text) <= $limit) {
            return $text;
        }
        // check if last word is full
        if( substr($text, $limit, 1) == ' ') {
            return trim( substr($text, 0, $limit));
        }
        // hard cut
        $cut = substr($text, 0, $limit);
        // remove last word
        $words = explode(' ', $cut);
        array_pop($words);

        return implode(' ', $words);
    }

} // end class

register_widget('Wbtt_News_Widget');
