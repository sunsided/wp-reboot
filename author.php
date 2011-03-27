<?php

  $GLOBALS["page_classes"] = 'authorarchive';

  get_header();

  if(isset($_GET['author_name'])) :
    $curauth = get_user_by('slug', $author_name);
  else :
    $curauth = get_userdata(intval($author));
  endif;

  $searchterm = $curauth->display_name;

?>

<div id="searchresult_header" class="searchresult_header">
<h2 class="searchresult_header">Ergebnisse der Authorensuche</h2>
<p>Du hast den Blog nach dem Author <strong><?php echo $searchterm; ?></strong> durchsucht. Hier ist, was sich finden ließ.</p>
</div>
<div class="separate"></div>

<?php

  include(TEMPLATEPATH.'/theloop.php');

  get_footer();
