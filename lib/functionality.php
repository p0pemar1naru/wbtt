<?php
/**
 * ========================= Head mods =========================
 */
/**
 * Adds favicon into head
 */
function wbtt_favicon() { ?>
    <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/favicon.ico" />
<?php }

/**
 * ========================= Header mods =========================
 */
/**
 * Removes from div#header - blogtitle, blogdescription
 */
function wbtt_clean_div_header() {
    remove_action('thematic_header','thematic_blogtitle',3);
    remove_action('thematic_header','thematic_blogdescription',5);
}
/**
 * Adds the top header slice on top of the div#header
 */
function wbtt_add_top_header_image() { ?>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/images/toprounded.png" alt="" id="top-header-slice" width="959" height="12" />
<?php }
/**
 * Overrides div#branding before the closing div
 * Adds logos and qtranslate language selector
 */
function childtheme_override_brandingclose() { ?>
    <div class="langSelect"><?php echo qtrans_generateLanguageSelectCode('dropdown'); ?></div>
    <?php
        $myLocale = get_bloginfo('language'); // or use qtrans_getLanguage() OR qtrans_getLanguageName()
        if($myLocale == 'fr-FR') { ?>
            <h1 id="wbttlogo"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/wbttlogo_fr.png" alt="Outil denseignement web" width="374" height="82" /></h1>
            <h2 id="medsens"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/medsensitivity-fre.png" alt="" width="163" height="33" /></h2>
    <?php } else { ?>
            <h1 id="wbttlogo"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/wbttlogo.png" alt="The Web Based Teaching Tool" width="336" height="82" /></h1>
            <h2 id="medsens"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/medsensitivity-eng.png" alt="" width="163" height="28" /></h2>
    <?php } ?>
    </div><!--  #branding -->
<?php }


/**
 * ========================= News =========================
 */
function wbtt_add_news_widget_area() {
?>
    <div id="wbtt-news" class="hentry">
        <div class="entry-content">
            <ul class="momo">
                <?php dynamic_sidebar('News'); ?>
            </ul>
        </div>
    </div>
<?php }

/**
 * ========================= Testimonials =========================
 */
function wbtt_add_testimonials_widget_area() {
?>
    <div id="social" class="aside main-aside">
        <ul class="momo socialize"><?php dynamic_sidebar('Social'); ?></ul>
    </div>
    <div id="wbtttestimonials" class="aside main-aside">
        <ul class="momo"><?php dynamic_sidebar('Testimonials'); ?></ul>
    </div>
<?php }


/**
 * ========================= Aside mods =========================
 */
/**
 * Adds tertiary sidebar in between the Thematic Primary Aside and Secondary Aside
 * Used for Tip Sheets
 */
function wbtt_add_tertiary_aside() { 
?>
    <div id="tertiary" class="aside main-aside" style="margin-top:25px;">
        <ul class="xoxo">
            <?php dynamic_sidebar('Tertiary Aside'); ?>
        </ul>
    </div>
<?php }

function wbtt_add_tertiary_asidetwo() {
  $myLocale = get_bloginfo('language');
  if ($myLocale == 'fr-FR')
      $polls_text = 'Sondage';
  else
      $polls_text = 'Polls';
?>
    <div id="polls-aside" class="aside main-aside">
        <ul class="xoxo">
        <li class="widgetcontainer widget_text" id="text-2"><h3 id="polls" class="widgettitle"><?php echo $polls_text; ?></h3></li>
            <?php dynamic_sidebar('Polls Aside'); ?>
        </ul>
    </div>
<?php }


/**
 * ========================= Footer mods =========================
 */
/**
 * Adds the bottom footer slice before the div#siteinfo
 */
function childtheme_override_siteinfoopen() { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/botrounded.png" alt="" id="btm-footer-slice" width="959" height="13" /><div id="siteinfo"><?php }


/**
 * ========================= Comments =========================
 */
/**
 * Removes empty div#comments left by WP when comments are disabled in backend
 */
function wbtt_remove_comments() {
    remove_action('thematic_comments_template','thematic_include_comments',5);
}
