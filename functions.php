<?php

define("ENABLE_JQUERY",             TRUE);
define("ENABLE_FANCYBOX",           TRUE && ENABLE_JQUERY);
define("ENABLE_IMAGE_SCALING",      FALSE && ENABLE_JQUERY);
define("ENABLE_SMOOTH_SCROLL",      TRUE && ENABLE_JQUERY);

// MIME abrocken

PerformAwesomeMimeFoo();

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

// threaded comments! Woo!
if(!function_exists('theme_queue_js'))
{
    function theme_queue_js(){
      if (!is_admin()){
        if (!is_page() AND is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
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

function reboot_inject_jquery()
{
    $version = "-1.4.2";
    if($_SERVER["SERVER_ADDR"] != "127.0.0.1") $version .= "_min";
?>
<script type="text/javascript" language="javascript" src="<?php bloginfo("stylesheet_directory")?>/js/jquery<?php echo $version ?>.js"></script>
<?php
}

if(ENABLE_JQUERY) add_action( 'wp_head', 'reboot_inject_jquery', 1000 );

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

        $(this).attr("height", setHeight).attr("width", setWidth).attr("handled", true);
    }

    $(document).ready(function() {
        $("li.post .entry-content img[class*='wp-image-']").each(scale);
    });
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
    $(document).ready(function() {
        $("li.post .entry-content a img[class*='wp-image-']").each(function() {
           var parent = $(this).parent();
           if(!parent.attr("title")) parent.attr("title", $(this).attr("title"));
           parent.fancybox();
        });
    });
</script>
<?php
}

if(ENABLE_FANCYBOX) add_action( 'wp_head', 'reboot_inject_facybox_foo', 1003 );

function reboot_smooth_scrolling_foo()
{
?>
<script type="text/javascript" language="javascript">
$(function(){
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
</script>
<?php
}

if(ENABLE_SMOOTH_SCROLL) add_action( 'wp_head', 'reboot_smooth_scrolling_foo', 1004 );