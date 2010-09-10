<?php

// Session starten, falls es noch nicht passiert ist.
session_start();

define("ENABLE_JQUERY",             TRUE);
define("ENABLE_FORMVALIDATION",     TRUE && ENABLE_JQUERY);
define("ENABLE_FANCYBOX",           TRUE && ENABLE_JQUERY);
define("ENABLE_IMAGE_SCALING",      FALSE && ENABLE_JQUERY);
define("ENABLE_SMOOTH_SCROLL",      TRUE && ENABLE_JQUERY);

// Kategorie-Fun
define('BLOG_CATEGORY', 1);
define('PHOTO_CATEGORY', 8);
define('DEV_CATEGORY', 21);
define('DEFAULT_CATEGORY', 0);

// MIME abrocken
if($_SERVER["SERVER_ADDR"] != "127.0.0.1") PerformAwesomeMimeFoo();

// dwoo laden
include(TEMPLATEPATH.'/dwoo/dwooAutoload.php');
$dwoo = new Dwoo();
$dwooLoader = $dwoo->getLoader();
$dwooLoader->addDirectory(TEMPLATEPATH.'/tpl_plugs');
$dwooParams = array();

// Standardparameter setzen
$dwooParams['user_logged_in']   = is_user_logged_in();
$dwooParams['user_identity']    = $user_identity;

// Dwoo-Templatepfad registrieren
define('TPL_PATH', TEMPLATEPATH.'/tpl');

// Allgemeine Funktionen

// Korrekten MIME-Typen senden, wenn der Browser ihn unterstützt
function PerformAwesomeMimeFoo()
{
  $mimeType = ( stristr( $_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml' ) && !preg_match("/application\/xhtml\+xml;\s*q=0(\.0)?\s*(,|$)/", $_SERVER['HTTP_ACCEPT']) ) ? 'application/xhtml+xml' : 'text/html';
  header("Content-type: $mimeType; charset=UTF-8") ;
}

// Liefert den Link zur Kommentarseite
function reboot_get_the_title()
{
  ob_start();
  the_title();
  return ob_get_clean();
}

// Kommentare

// Liefert den Link zur Kommentarseite
function reboot_comments_link()
{
  global $post;
  $class = "comment";
  if(!$post->comment_count) $class .= " lonely";

  ob_start();
  comments_popup_link(__("0 Kommentare", "reboot"), __("1 Kommentar", "reboot"), __("% Kommentare", "reboot"), $class, __("deaktiviert", "reboot"));
  return ob_get_clean();
}

// Liefert die Anzahl der Kommentare als Text
function reboot_comments_count_text()
{
  ob_start();
  comments_number(__("0 Kommentare", "reboot"), __("1 Kommentar", "reboot"), __("% Kommentare", "reboot"));
  return ob_get_clean();
}

// Liefert den Reply-Titel
function reboot_comments_form_title()
{
  ob_start();
  comment_form_title( __('Hinterlasse einen Kommentar', 'reboot'), __('Antworte auf %s', 'reboot') );
  return ob_get_clean();
}

function reboot_add_pingback()
{
    if(!is_single()) return;
?>
<link rel="trackback" href="<?php trackback_url() ?>" title="Trackback-URL für '<?php the_title(); ?>'" />
<?php
}

add_action('wp_head', 'reboot_add_pingback');

// threaded comments! Woo!
if(!function_exists('theme_queue_js'))
{
    function theme_queue_js(){
      if (!is_admin()){
        if (is_single() && comments_open() && (get_option('thread_comments') == 1)) {
          wp_enqueue_script( 'comment-reply' );
        }
      }
    }
    add_action('get_header', 'theme_queue_js');
}

// Filt0rt den content und gettet ihn
function reboot_get_the_content($more_link_text = null, $stripteaser = 0)
{
  global $post;

  ob_start();
  the_content($more_link_text, $stripteaser);
  return ob_get_clean();
}

// Kategorie überprüfen

// Ermittelt, ob der aktuelle Post zu einer Text-Kategorie gehört
function is_text_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "allgemein") return TRUE;
    if($category->slug == "general") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Foto-Kategorie gehört
function is_photo_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "pictures") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Foto-Kategorie gehört
function is_photoset_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "pictures") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Video-Kategorie gehört
function is_video_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "videos") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Link-Kategorie gehört
function is_link_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "links") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Audio-Kategorie gehört
function is_audio_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "audio") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Chatlog-Kategorie gehört
function is_chat_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "chats") return TRUE;
    if($category->slug == "conversations") return TRUE;
  }
  return FALSE;
}

// Ermittelt, ob der aktuelle Post zu einer Zitat-Kategorie gehört
function is_quote_post()
{
  foreach((get_the_category()) as $category) {
    if($category->slug == "quote") return TRUE;
  }
  return FALSE;
}

// jQuery fun

