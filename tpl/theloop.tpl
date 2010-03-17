  <ul class="posts hfeed">
  {foreach $posts post}

      <!--<li class="post entry hentry" id="post-{$post.id}">-->
      <li id="post-{$post.id}" {post_class 'entry'}>

        <h2 class="title">
          <a class="title entry-title" href="{$post.permalink}" rel="bookmark" title="{esc_attr $post.title_attr}">
            <span>{$post.title}</span>
          </a>
        </h2>

        <div class="commentlink">{$post.comments_link}</div>

        <div class="entry-content">
		    {$post.content}
		</div>

        <div class="info post-info" role="contentinfo">
          {$post.pub_time} {include 'page_pubauthor_short.tpl'}
          {edit_post_link 'bearbeiten', '~ ', ''}
        </div>

        <div class="postmetadata" role="contentinfo">
          {if $post.has_tags}{include 'page_tags.tpl'}{/if}
          {if $post.has_categories}{include 'page_categories.tpl'}{/if}
        </div>

        {comments_template}

      </li>

  {/foreach}
  </ul>
