<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
		die ('Please do not load this page directly. Thanks!');
}

global $dwoo, $dwooParams, $post, $user_identity;
$localDwooParams = array();

// Post lokal neu erzeugen
$the_post = $dwooParams["posts"][0];

// Kommentare auflisten
$the_post['has_comments'] = have_comments();

// Kommentarliste generieren
ob_start(); wp_list_comments(); $comment_list = ob_get_clean();
$the_post['comment_list'] = $comment_list;

// Generelle Meldungen anhängen
$localDwooParams['comment_login_message'] = sprintf(__('Du musst <a href="%s">eingeloggt sein</a>, um einen Kommentar zu posten.', 'reboot'), wp_login_url(get_permalink()));
$localDwooParams['comment_logged_in_message'] = sprintf(__('Eingeloggt als <a href="%s/wp-admin/profile.php">%s</a>. <a href="%s" title="Aus diesem Accout ausloggen">Ausloggen &raquo;</a>', 'reboot'), get_option('siteurl'), $user_identity, wp_logout_url(get_permalink()));
$localDwooParams['comment_registration_needed'] = get_option('comment_registration');
$localDwooParams['user_identity'] = $user_identity;
$localDwooParams['post'] = $the_post;

// Template laden
$dwoo->output(TPL_PATH.'/comments.tpl', $localDwooParams);
