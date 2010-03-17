          <div class="tags" role="navigation">
            {foreach $post.tag_list tag}<a rel="tag" class="tag tag-{$tag.id} tag-{$tag.slug}{if $tag.count == 1} lonely{/if}" href="{$tag.url}" title="{if $tag.description}{esc_attr $tag.description}"{else}{$tag.title}{/if}">{$tag.name}</a>
            {/foreach}
          </div>