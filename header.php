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
//else $dwooParams['current_subdomain'] = 'blog';


$dwoo->output(TPL_PATH.'/header.tpl', $dwooParams);
$dwoo->output(TPL_PATH.'/header_page.tpl', $dwooParams);
