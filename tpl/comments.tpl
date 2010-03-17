{if $post.password_required}
    <p class="nocomments">{translate 'This post is password protected. Enter the password to view comments.'}</p>
{else}

    {if $post.has_comments}
    	<h3 id="comments">{include 'comments_pageheading.tpl'}</h3>

        {include 'comments_navigation.tpl'}

    	<ol class="commentlist">
    	{$post.comment_list}
    	</ol>

        {include 'comments_navigation.tpl'}

     {else}
         {if $post.comments_open}
             <!-- comments are open, but there are no comments. -->
         {else}
            <!-- comments are closed. -->
            <p class="nocomments">{translate 'Comments are closed.'}</p>
         {/if}
    {/if}


    {if $post.comments_open}

        <div id="respond">

        <h3>{comments_form_title}</h3>

        <div class="cancel-comment-reply">
        	<small>{cancel_comment_reply_link}</small>
        </div>

        {if $comment_registration_needed && !$user_logged_in}
            <p class="comment-login-needed">{$comment_login_message}</p>
        {else}

            <form action="{option 'siteurl'}/wp-comments-post.php" method="post" id="commentform">

            <?php if ( is_user_logged_in() ) : ?>

                <p>{$comment_logged_in_message}</p>

            <?php else : ?>

                <p><input type="text" name="author" id="author" value="{esc_attr $comment_author}" size="22" tabindex="1" {if $req}aria-required="true"{/if} />
                <label for="author"><small>{translate 'Name'} {if $req}{translate '(ben&#246;tigt)'}{/if}</small></label></p>

                <p><input type="text" name="email" id="email" value="{esc_attr $comment_author_email}" size="22" tabindex="2" {if $req}aria-required="true"{/if} />
                <label for="email"><small>{translate 'Mail (wird nicht ver&#246;ffentlicht)'} {if $req}{translate '(ben&#246;tigt)'}{/if}</small></label></p>

                <p><input type="text" name="url" id="url" value="{esc_attr $comment_author_url}" size="22" tabindex="3" />
                <label for="url"><small>{translate 'Website'}</small></label></p>

            <?php endif; ?>

            <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

            <p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

            <p><input name="submit" type="submit" id="submit" tabindex="5" value="{translate 'Kommentar absenden'}" />
            {comment_id_fields}
            </p>
            {$comment_form_action}

            </form>

        {/if}

        </div>

    {/if}

{/if}