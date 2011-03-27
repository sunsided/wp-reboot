  <ul class="posts <?php if (is_search()) echo "searchfailed"; else echo "fourohfour"; ?>">

                <img id="fourohfour" src="<?php bloginfo('stylesheet_directory') ?>/images/einstein404.png" alt="<?php __('Blog durchsucht - Nichts gefunden.', "reboot") ?>" />

          <?php if (is_search()): ?>
                <h3 class="main"><?php _e('Fehler 404: Blog durchsucht - Nichts gefunden.', "reboot") ?></h3>
				<p>Das war wohl nichts. Wir haben hier wirklich überall nachgesehen, aber <q><?php the_search_query(); ?></q> konnten wir nicht finden.</p>
          <?php else: ?>
                <h3 class="main"><?php _e('Fehler 404: Unbekannt verzogen - Nichts gefunden.', "reboot") ?></h3>
                <p>Hoppla, da ist wohl etwas schiefgegangen. Wir haben wirklich überall nachgesehen, konnten die Seite aber nicht finden.</p>
          <?php endif; ?>

          <?php
            // Suche auf andere Blogs ausdehnen
            if (is_search())
            {
                $query = get_search_query();

                $blogs = array(
                    array( "id" => BLOG_CATEGORY, "header" => "Persönlicher Blog", "results" => NULL ),
                    array( "id" => PHOTO_CATEGORY, "header" => "Fotografie", "results" => NULL ),
                    array( "id" => DEV_CATEGORY, "header" => "Programmierung", "results" => NULL )
                    );

                $count = 0;

                for ($i = 0; $i<count($blogs); $i++)
                {
                    $blog = $blogs[$i];
                    if ($blog["id"] == CURRENT_BLOG) continue;

                    $details = get_blog_details($blog["id"]);
                    $posts = search_blog($query, $blog["id"], FALSE);
                    $resultCount = count($posts);

                    if ($resultCount > 0)
                    {
                        $count = $count + $resultCount;
                        $blogs[$i]["results"] = array ( "details" => $details, "posts" => $posts, "count" => $resultCount );
                    }
                }

                // Nun ausgeben
                if ($count > 0)
                {
                    echo "<h2 class=\"otherblog\">Aber! Obacht!</h2>".PHP_EOL;
                    echo "<p>Beim Durchsuchen der anderen Blogs fanden sich Ergebnisse.<p>";

                    for ($i = 0; $i<count($blogs); $i++)
                    {
                        $blog = $blogs[$i];
                        if (empty($blog["results"])) continue;

                        switch_to_blog($blog["id"]);

                        $details = $blog["results"]["details"];
                        $posts = $blog["results"]["posts"];
                        $count = $blog["results"]["count"];

                        echo "<div class=\"searchresults\">";
                        echo "<p class=\"intro\">".
                                "<strong>".$blog["header"]."</strong> - Auf ".
                                "<a href=\"".$details->siteurl."?s=".$query."\">".
                                $details->blogname.
                                "</a> wurde".
                                ($count>1?"n":"").
                                " ".
                                ($count>1?($count." Ergebnisse"):"ein Ergebnis").
                                " gefunden:</p>";
                        echo "<ol>";
                        foreach($posts as $post) :
                                $age = get_the_time(__('F jS, Y', 'reboot'), $post->ID);
                                echo "<li><a class=\"postlink\" rel=\"bookmark\" href=\"".get_permalink($post->ID)."\">".$post->post_title."</a>".
                                     "<br /><abbr class=\"date\" title=\"".$post->post_date_gmt."Z\">".$age.
                                    "</abbr></li>".PHP_EOL;
                        endforeach;
                        echo "</ol>";
                        echo "</div>";
                    }
                }

                // Und zurücksetzen
                //restore_current_blog();
				switch_to_blog($GLOBALS['blog_id']);
            }

          ?>

  </ul>
