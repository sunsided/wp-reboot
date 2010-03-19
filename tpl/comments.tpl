<div class="comments">

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

    {/if}

{/if}

</div>