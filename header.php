<?php

global $dwoo, $dwooParams;

// Links auf die Unterdomains
$dwooParams['urltopersonal']    = get_category_link(BLOG_CATEGORY);
$dwooParams['urltophoto']       = get_category_link(PHOTO_CATEGORY);
$dwooParams['urltocode']        = get_category_link(DEV_CATEGORY);

if(is_category(BLOG_CATEGORY) || post_is_in_descendant_category(BLOG_CATEGORY))         $dwooParams['current_subdomain'] = 'blog';
elseif(is_category(PHOTO_CATEGORY) || post_is_in_descendant_category(PHOTO_CATEGORY))    $dwooParams['current_subdomain'] = 'photo';
elseif(is_category(DEV_CATEGORY) || post_is_in_descendant_category(DEV_CATEGORY))      $dwooParams['current_subdomain'] = 'dev'; 
//else $dwooParams['current_subdomain'] = 'blog';

$dwoo->output(TPL_PATH.'/header.tpl', $dwooParams);
$dwoo->output(TPL_PATH.'/header_page.tpl', $dwooParams);
