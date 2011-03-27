<?php
  global $dwooParams;

  if (have_posts())
  {

    $posts_tpl = array();

    while (have_posts())
    {
      the_post();

      $the_post["id"] = $post->ID;

      $the_post["date"] = $post->post_date;
      $the_post["date_gmt"] = $post->post_date_gmt;
      $the_post["modified"] = $post->post_modified;
      $the_post["modified_gmt"] = $post->post_modified_gmt;

      $the_post["permalink"] = get_permalink();

      // $the_post["pub_time"] = get_the_time(__('F jS, Y', 'reboot'));
      $the_post["pub_author"] = get_the_author(); //sprintf(__('von %s', 'reboot'), get_the_author());

      $the_post["password_required"] = post_password_required();

      // Publish-Zeitpunkt setzen
      $the_post["timestamp_pub"] = get_the_time('Y-m-j\TH:i:sP');

      // Update-Zeitpunkt setzen
      $modified_time = get_the_modified_time('Y-m-j\TH:i:sP');
      $the_post["timestamp_mod"] = $the_post["timestamp_pub"];
      if($the_post["timestamp_pub"] != $modified_time) $the_post["timestamp_mod"] = $modified_time;

      // Author-Informationen
      $the_post["author"] = array();
      $the_post["author"]["nickname"] = $authordata->nickname;       // nick
      $the_post["author"]["nicename"] = $authordata->user_nicename;       // login
      $the_post["author"]["displayname"] = $authordata->display_name; // der ausgewählte Name
      $the_post["author"]["firstname"] = $authordata->user_firstname;
      $the_post["author"]["lastname"] = $authordata->user_lastname;
      $the_post["author"]["url"] = $authordata->user_url;
      $the_post["author"]["email"] = $authordata->user_email;

      // Tags und Kategorien vergleichen
      if(!function_exists("reboot_sort_tc"))
      {
          function reboot_sort_tc($a, $b)
          {
            $value = $b["count"] - $a["count"];
            if(!$value) $value = strcmp($a["id"], $b["id"]);
            return $value;
          }
      }

      // Tags ermitteln
      $the_post["has_tags"] = FALSE;
      $posttags = get_the_tags();
      if ($posttags)
      {
        $the_post["has_tags"] = TRUE;
        $the_post["tag_list"] = array();
        foreach($posttags as $tag)
        {
          $the_tag = array();
          $the_tag["name"] = $tag->name;
          $the_tag["title"] = esc_attr($tag->name);
          $the_tag["slug"] = $tag->slug;
          $the_tag["id"] = $tag->term_id;
          $the_tag["description"] = $tag->description;
          $the_tag["count"] = $tag->count;
          $the_tag["url"] = get_tag_link($tag->term_id);

          // Tag anhängen
          $the_post["tag_list"][] = $the_tag;
        }
        usort($the_post["tag_list"], 'reboot_sort_tc');
      }

      // Kategorien ermitteln
      $the_post["has_categories"] = FALSE;
      $postcategories = get_the_category();
      if($postcategories)
      {
        $the_post["has_categories"] = TRUE;
        $the_post["category_list"] = array();
        foreach($postcategories as $category)
        {
          $the_category = array();
          $the_category["name"] = $category->name;
          $the_category["title"] = esc_attr($category->name);
          $the_category["slug"] = $category->slug;
          $the_category["id"] = $category->cat_ID;
          $the_category["description"] = $category->description;
          $the_category["count"] = $category->category_count;
          $the_category["url"] = get_category_link($category->cat_ID);

          // Kategorie anhängen
          $the_post["category_list"][] = $the_category;
        }
        usort($the_post["category_list"], 'reboot_sort_tc');
      }

      // Kommentarfunktionalität
      $the_post["comment_count"] = $post->comment_count;
      $the_post["comments_link"] = reboot_comments_link();
      $the_post["comments_open"] = comments_open();
      $the_post["comments_count_text"] = reboot_comments_count_text();

?>
  <ul class="posts hfeed">

      <!--<li class="post entry hentry" id="post-<?php the_ID(); ?>">-->
      <li id="post-<?php the_ID(); ?>" <?php post_class('entry') ?>>

        <h2 class="title">
          <a id="p<?php the_ID(); ?>" name="p<?php the_ID(); ?>" class="title entry-title" href="{$post.permalink}" rel="bookmark" title="<?php esc_attr(sprintf(__('Link zu &quot;%s&quot;', 'reboot'), the_title_attribute('echo=0'))) ?>">
            <span><?php echo reboot_get_the_title(); ?></span>
          </a>
        </h2>

        <div class="entry-content">
		    <?php echo reboot_get_the_content(__('Weiterlesen &raquo;', 'reboot')); ?>
		</div>

        <div class="info post-info" role="contentinfo">
			<?php the_time_ago(__('F jS, Y', 'reboot')); ?> <?php __('von', 'reboot'); ?>
		  
			<!-- vcard des Authors -->
			<address class="author vcard">
				<?php if(!empty($authordata->user_firstname) && !empty($authordata->user_lastname)): ?>
				<span class="fn n value-title" title="<?php echo $authordata->user_firstname ?> <?php echo $authordata->user_lastname ?>">
				<?php else: ?>
				<span class="fn<?php if(empty($authordata->nickname)): ?> nickname<?php endif; ?> value-title" title="<?php echo $authordata->user_nicename ?>">
				<?php endif; ?>
			
				<?php get_the_author(); ?>
				<?php if(!empty($authordata->nickname): ?>
					<span class="nickname value-title" title="<?php echo $authordata->nickname ?>"></span>
				<?php endif ?>
				{if $post.author.url}
				<?php if(!empty($authordata->user_url)): ?>
					<a class="url" href="<?php echo $authordata->user_url ?>"></a>
				<?php endif ?>
				</span>
			</address>
		  
		  &#183; <span class="commentlink"><?php echo reboot_comments_link(); ?></span>
          {if $user_is_admin}~ Post-ID <strong><?php the_ID(); ?></strong>{/if}
		  <?php edit_post_link(__('bearbeiten', "reboot"), '~ ', '', $post->ID) ?>
        </div>

        <div class="postmetadata" role="contentinfo">
          {if $post.has_tags}{include 'page_tags.tpl'}{/if}
          {if $post.has_categories}{include 'page_categories.tpl'}{/if}
        </div>

        {comments_template}

      </li>

  <?php
  	} // Ende der Posts-Schleife
   ?>  
  </ul>
<?php




	}
  else
  {

	include(TEMPLATEPATH . '/nothing_found.php');

  }
