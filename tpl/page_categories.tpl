          <div class="categories" role="navigation">
            {foreach $post.category_list category}<a rel="category tag" class="category category-{$category.id} category-{$category.slug}{if $category.count == 1} lonely{/if}" href="{$category.url}" title="{if $category.description}{esc_attr $category.description}{else}{$category.title}{/if}">{$category.name}</a>
            {/foreach}
          </div>