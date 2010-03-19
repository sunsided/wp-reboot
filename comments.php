<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
{
		die ('Please do not load this page directly. Thanks!');
}

global $dwoo, $dwooParams, $post, $user_identity;
$localDwooParams = $dwooParams;

// Post lokal neu erzeugen
$the_post = $localDwooParams["posts"][0];

// Kommentare auflisten
$the_post['has_comments'] = have_comments();

// Kommentarliste generieren
$args = array(
    //'reply_text' => __('Antworten', 'reboot')
    );
ob_start(); wp_list_comments($args); $comment_list = ob_get_clean();
$the_post['comment_list'] = $comment_list;

// Post einreihen
$localDwooParams['post'] = $the_post;

// build navigation links
if(function_exists('get_PaginationFuComments'))
{
    $pagination = get_PaginationFuComments();
    $localDwooParams['has_comments_pagination'] = !empty($pagination);
    $localDwooParams['comments_pagination'] = $pagination;
}
else
{
    ob_start();
    previous_comments_link(__('« Older Comments', 'reboot'));
    $older_comments_link = ob_get_clean();
    ob_start();
    next_comments_link(__('Newer Comments »', 'reboot'));
    $newer_comments_link = ob_get_clean();

    $localDwooParams['has_older_comments_link'] = !empty($older_comments_link);
    $localDwooParams['has_newer_comments_link'] = !empty($newer_comments_link);
    $localDwooParams['older_comments_link'] = $older_comments_link;
    $localDwooParams['newer_comments_link'] = $newer_comments_link;
}

// subscription foo
ob_start();
show_subscription_checkbox();
$localDwooParams['subscriptionCheckbox'] = ob_get_clean();

// comment form action hook
ob_start();
do_action('comment_form', $post->ID);
$comment_form_action = ob_get_clean();
$localDwooParams['comment_form_action'] = $comment_form_action;

// Generelle Meldungen anhängen
$localDwooParams['comment_login_message'] = sprintf(__('Du musst <a href="%s">eingeloggt sein</a>, um einen Kommentar zu posten.', 'reboot'), wp_login_url(get_permalink()));
$localDwooParams['comment_logged_in_message'] = sprintf(__('Eingeloggt als <a href="%s/wp-admin/profile.php">%s</a>. <a href="%s" title="Aus diesem Accout ausloggen">Ausloggen &raquo;</a>', 'reboot'), get_option('siteurl'), $user_identity, wp_logout_url(get_permalink()));
$localDwooParams['comment_registration_needed'] = get_option('comment_registration');

// Aktueller Kommentator
$localDwooParams['comment_author'] = $comment_author;
$localDwooParams['comment_author_email'] = $comment_author_email;
$localDwooParams['comment_author_url'] = $comment_author_url;
$localDwooParams['req'] = $req;

// Template laden
$dwoo->output(TPL_PATH.'/comments.tpl', $localDwooParams);
