  <ul class="posts hfeed">
  		{loop $posts}

      <li class="post entry hentry" id="post-{$id}">

        <h2 class="title">
          <a class="title entry-title" href="{$permalink}" rel="bookmark" title="{esc_attr $title_attr}">
            <span>{$title}</span>
          </a>
        </h2>

        <div class="commentlink">{$commentslink}</div>

        <div class="entry-content">
					{$content}
				</div>

        <div class="info post-info" role="contentinfo">
          {$pub_time} {$pub_author}
          {edit_post_link 'bearbeiten', '~ ', ''}
          <div class="invisible" style="display: none; visibility: hidden;">
              <span class="published">{$timestamp_pub}</span>
              <span class="updated">{$timestamp_mod}</span>
              <address class="author vcard">{if $author.firstname && $author.lastname}<span class="fn n">{$author.firstname} {$author.lastname}</span>{else}<span class="fn{if !$author.nickname} nickname{/if}">{$author.nicename}</span>{/if}{if $author.nickname}<span class="nickname">{$author.nickname}</span>{/if}{if $author.url}<a class="url" href="{$author.url}"></a>{/if}</address>
          </div>
        </div>

        <div class="postmetadata" role="contentinfo">
          {if $has_tags}<div class="tags" role="navigation">
            {loop $tag_list}<a rel="tag" class="tag tag-{$id} tag-{$slug}{if $count == 1} lonely{/if}" href="{$url}" title="{if $description}{esc_attr $description}"{else}{$title}{/if}">{$name}</a>
            {/loop}
          </div>{/if}

          {if $has_categories}<div class="categories" role="navigation">
            {loop $category_list}<a rel="category tag" class="category category-{$id} category-{$slug}{if $count == 1} lonely{/if}" href="{$url}" title="{if $description}{esc_attr $description}{else}{$title}{/if}">{$name}</a>
            {/loop}
          </div>{/if}
        </div>

      </li>

		{/loop}
  </ul>
