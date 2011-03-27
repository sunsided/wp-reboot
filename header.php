<?php

global $dwoo, $dwooParams;

// Links auf die Unterdomains
$dwooParams['urltopersonal']    = get_blog_details(BLOG_CATEGORY)->siteurl;
$dwooParams['urltophoto']       = get_blog_details(PHOTO_CATEGORY)->siteurl;
$dwooParams['urltocode']        = get_blog_details(DEV_CATEGORY)->siteurl;

// Titel
$dwooParams['titleforpersonal']    = get_blog_details(BLOG_CATEGORY)->blogname;
$dwooParams['titleforphoto']       = get_blog_details(PHOTO_CATEGORY)->blogname;
$dwooParams['titleforcode']        = get_blog_details(DEV_CATEGORY)->blogname;

if(CURRENT_BLOG == BLOG_CATEGORY)
{
    $dwooParams['current_subdomain'] = 'blog';
    $dwooParams['favicon'] = 'favicon.ico';
    $dwooParams['css_background'] = 'backdrop-7.jpg';
    $dwooParams['css_background_pos'] = '0px 0px';
}
elseif(CURRENT_BLOG == PHOTO_CATEGORY)
{
    $dwooParams['current_subdomain'] = 'photo';
    $dwooParams['favicon'] = 'favicon-photo.ico';
    $dwooParams['css_background'] = 'backdrop-4.jpg';
    $dwooParams['css_background_pos'] = '0px -60px';
}
elseif(CURRENT_BLOG == DEV_CATEGORY)
{
    $dwooParams['current_subdomain'] = 'dev';
    $dwooParams['favicon'] = 'favicon-code.ico';
    $dwooParams['css_background'] = 'backdrop-8.jpg';
    $dwooParams['css_background_pos'] = '0px -60px';
}
else $dwooParams['current_subdomain'] = 'blog';


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" 
    <?php language_attributes(); ?>
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"
>

<head profile="http://gmpg.org/xfn/11
              http://purl.org/uF/2008/03/
              http://purl.org/uF/hAtom/0.1/">

<meta http-equiv="Content-Type" content="<?php bloginfo("html_type"); ?> <?php bloginfo("charset"); ?>" />

<title><?php wp_title("&laquo; ", true, "right") ?><?php bloginfo("name") ?></title>

<link rel="stylesheet" href="<?php bloginfo("stylesheet_directory"); ?>/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo("stylesheet_url"); ?>" type="text/css" media="screen" />

<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>" />
<link rel="shortcut icon" href="<?php bloginfo("stylesheet_directory") ?>/images/{$favicon}" />

<link rel="alternate" type="application/rss+xml" title="<?php esc_attr(sprintf(__("name", 'reboot'), get_bloginfo('name'))); ?>" href="<?php bloginfo("rss2_url"); ?>" />

</head>

<body <?php language_attributes(); ?>>

  <a id="top" name="top"></a>
  <div id="page"<?php if(!empty($GLOBALS["page_classes"])): ?> class="<?php echo $GLOBALS["page_classes"]; =>"<?php endif; ?>>

    <div id="header" role="banner">
        <div class="transparency"></div>
        <div class="title"><a href="{option 'home'}/" rel="home"><h1><?php bloginfo("name") ?></h1></a></div>
        <div class="description"><?php bloginfo("description") ?></div>

        <div id="mainnavigation" class="menubar" role="navigation">
          <a class="mainnavlink{if $current_subdomain == 'blog'} currenttopic{/if}" id="navtopersonal" rel="me bookmark" href="{$urltopersonal}" title="{$titleforpersonal}"><div>Persönliches</div></a>
          <a class="mainnavlink{if $current_subdomain == 'photo'} currenttopic{/if}" id="navtophoto" rel="me bookmark" href="{$urltophoto}" title="{$titleforphoto}"><div>Fotografie</div></a>
          <a class="mainnavlink{if $current_subdomain == 'dev'} currenttopic{/if}" id="navtocode" rel="me bookmark" href="{$urltocode}" title="{$titleforcode}"><div>Programmierung</div></a>
        </div>
    </div>

    <div class="separate"></div>

        <div id="header-sidebar" class="sidebar"><ul class="sidebar">{insert_sidebar 'header'}</ul></div>
  	<div id="content" class="narrowcolumn" role="main">
