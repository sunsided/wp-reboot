<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
		die ('Please do not load this page directly. Thanks!');
}


global $dwoo, $dwooParams, $post;

$the_post = $dwooParams["posts"][0];

// Kommentare auflisten
$the_post['has_comments'] = have_comments();

// Kommentarliste generieren
ob_start(); wp_list_comments(); $comment_list = ob_get_clean();
$the_post['comment_list'] = $comment_list;

// load template
$localDwooParams = array();
$localDwooParams["post"] = $the_post;
$dwoo->output(TPL_PATH.'/comments.tpl', $localDwooParams);