/**
 * Dieses Stück Awesomeness klaut Wordpress das eigene jQuery-Skript unter dem
 * Arsche hinfort und ersetzt es gegen sein eigenes. Unseres, quasi.
 */
function reboot_inject_jquery()
{   
    if(is_admin()) return;
    
    $version = "-1.4.2";
    if($_SERVER["SERVER_ADDR"] != "127.0.0.1") $version .= "_min";
    $script = get_bloginfo("stylesheet_directory").'/js/jquery'.$version.'.js';
    
    wp_deregister_script('jquery');
    wp_register_script('jquery', $script);
    wp_enqueue_script('jquery');    
}

if(ENABLE_JQUERY) add_action('init', 'reboot_inject_jquery');

function reboot_inject_jquery_image_foo()
{
    // Version 0.
    // Verwendet $(document).ready, um auf das Erzeugen des DOM zu warten.
    // Wandert dann durch alle Bilder und löscht deren width und height-Attribute (removeAttr)
    // An sich okay, aber warum die Bilder nicht gleich skalieren, wenn wir eh dabei sind?

    /*
?>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("li.post .entry-content img[class*='wp-image-']").each(function() {
            $(this).removeAttr("width").removeAttr("height");
        });
    });
</script>
<?php
    */

    // Version 1.
    // verwendet $(window).load, um sicherzustellen, dass die Bilder geladen sind.
    // Wandert dann, durch alle Bilder und skaliert sie.
    // Problem: Wird erst durchgeführt, wenn ALLE Bilder geladen sind. Das kann
    // zu unschönen Effekten führen, wenn der Vorgang ein bissel dauert.

    /*
?>
<script type="text/javascript" language="javascript">
    $(window).load(function() {
        $("li.post .entry-content img[class*='wp-image-']").each(function() {
           var setWidth = $(this).width();
           var actualWidth = $(this).attr("naturalWidth");
           var actualHeight = $(this).attr("naturalHeight");
           var setHeight = Math.round(actualHeight * setWidth / actualWidth);
           $(this).attr("height", setHeight).attr("width", setWidth);
        });
    });
</script>
<?php
    */

    // Version 9000.
    // Verwendet $(document).ready, um auf das Erzeugen des DOM zu warten.
    // Wandert dann durch alle Bilder und ruft die scale-Funktion auf.
    // Diese testet, ob das Bild bereits abgearbeitet wurde und verlässt ggf. die Routine.
    // Als nächstes wird geprüft, ob das Bild vollständig geladen ist (etwa,
    // weil es aus dem Cache kommt).
    //
    // Ist dies nicht der Fall, werden die Größenattribute entfernt, um eine
    // falsche Darstellung zu verhindern. Danach wird die Funktion an das Load-Ereignis gebunden.
    //
    // Ist das Bild vollständig geladen (ggf., weil nun das Load-Ereignis
    // aufgerufen wurde) wird nun die eigentliche Skalierung durchgeführt,
    // und das Bild als abgearbeitet markiert.

    // Vorteil: Die Bilder werden skaliert, sobald sie fertig sind - unabhängig voneinander.
    // Bilder, die aus dem Cache kommen, werden ebenfalls abgezwackt.

?>
<script type="text/javascript" language="javascript">
<!--
    scale = function() {
        if($(this).attr("handled")) return;
        if(!$(this).attr("complete")) {
            $(this).bind('load', scale).removeAttr("height");
            return;
        }

        var setWidth = $(this).width();
        var actualWidth = $(this).attr("naturalWidth");
        var actualHeight = $(this).attr("naturalHeight");
        var setHeight = Math.round(actualHeight * setWidth / actualWidth);

        jQuery(this).attr("height", setHeight).attr("width", setWidth).attr("handled", true);
    }

    jQuery(document).ready(function($){
        $("li.post .entry-content img[class*='wp-image-']").each(scale);
    });
-->
</script>
<?php
}

if(ENABLE_IMAGE_SCALING) add_action( 'wp_head', 'reboot_inject_jquery_image_foo', 1001 );

function reboot_inject_fancybox()
{
?>
<script type="text/javascript" language="javascript" src="<?php bloginfo("stylesheet_directory")?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" language="javascript" src="<?php bloginfo("stylesheet_directory")?>/js/fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory")?>/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen">
<?php
}

if(ENABLE_FANCYBOX) add_action( 'wp_footer', 'reboot_inject_fancybox', 1002 );

function reboot_inject_facybox_foo()
{
    // Ermittelt alle Bilder im Post, die von einem Link umgeben sind,
    // kopiert den Titel des Bildes auf den Eltern-Link und versieht diesen
    // dann mit der fancybox.
?>
<script type="text/javascript" language="javascript">
<!--
    jQuery(document).ready(function($){
        $("li.post .entry-content a img[class*='wp-image-']").each(function() {
           var parent = $(this).parent();
           if(!parent.attr("title")) parent.attr("title", $(this).attr("title"));
           parent.fancybox();
        });
    });
-->
</script>
<?php
}

