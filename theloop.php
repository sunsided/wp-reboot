<?php

  global $dwooParams;
  if (have_posts())
  {

    $posts_tpl = array();

	while (have_posts())
    {
      the_post();
      echo "Kategorie! " .reboot_main_category_id() ." zors!";

      $the_post["id"] = $post->ID;

      $the_post["date"] = $post->post_date;
      $the_post["date_gmt"] = $post->post_date_gmt;
      $the_post["modified"] = $post->post_modified;
      $the_post["modified_gmt"] = $post->post_modified_gmt;

      $the_post["permalink"] = get_permalink();
      $the_post["title_attr"] = sprintf(__('Link zu &quot;%s&quot;', 'reboot'), the_title_attribute('echo=0'));
      $the_post["title"] = reboot_get_the_title();
      $the_post["content"] = reboot_get_the_content(__('Weiterlesen &raquo;', 'reboot'));

      ob_start(); the_time_ago(__('F jS, Y', 'reboot'));
      $the_post["pub_time"] = ob_get_clean();

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
      $the_post["author"]["displayname"] = $authordata->user_displayname; // der ausgewählte Name
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
        usort($the_post["tag_list"], reboot_sort_tc);
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
        usort($the_post["category_list"], reboot_sort_tc);
      }

      // Kommentarfunktionalität
      $the_post["comment_count"] = $post->comment_count;
      $the_post["comments_link"] = reboot_comments_link();
      $the_post["comments_open"] = comments_open();
      $the_post["comments_count_text"] = reboot_comments_count_text();

      $posts_tpl[] = $the_post;

  	}

    $dwooParams["posts"] = $posts_tpl;
    $dwoo->output(TPL_PATH.'/theloop.tpl', $dwooParams);

	}
  else
  {

    $dwoo->output(TPL_PATH.'/nothing_found.tpl');

	}
