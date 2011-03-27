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
    previous_comments_link(__('� Older Comments', 'reboot'));
    $older_comments_link = ob_get_clean();
    ob_start();
    next_comments_link(__('Newer Comments �', 'reboot'));
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

// Generelle Meldungen anh�ngen
$localDwooParams['comment_login_message'] = sprintf(__('Du musst <a href="%s">eingeloggt sein</a>, um einen Kommentar zu posten.', 'reboot'), wp_login_url(get_permalink()));
$localDwooParams['comment_logged_in_message'] = sprintf(__('Eingeloggt als <a href="%s/wp-admin/profile.php">%s</a>. <a href="%s" title="Aus diesem Accout ausloggen">Ausloggen &raquo;</a>', 'reboot'), get_option('siteurl'), $user_identity, wp_logout_url(get_permalink()));
$localDwooParams['comment_registration_needed'] = get_option('comment_registration');

// Aktueller Kommentator
$localDwooParams['comment_author'] = $comment_author;
$localDwooParams['comment_author_email'] = $comment_author_email;
$localDwooParams['comment_author_url'] = $comment_author_url;
$localDwooParams['req'] = $req;

?>

<div class="comments">

<?php if(post_password_required()): ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'reboot');</p>
<?php else: /* --> not password protected */ ?>

	<?php if($post->comment_count > 0): ?>
    	<h3 id="comments">
		<?php 
		$title = __("%comments% auf &#8222;%title%&#8220;", 'reboot');|
		$title = str_replace('%comments%', reboot_comments_count_text(), $title);
		$title = str_replace('%title%', get_the_title(), $title);
		echo $title;
		</h3>

        {include 'comments_navigation.tpl'}

    	<ol class="commentlist">
    	{$post.comment_list}
    	</ol>

        {include 'comments_navigation.tpl'}

     {else}
	<?php else: /* --> keine Kommentare */ ?>
	 
		 <?php if(comments_open()): ?>
             <!-- comments are open, but there are no comments. -->
         <?php else: ?>
            <!-- comments are closed. -->
            <p class="nocomments"><?php _e('Comments are closed.', 'reboot'); ?></p>
         <?php endif; ?>
    <?php endif; /* Kommentare offen */ ?>


    <?php if(comments_open()): ?>

        <div id="respond" class="{if $user_logged_in}user-logged-in{else}anon-user{/if}">

        <h3>{comments_form_title}</h3>

        <div class="cancel-comment-reply">
        	<small>{cancel_comment_reply_link}</small>
        </div>

        {if $comment_registration_needed && !$user_logged_in}
            <p class="comment-login-needed">{$comment_login_message}</p>
        {else}

            <form action="{option 'siteurl'}/wp-comments-post.php" method="post" id="commentform">

            {include 'comments_form_fields.tpl'}

            {if $subscriptionCheckbox}<div class="subscription-row">{$subscriptionCheckbox}</div>{/if}
            <div class="button-row"><input tabindex="10" name="submit" type="submit" id="submit" tabindex="5" value="{translate 'Kommentar absenden'}" />
            {comment_id_fields}
            </div>
            {$comment_form_action}

            </form>

        {/if}

        </div>

    <?php endif; /* Kommentare offen */ ?>

<?php endif; /* password protected */ ?>

</div>