if(ENABLE_FANCYBOX) add_action( 'wp_head', 'reboot_inject_facybox_foo', 1003 );

function reboot_smooth_scrolling_foo()
{
?>
<script type="text/javascript" language="javascript">
<!--
jQuery(document).ready(function($){
    $('a[href*=#]').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body').animate({scrollTop: targetOffset}, 1000);
                return false;
            }
        }
    });
});
-->
</script>
<?php
}

if(ENABLE_SMOOTH_SCROLL) add_action( 'wp_head', 'reboot_smooth_scrolling_foo', 1004 );

/**
 * Krasse Kommentarvalidierungs-Action
 */
function reboot_inject_form_validation()
{
    if(!is_single() || !comments_open()) return;
    
    $version = '';
    if($_SERVER["SERVER_ADDR"] != "127.0.0.1") $version .= ".pack";
?>
<script type="text/javascript" language="javascript" src="<?php bloginfo("stylesheet_directory")?>/js/jquery-validate/jquery.validate<?php echo $version ?>.js"></script>
<script type="text/javascript">
<!--
  jQuery(document).ready(function($){
    $("#commentform").validate({
            rules: { comment: "required", author: "required", email: { required: true, email: true }, url: { required: false, url: true } },
            errorClass: "invalid", validClass: "valid", errorPlacement: function(error, element) {}
        });
  });
-->
</script>
<?php
}

// Krasse Kommentarvalidierungs-Action einbinden - or not!
if (ENABLE_FORMVALIDATION) add_action( 'wp_footer', 'reboot_inject_form_validation', 2000 );


if(!function_exists('post_is_in_descendant_category'))
{
    /**
     * Tests if any of a post's assigned categories are descendants of target categories
     *
     * @param int|array $cats The target categories. Integer ID or array of integer IDs
     * @param int|object $_post The post. Omit to test the current post in the Loop or main query
     * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
     * @see get_term_by() You can get a category by name or slug, then pass ID to this function
     * @uses get_term_children() Passes $cats
     * @uses in_category() Passes $_post (can be empty)
     * @version 2.7
     * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
     */
    function post_is_in_descendant_category( $cats, $_post = null )
    {
    	foreach ( (array) $cats as $cat ) {
    		// get_term_children() accepts integer ID only
    		$descendants = get_term_children( (int) $cat, 'category');
    		if ( $descendants && in_category( $descendants, $_post ) )
    			return true;
    	}
    	return false;
    }
}

/**
 * Überprüft, ob ein Seitenaufruf oder ein Post in einer stereotypen Kategorie ist
 * und gibt diese zurück. Im Erfolgsfall wird zusätzlich das define DETECTED_CATEGORY
 * gesetzt.
 *
 * @global object $wp_the_query Die WP-Query
 * @global object $post Das Post-Objekt, falls gesetzt
 * @param int $category_id Die Kategorie-ID, auf die geprüft werden soll
 * @return int Die stereotype Kategorie-ID oder 0 im Fehlerfall
 */
function reboot_match_category_and_define($category_id) {
    global $wp_the_query;
    $current_category = $wp_the_query->query_vars["cat"];

    $post_id = null;
    if(!is_home() && is_single()) {
        global $post;
        $post_id = $post->ID;
    }

    if(     ($category_id == $current_category) ||
            (!empty($post_id) &&
                (
                    in_category( $category_id, $post_id) ||
                    post_is_in_descendant_category($category_id, $post_id)
                )
            )
      ) {
        if(!defined("DETECTED_CATEGORY")) {
            define("DETECTED_CATEGORY", $category_id);
        }
        return true;
    }
    return false;
}

/**
 * Ermittelt die stereotype Kategorie-ID
 * @return int Die Kategorie-ID oder 0
 */
function reboot_detect_main_category()
{
    if(defined("DETECTED_CATEGORY")) return DETECTED_CATEGORY;
    if(reboot_match_category_and_define(BLOG_CATEGORY)) return BLOG_CATEGORY;
    if(reboot_match_category_and_define(PHOTO_CATEGORY)) return PHOTO_CATEGORY;
    if(reboot_match_category_and_define(DEV_CATEGORY)) return DEV_CATEGORY;

    // Keite Kategorie ermittelt, dann Sekundärcheck
    if(is_home()) {
        define("DETECTED_CATEGORY", DEFAULT_CATEGORY);
        return DEFAULT_CATEGORY;
    }
    
    return 0;
}

/**
 * Liefert die stereotype Kategorie-ID
 * @return int Die stereotype Kategorie-ID
 */
function reboot_main_category_id()
{
    if(defined("DETECTED_CATEGORY")) return DETECTED_CATEGORY;
    return 0;
}

add_action( 'wp_head', 'reboot_detect_main_category', -100 );
//add_action( 'loop_start', 'reboot_detect_main_category', -100 );