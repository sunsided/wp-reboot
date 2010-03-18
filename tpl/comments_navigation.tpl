        {if $has_comments_pagination}
            {$comments_pagination}
        {elseif $has_older_comments_link || $has_newer_comments_link}
    	<div class="navigation comment-navigation" role="navigation">
    		{if $has_older_comments_link}<div class="alignleft previouscomments">{$older_comments_link}</div>{/if}
    		{if $has_newer_comments_link}<div class="alignright nextcomments">{$newer_comments_link}</div>{/if}
    	</div>
        {/if}