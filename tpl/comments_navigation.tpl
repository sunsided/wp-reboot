        {if $has_older_comments_link || $has_newer_comments_link}
    	<div class="navigation comment-navigation" role="navigation">
    		{if $has_older_comments_link}<div class="alignleft previouscomments"><?php previous_comments_link() ?></div>{/if}
    		{if $has_newer_comments_link}<div class="alignright nextcomments"><?php next_comments_link() ?></div>{/if}
    	</div>
        {/if}